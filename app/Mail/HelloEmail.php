<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function build()
    {
        $email = $this->view('mail.hello_email')->subject('Proposal for Government Contract Subcontracting');

        $contractStartDate = $this->company->contract_start_date ? Carbon::parse($this->company->contract_start_date) : null;
        $contractEndDate = $this->company->contract_end_date ? Carbon::parse($this->company->contract_end_date) : null;

        $email->with([
            'name' => $this->company->recipient_name ?? 'No Name Provided',
            'companyName' => $this->company->company_name ?? 'No Company Provided',
            'contractId' => $this->company->contract_id ?? 'No Contract ID',
            'contractTopic' => $this->company->contract_topic ?? 'No Contract Topic',
            'contractDescription' => $this->company->contract_description ?? 'No Description',
            'additionalDetails' => $this->company->additional_details ?? 'No Additional Details',
            'contractStartDate' => $contractStartDate ? $contractStartDate->format('m/d/Y') : 'No Start Date',
            'contractEndDate' => $contractEndDate ? $contractEndDate->format('m/d/Y') : 'No End Date'
        ]);
        return $email;
    }
}
