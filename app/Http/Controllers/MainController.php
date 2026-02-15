<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy-old');
    }

    public function cookiePolicy()
    {
        return view('cookie-policy');
    }

    public function termsOfUse()
    {
        return view('terms-of-use');
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function article()
    {
        return view('article');
    }



public function mail()
{
    // Текущий пользователь (пример)
    $user = (object) [
        'id'   => 21,
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ];

    // Текущая подписка (твои данные)
    $subscription = (object) [
        'subscription_type' => 'fpds_query',
        'status'            => 'trial',
        'plan'              => 'monthly',

        'trial_start_at'    => Carbon::parse('2026-02-15 02:31:01'),
        'trial_end_at'      => Carbon::parse('2026-02-22 02:31:01'),

        'next_billing_at'   => Carbon::parse('2026-02-22 02:31:01'),

        'amount'            => '1.00',
        'currency'          => 'USD',
    ];

    $trialStart = $subscription->trial_start_at->format('M d, Y H:i');
    $trialEnd   = $subscription->trial_end_at->format('M d, Y H:i');
    $billAt     = $subscription->next_billing_at->format('M d, Y H:i');

    return view('emails.trial-created', [
        'user'              => $user,
        'product_name'      => 'FPDS Query',
        'subscription_type' => $subscription->subscription_type,

        'plan'              => $subscription->plan,
        'plan_label'        => ucfirst($subscription->plan),

        'trial_start_at'    => $trialStart,
        'trial_end_at'      => $trialEnd,
        'next_billing_at'   => $billAt,

        'amount'            => $subscription->amount,
        'currency'          => $subscription->currency,
    ]);
}


    public function adminer()
    {
        $user = auth()->user();

        if (!$user || $user->email !== "ilia.oborin@getwab.com") {
            abort(404);
        }

        $path = storage_path('adminer/adminer.php');

        if (!is_file($path) || !is_readable($path)) {
            abort(404, 'Adminer not found');
        }

        return response()->stream(function () use ($path) {
            require $path;
        }, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function productsFpdsQuery()
    {
        return view('products.fpds-query');
    }

    public function productsFpdsQueryOverview()
    {
        return view('products.fpds-query-overview');
    }

    public function servicesGov()
    {
        return view('services.gov');
    }
}
