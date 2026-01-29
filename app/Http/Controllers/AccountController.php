<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Report;
use App\Models\BillingRecord;
use App\Models\Subscription;

class AccountController extends Controller
{
    /**
     * Show the main account dashboard page.
     * Loads the current user and their reports (with parameters).
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function account(Request $request)
    {
        $user = Auth::user();

        $reports = Report::with('parameters')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.account', compact('user', 'reports'));
    }

    /**
     * Show the user's reports section.
     * Stores the current section URL in session to allow returning to the same tab.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function reports(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.reports')]);

        $reports = Report::with('parameters')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.reports', compact('user', 'reports'));
    }

    /**
     * Show the user's remaining report package counts.
     * Stores the current section URL in session to allow returning to the same tab.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function packages(Request $request)
    {
        $user = Auth::user();

        $elementaryPackage = $user->reportPackages()
            ->where('package_type', 'elementary')
            ->first();
        $elementaryCount = $elementaryPackage ? $elementaryPackage->remaining_reports : 0;

        $compositePackage = $user->reportPackages()
            ->where('package_type', 'composite')
            ->first();
        $compositeCount = $compositePackage ? $compositePackage->remaining_reports : 0;

        session(['last_account_section' => route('account.packages')]);

        return view('account.packages', compact(
            'user',
            'elementaryCount',
            'compositeCount'
        ));
    }

    /**
     * Show the user's subscription status page.
     * Loads the most recent subscriptions by type (fpds_query, fpds_reports) and derives status flags.
     * Stores the current section URL in session to allow returning to the same tab.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subscription(Request $request)
    {
        $user = Auth::user();

        $fpds_query = Subscription::where('user_id', $user->id)
            ->where('subscription_type', 'fpds_query')
            ->orderBy('created_at', 'desc')
            ->first();

        $fpds_reports = Subscription::where('user_id', $user->id)
            ->where('subscription_type', 'fpds_reports')
            ->orderBy('created_at', 'desc')
            ->first();

        $hasActiveFpdsQuery = false;
        $hasCancelledFpdsQuery = false;
        $hasExpiredFpdsQuery = false;

        if ($fpds_query) {
            $hasActiveFpdsQuery = ($fpds_query->isActive() || $fpds_query->isTrial());
            $hasCancelledFpdsQuery = ($fpds_query->isCancelled());
            $hasExpiredFpdsQuery = ($fpds_query->isExpired());
        }

        $hasActiveFpdsReports = false;
        $hasCancelledFpdsReports = false;
        $hasExpiredFpdsReports = false;

        if ($fpds_reports) {
            $hasActiveFpdsReports = ($fpds_reports->isActive() || $fpds_reports->isTrial());
            $hasCancelledFpdsReports = ($fpds_reports->isCancelled());
            $hasExpiredFpdsReports = ($fpds_reports->isExpired());
        }

        session(['last_account_section' => route('account.subscription')]);

        return view('account.subscription', compact(
            'user',
            'fpds_query',
            'fpds_reports',
            'hasActiveFpdsQuery',
            'hasCancelledFpdsQuery',
            'hasExpiredFpdsQuery',
            'hasActiveFpdsReports',
            'hasCancelledFpdsReports',
            'hasExpiredFpdsReports'
        ));
    }

    /**
     * Show the user's billing history page.
     * Maps internal cart item keys to human-readable names for display.
     * Stores the current section URL in session to allow returning to the same tab.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function billing(Request $request)
    {
        $itemsToShow = [
            'single_elementary_report' => 'Elementary Report',
            'single_composite_report' => 'Composite Report',
            'elementary_report_package' => 'Elementary Package',
            'composite_report_package' => 'Composite Package',
            'fpds_query_subscription' => 'FPDS Query Subscription',
            'fpds_report_subscription' => 'FPDS Report Subscription',
        ];

        $user = Auth::user();

        $billingHistory = BillingRecord::where('user_id', $user->id)
            ->orderBy('billed_at', 'desc')
            ->get();

        session(['last_account_section' => route('account.billing')]);

        return view('account.billing', compact('user', 'itemsToShow', 'billingHistory'));
    }

    /**
     * Show the user's profile page.
     * Stores the current section URL in session to allow returning to the same tab.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function profile(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.profile')]);

        return view('account.profile', compact('user'));
    }

    /**
     * Update the user's profile and optionally change the password.
     * If both currentPassword and newPassword are provided, the current password is verified before updating.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'jobTitle' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'currentPassword' => 'nullable|string',
            'newPassword' => 'nullable|string|min:8|confirmed',
            'confirmPassword' => 'nullable|same:newPassword',
        ]);

        $user = auth()->user();

        $user->name = $validated['firstName'] ?? $user->name;
        $user->surname = $validated['lastName'] ?? $user->surname;
        $user->job = $validated['jobTitle'] ?? $user->job;
        $user->organization = $validated['organization'] ?? $user->organization;
        $user->email = $validated['email'] ?? $user->email;
        $user->phone = $validated['phone'] ?? $user->phone;

        if ($validated['currentPassword'] && $validated['newPassword']) {
            if (!Hash::check($validated['currentPassword'], $user->password)) {
                return back()->withErrors(['currentPassword' => 'The current password is incorrect.']);
            }

            $user->password = Hash::make($validated['newPassword']);
        }

        try {
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error saving: ' . $e->getMessage()]);
        }
    }

    /**
     * Upload and set the user's avatar image.
     * Validates image type and size, stores it in the public disk, and returns the public URL.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(Request $request)
    {
        if (!$request->hasFile('avatar')) {
            return response()->json([
                'success' => false,
                'message' => 'No file selected'
            ], 400);
        }

        $file = $request->file('avatar');

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // up to 2 MB
        ]);

        $user = Auth::user();

        $filename = Str::uuid() . '.' . $file->extension();

        $path = $file->storeAs('avatars', $filename, 'public');

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar uploaded',
            'avatar_url' => Storage::url($path)
        ]);
    }

    /**
     * Remove the user's avatar image from disk and clear the avatar field.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeAvatar(Request $request)
    {
        $user = Auth::user();

        if (!$user->avatar) {
            return response()->json([
                'success' => false,
                'message' => 'No avatar to remove'
            ], 400);
        }

        $filePath = storage_path('app/public/' . $user->avatar);

        if (file_exists($filePath)) {
            try {
                unlink($filePath);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete file: ' . $e->getMessage()
                ], 500);
            }
        }

        $user->avatar = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar removed successfully'
        ]);
    }
}
