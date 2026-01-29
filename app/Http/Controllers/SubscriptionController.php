<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function orderSubscription(Request $request)
    {

        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'subscription_plan' => 'required|in:Monthly,Annual',
        ]);


        $user = auth()->user();
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
        $subscriptionPlan = $validated['subscription_plan'];

        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$subscriptionPlan];

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
        $userId = auth()->id();

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

        // 1. Input data validation
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan' => 'required|in:Monthly,Annual',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $newPlan = $validated['new_plan']; // 'Monthly'/'Annual'
        $userId = auth()->id();

        // 2. Searching for an existing subscription
        $subscription = Subscription::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->first();

        // 3. Check if the subscription has expired (including the trial period)
        if ($subscription->isExpired()) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription has expired. Please renew it.']);
        }

        // 4. We get the prices from the centralized model constant.
        $prices = Subscription::PRICES;
        // 5. Normalize the current plan from the database
        $currentPlan = $subscription->plan;

        // 6. Get the price and frequency for the new plan.
        $currentPrice = $prices[$subscriptionType][$newPlan];
        $subscriptionPlan = $newPlan; // 'Monthly' or 'Annual' - already in the correct format

        // 7. Recovery logic
        if ($currentPlan === $newPlan) {
            // CASE 1: The plan has not changed
            try {
                $subscription->updateSubscription(['status' => Subscription::STATUS_ACTIVE]);
                return redirect()->back()->withSuccess('Subscription restored successfully');
            } catch (\Exception $e) {
                Log::error('Subscription restore failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['subscription' => 'Failed to restore subscription']);
            }
        } else {
            // CASE 2: The plan has changed
            if ($subscription->isFpdsQuerySubscription() && $subscription->isCurrentlyTrial()) {
                // SUBCASE 2.1: fpds_query in trial - update without checkout
                try {
                    $subscription->updateSubscription(['plan' => $newPlan]);
                    return redirect()->back()->withSuccess('Trial plan updated successfully');
                } catch (\Exception $e) {
                    Log::error('Trial plan update failed: ' . $e->getMessage());
                    return redirect()->back()->withErrors(['subscription' => 'Failed to update trial plan']);
                }
            } elseif ($currentPlan !== $newPlan) {
                // SUBCASE 2.2: plan changed (not trial or not fpds_query) → to checkout
                $orderData = [
                    'subscription_type' => $subscriptionType,
                    'subscription_price' => $currentPrice,
                    'subscription_plan' => $subscriptionPlan,
                ];
                $sessionKey = match ($subscriptionType) {
                    'fpds_query' => 'fpds_query_subscription',
                    'fpds_reports' => 'fpds_report_subscription',
                    default => throw new \Exception('Unknown subscription type'),
                };
                Session::put($sessionKey, $orderData);
                return redirect()->route('checkout');
            } else {
                // SUBCASE 2.3: Subscription is already active - error
                return redirect()->back()->withErrors(['subscription' => 'Subscription is already active']);
            }
        }
    }

    public function renewSubscription(Request $request)
    {
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan' => 'required|in:Monthly,Annual',
        ]);

        $subscriptionType = $validated['subscription_type']; // 'fpds_query' or 'fpds_reports'
        $newPlan = $validated['new_plan']; // 'Monthly' or 'Annual'

        // Trial is not allowed for fpds_query
        if ($subscriptionType === 'fpds_query') {
            $subscriptionStatus = 'active';
        } else {
            // Trial may be allowed for fpds_reports in the future (if needed)
            $subscriptionStatus = 'trial'; // or 'active' depending on business logic
        }

        // In the current logic, subscription is always set to 'active' for both types
        $subscriptionStatus = 'active';

        // Get pricing from the Subscription model
        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$newPlan];

        // Trial is not allowed for fpds_query → full price always applies

        $orderData = [
            'subscription_type' => $subscriptionType,
            'subscription_status' => $subscriptionStatus,
            'subscription_price' => $totalPrice,
            'subscription_plan' => $newPlan,
        ];

        if ($subscriptionType === 'fpds_query') {
            Session::put('fpds_query_subscription', $orderData);
        } elseif ($subscriptionType === 'fpds_reports') {
            Session::put('fpds_report_subscription', $orderData);
        }

        return redirect()->route('checkout');
    }

}