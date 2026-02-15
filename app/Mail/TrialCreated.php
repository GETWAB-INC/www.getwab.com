<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Subscription;

class TrialCreated extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Subscription $subscription;

    public function __construct(User $user, Subscription $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    public function build()
    {
        $s = $this->subscription;

        // Canonical plan values: monthly | annual
        $plan = $s->plan === 'annual' ? 'annual' : 'monthly';

        $planLabel = $plan === 'annual'
            ? 'Annual'
            : 'Monthly';

        // Date formatting
        $trialStart = optional($s->trial_start_at)?->format('M d, Y H:i');
        $trialEnd   = optional($s->trial_end_at)?->format('M d, Y H:i');
        $billAt     = optional($s->next_billing_at)?->format('M d, Y H:i') ?: $trialEnd;

        // Subject changes depending on plan
        if ($plan === 'annual') {
            $subject = "FPDS Query trial activated — annual billing begins {$billAt}";
        } else {
            $subject = "FPDS Query trial activated — monthly billing begins {$billAt}";
        }

        return $this->subject($subject)
            ->view('emails.trial-created')
            ->with([
                'user'              => $this->user,

                'product_name'      => 'FPDS Query',
                'subscription_type' => $s->subscription_type ?? 'fpds_query',

                'plan'              => $plan,
                'plan_label'        => $planLabel,

                'trial_start_at'    => $trialStart ?: '-',
                'trial_end_at'      => $trialEnd ?: '-',
                'next_billing_at'   => $billAt ?: '-',

                'amount'            => $s->amount ?? '0.00',
                'currency'          => $s->currency ?? 'USD',
            ]);
    }
}
