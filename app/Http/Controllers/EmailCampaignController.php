<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmailCampaignController extends Controller
{
    public function create()
    {
        return view('add-campaign');
    }

    public function store(Request $request)
    {
        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:255',
            'recipient_email' => 'required|email|unique:email_campaigns,recipient_email',
            'company_name' => 'nullable|string|max:255',
            'contract_id' => 'nullable|string|max:50',
            'contract_topic' => 'nullable|string|max:255',
            'contract_description' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
        ]);

        // Вставка данных в таблицу 'campaigns'
        DB::table('email_campaigns')->insert([
            'recipient_name' => $request->input('recipient_name'),
            'recipient_email' => $request->input('recipient_email'),
            'company_name' => $request->input('company_name'),
            'contract_id' => $request->input('contract_id'),
            'contract_topic' => $request->input('contract_topic'),
            'contract_description' => $request->input('contract_description'),
            'additional_details' => $request->input('additional_details'),
            'contract_start_date' => $request->input('contract_start_date'),
            'contract_end_date' => $request->input('contract_end_date'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Перенаправление на страницу дашборда с сообщением об успехе
        return redirect()->route('dashboard')->with('success', 'Campaign added successfully!');
    }
}
