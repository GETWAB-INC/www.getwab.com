<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\DB;


class SendHelloEmail extends Command
{
    protected $signature = 'send:helloemail';
    protected $description = 'Sends a hello email to the company who have not received one.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
    $company = DB::table('email_companies')
                ->whereNull('hello_email')
                ->where('subscribe', 0)
                ->first();

    if ($company) {
        Mail::to($company->recipient_email)->send(new HelloEmail($company));

        DB::table('email_companies')
          ->where('id', $company->id)
          ->update(['hello_email' => now()]);
    } else {
        $this->info('no email to send');
    }
}

}
