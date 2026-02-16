<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function orderSubscription(Request $request)
    {

        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'subscription_plan' => 'required|in:monthly,annual',
        ]);


        $user = Auth::user();
        $existingSubscription = null;

        // Check if the user is logged in.
        if ($user) {
            // Only if the user exists, we search for the subscription.
            $existingSubscription = Subscription::where('user_id', $user->id)
                ->where('subscription_type', $validated['subscription_type'])
                ->first();
        }

        // If a subscription exists and it's a trial subscription → redirect
        if ($existingSubscription && $existingSubscription->isCurrentlyTrial()) {
            return redirect()->route('account.subscription');
        }

        // If a subscription exists and it is active (not a trial) → redirect
        if ($existingSubscription && !$existingSubscription->isCurrentlyTrial()) {
            return redirect()->route('account.subscription');
        }

        // Determine the subscription status
        if (!$existingSubscription) {
            $subscriptionStatus = 'trial'; // No subscription → new trial
        } else {
            $subscriptionStatus = $existingSubscription->isCurrentlyTrial() ? 'trial' : 'active';
        }

        $subscriptionType = $validated['subscription_type'];
        $subscriptionPlan = Subscription::normalizePlan($validated['subscription_plan']);

        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$subscriptionPlan] ?? 0.00;


        // CRITICAL CHANGE: always set the status to 'active' for fpds_reports
        if ($subscriptionType === 'fpds_reports') {
            $subscriptionStatus = 'active';
            // No trial period is available for fpds_reports → the service is always paid.
        }

        // Price adjustment only for fpds_query with trial
        if ($subscriptionStatus === 'trial' && $subscriptionType === 'fpds_query') {
            $totalPrice = 0;
        }

        $orderData = [
            'subscription_type' => $subscriptionType,
            'subscription_status' => $subscriptionStatus,
            'subscription_price' => $totalPrice,
            'subscription_plan' => $subscriptionPlan,
        ];

        // Saving to session by type and status
        if ($subscriptionType === 'fpds_query') {
            if ($subscriptionStatus === 'trial') {
                Session::put('fpds_query_trial', $orderData);
            } else {
                Session::put('fpds_query_subscription', $orderData);
            }
        } elseif ($subscriptionType === 'fpds_reports') {
            Session::put('fpds_report_subscription', $orderData);
        }

        return redirect()->route('checkout');
    }




    public function cancelSubscription(Request $request)
    {
        // 2. Searching for the user's active subscription
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $userId = Auth::id();

        // 2. Searching for the user's active subscription
        $subscription = Subscription::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->whereIn('status', ['active', 'trial'])
            ->first();

        if (!$subscription) {
            return redirect()->back()->withErrors(['subscription' => 'Active subscription not found']);
        }

        // 3. Unsubscribing: updating the status and dates
        try {
            $subscription->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'updated_at' => now(),
            ]);

            // 4. Successful completion
            return redirect()->back()->withSuccess('Subscription cancelled successfully');
        } catch (\Exception $e) {
            Log::error('Subscription cancellation failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['subscription' => 'Failed to cancel subscription']);
        }
    }

    public function restoreSubscription(Request $request)
    {
        // 1) Validate: only lowercase
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan'          => 'required|in:monthly,annual',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $newPlan = Subscription::normalizePlan($validated['new_plan']); // always lowercase
        $userId = Auth::id();

        // 2) Find subscription
        $subscription = Subscription::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->first();

        if (!$subscription) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription not found.']);
        }

        // 3) Expired check (includes trial)
        if ($subscription->isExpired()) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription has expired. Please renew it.']);
        }

        // 4) Prices (safe)
        $prices = Subscription::PRICES;
        $currentPlan = Subscription::normalizePlan((string) $subscription->plan);

        $currentPrice = $prices[$subscriptionType][$newPlan] ?? null;
        if ($currentPrice === null) {
            Log::error("restoreSubscription: price not found", [
                'subscription_type' => $subscriptionType,
                'new_plan' => $newPlan,
            ]);
            return redirect()->back()->withErrors(['subscription' => 'Pricing configuration error.']);
        }

        // 5) Recovery logic
        if ($currentPlan === $newPlan) {
            // CASE 1: same plan
            try {
                // If user cancelled during an active trial window -> restore TRIAL (do NOT reset dates)
                if (
                    $subscription->isFpdsQuerySubscription()
                    && $subscription->trial_end_at !== null
                    && now()->lte($subscription->trial_end_at)
                    && $subscription->billing_record_id === null
                ) {
                    $subscription->update([
                        'status'         => Subscription::STATUS_TRIAL,
                        'cancelled_at'   => null,
                        'next_billing_at'=> $subscription->trial_end_at,
                        'expires_at'     => $subscription->trial_end_at,
                        'updated_at'     => now(),
                    ]);

                    return redirect()->back()->withSuccess('Trial restored successfully');
                }

                // Otherwise restore as ACTIVE (paid restore)
                $subscription->updateSubscription(['status' => Subscription::STATUS_ACTIVE]);

                return redirect()->back()->withSuccess('Subscription restored successfully');
                
            } catch (\Exception $e) {
                Log::error('Subscription restore failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['subscription' => 'Failed to restore subscription']);
            }
        }

        // CASE 2: plan changed
        if ($subscription->isFpdsQuerySubscription() && $subscription->isCurrentlyTrial()) {
            // SUBCASE 2.1: fpds_query in trial - update without checkout
            try {
                $subscription->updateSubscription(['plan' => $newPlan]);
                return redirect()->back()->withSuccess('Trial plan updated successfully');
            } catch (\Exception $e) {
                Log::error('Trial plan update failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['subscription' => 'Failed to update trial plan']);
            }
        }

        // SUBCASE 2.2: plan changed (not trial or not fpds_query) → checkout
        $orderData = [
            'subscription_type'  => $subscriptionType,
            'subscription_price' => $currentPrice,
            'subscription_plan'  => $newPlan,
        ];

        $sessionKey = match ($subscriptionType) {
            'fpds_query'   => 'fpds_query_subscription',
            'fpds_reports' => 'fpds_report_subscription',
            default => null,
        };

        if (!$sessionKey) {
            return redirect()->back()->withErrors(['subscription' => 'Unknown subscription type.']);
        }

        Session::put($sessionKey, $orderData);
        return redirect()->route('checkout');
    }


    public function renewSubscription(Request $request)
    {
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan'          => 'required|in:monthly,annual',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $newPlan = Subscription::normalizePlan($validated['new_plan']); // always lowercase

        // Current logic: renew is always paid
        $subscriptionStatus = 'active';

        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$newPlan] ?? null;

        if ($totalPrice === null) {
            Log::error("renewSubscription: price not found", [
                'subscription_type' => $subscriptionType,
                'new_plan' => $newPlan,
            ]);
            return redirect()->back()->withErrors(['subscription' => 'Pricing configuration error.']);
        }

        $orderData = [
            'subscription_type'   => $subscriptionType,
            'subscription_status' => $subscriptionStatus,
            'subscription_price'  => $totalPrice,
            'subscription_plan'   => $newPlan,
        ];

        if ($subscriptionType === 'fpds_query') {
            Session::put('fpds_query_subscription', $orderData);
        } else { // fpds_reports
            Session::put('fpds_report_subscription', $orderData);
        }

        return redirect()->route('checkout');
    }
}