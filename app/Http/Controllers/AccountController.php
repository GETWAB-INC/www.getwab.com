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
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyNewEmail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     * Show the main account page.
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
        $user = auth()->user();

        $validated = $request->validate([
            'firstName'     => 'required|string|max:255',
            'lastName'      => 'nullable|string|max:255',
            'jobTitle'      => 'nullable|string|max:255',
            'organization'  => 'nullable|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'         => 'nullable|string|max:20',

            'currentPassword' => 'nullable|string',
            'newPassword'     => 'nullable|string|min:8|confirmed',
            'confirmPassword' => 'nullable|same:newPassword',
        ]);

        /*
        |----------------------------------------------------------
        | Required fields
        |----------------------------------------------------------
        */
        $user->name = $validated['firstName'];

        /*
        |----------------------------------------------------------
        | Optional fields
        | If field is present in request:
        |   - empty string => NULL (clear value)
        |   - non-empty    => save value
        |----------------------------------------------------------
        */
        foreach ([
            'lastName'     => 'surname',
            'jobTitle'     => 'job',
            'organization' => 'organization',
            'phone'        => 'phone',
        ] as $input => $column) {
            if ($request->has($input)) {
                $value = $request->input($input);

                // Trim strings and convert empty value to NULL
                if (is_string($value)) {
                    $value = trim($value);
                }

                $user->{$column} = ($value === '' || $value === null) ? null : $value;
            }
        }

        /*
        |----------------------------------------------------------
        | Optional password change
        | Both current and new passwords must be provided
        |----------------------------------------------------------
        */
        if ($request->filled('currentPassword') || $request->filled('newPassword')) {

            if (
                !$request->filled('currentPassword') ||
                !$request->filled('newPassword')
            ) {
                return back()->withErrors([
                    'newPassword' => 'To change the password, both current and new passwords are required.',
                ]);
            }

            if (!Hash::check($request->input('currentPassword'), $user->password)) {
                return back()->withErrors([
                    'currentPassword' => 'The current password is incorrect.',
                ]);
            }

            $user->password = Hash::make($request->input('newPassword'));
        }

        /*
        |----------------------------------------------------------
        | Email change logic
        |----------------------------------------------------------
        */
        $newEmail = $validated['email'];

        // If email did not change, save immediately
        if ($newEmail === $user->email) {
            $user->save();

            return back()->with('success', 'Profile updated successfully.');
        }

        // Ensure email is not already used
        if (
            User::where('email', $newEmail)
                ->where('id', '!=', $user->id)
                ->exists()
        ) {
            return back()->withErrors([
                'email' => 'This email is already in use.',
            ]);
        }

        // Ensure email is not pending for another user
        if (
            User::where('email_pending', $newEmail)
                ->where('id', '!=', $user->id)
                ->exists()
        ) {
            return back()->withErrors([
                'email' => 'This email is already pending verification by another user.',
            ]);
        }

        /*
        |----------------------------------------------------------
        | Set pending email and send verification link
        |----------------------------------------------------------
        */
        $rawToken = Str::random(48);

        $user->email_pending = $newEmail;
        $user->email_pending_token = hash('sha256', $rawToken);
        $user->email_pending_expires_at = now()->addHours(24);
        $user->save();

        Mail::to($newEmail)->send(
            new VerifyNewEmail($user, $rawToken)
        );

        return back()->with(
            'success',
            'We sent a verification link to your new email. Please confirm it to apply the change.'
        );
    }


    public function verifyNewEmail(Request $request)
    {

        $userId = $request->query('user');
        $token  = $request->query('token');

        if (!$userId || !$token) {

            return redirect()->route('account')
                ->withErrors(['email' => 'Invalid verification link.']);
        }

        $user = User::find($userId);

        if (!$user) {

            return redirect()->route('account')
                ->withErrors(['email' => 'User not found.']);
        }

        // No pending change
        if (!$user->email_pending || !$user->email_pending_token) {

            return redirect()->route('account')
                ->withErrors(['email' => 'No pending email change found.']);
        }

        // Expired link
        if ($user->email_pending_expires_at && now()->gt($user->email_pending_expires_at)) {

            $user->update([
                'email_pending' => null,
                'email_pending_token' => null,
                'email_pending_expires_at' => null,
            ]);

            return redirect()->route('account')
                ->withErrors(['email' => 'Verification link expired.']);
        }

        // Token mismatch
        $hashedToken = hash('sha256', $token);

        if (!hash_equals($user->email_pending_token, $hashedToken)) {

            return redirect()->route('account')
                ->withErrors(['email' => 'Invalid verification token.']);
        }

        // Email already used
        if (
            User::where('email', $user->email_pending)
                ->where('id', '!=', $user->id)
                ->exists()
        ) {

            return redirect()->route('account')
                ->withErrors(['email' => 'This email is already in use.']);
        }

        $user->email = $user->email_pending;
        $user->email_verified_at = now();
        $user->email_pending = null;
        $user->email_pending_token = null;
        $user->email_pending_expires_at = null;

        $user->save();

        return redirect()->route('account')
            ->with('success', 'Email updated successfully.');
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
