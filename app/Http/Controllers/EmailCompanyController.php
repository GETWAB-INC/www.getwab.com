<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class EmailCompanyController extends Controller
{
    public function create()
    {
        return view('add-company');
    }

    public function viewHelloEmail($id)
    {

        $company = DB::table('email_companies')->where('id', $id)->first();


        return view('mail.hello_email', ['company' => $company]);
    }

    public function viewAgainEmail($id)
    {

        $company = DB::table('email_companies')->where('id', $id)->first();


        return view('mail.hello_again', ['company' => $company]);
    }

    public function bussinesViewHelloEmail($id)
    {

        $company = DB::table('empstateweb_emails')->where('id', $id)->first();


        return view('mail.bussines.hello_email', ['company' => $company]);
    }

    public function bussinesViewAgainEmail($id)
    {

        $company = DB::table('empstateweb_emails')->where('id', $id)->first();


        return view('mail.bussines.hello_again', ['company' => $company]);
    }

    public function edit($id)
    {
        $company = DB::table('email_companies')->where('id', $id)->first();

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'Company not found.');
        }

        return view('edit-company', ['company' => $company]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'nullable|string|max:255',
            'recipient_email' => 'required|email|unique:email_companies,recipient_email,' . $id,
            'company_name' => 'nullable|string|max:255',
            'contract_id' => 'nullable|string|max:50',
            'contract_topic' => 'nullable|string|max:255',
            'contract_description' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-company', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('email_companies')->where('id', $id)->update([
            'recipient_name' => $request->input('recipient_name'),
            'recipient_email' => $request->input('recipient_email'),
            'company_name' => $request->input('company_name'),
            'contract_id' => $request->input('contract_id'),
            'contract_topic' => $request->input('contract_topic'),
            'contract_description' => $request->input('contract_description'),
            'additional_details' => $request->input('additional_details'),
            'contract_start_date' => $request->input('contract_start_date'),
            'contract_end_date' => $request->input('contract_end_date'),
            'updated_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Company updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('email_companies')->where('id', $id)->delete();
        return redirect()->route('dashboard')->with('success', 'Company deleted successfully.');
    }

    /**
    * Method for displaying the unsubscribe page (GET request)
    * This method will be called when clicking on the link in the email.
    */
    public function showUnsubscribePage(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Email not provided.');
        }

        return view('mail.unsubscribe', ['email' => $email]);
    }

    /**
    * Method for handling unsubscribe requests (POST request)
    * This method processes data received via JavaScript using a POST request. 
    */
    public function unsubscribe(Request $request)
    {
        $email = $request->input('email');
        $screenResolution = $request->input('screen_resolution');
        $timeZone = $request->input('time_zone');
        $browserLanguage = $request->input('browser_language');
        $referrer = $request->input('referrer');

        Log::info('Unsubscribe Request Data:', [
            'email' => $email,
            'screen_resolution' => $screenResolution,
            'time_zone' => $timeZone,
            'browser_language' => $browserLanguage,
            'referrer' => $referrer,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $exists = DB::table('email_companies')->where('recipient_email', $email)->exists();

        if ($exists) {
            DB::table('email_companies')->where('recipient_email', $email)->update(['subscribe' => 1]);

            $unsubscribeLogExists = DB::table('unsubscribe_logs')->where('email', $email)->exists();

            if ($unsubscribeLogExists) {
                DB::table('unsubscribe_logs')->where('email', $email)->update([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referrer' => $referrer,
                    'screen_resolution' => $screenResolution,
                    'time_zone' => $timeZone,
                    'browser_language' => $browserLanguage,
                    'unsubscribed_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('unsubscribe_logs')->insert([
                    'email' => $email,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referrer' => $referrer,
                    'screen_resolution' => $screenResolution,
                    'time_zone' => $timeZone,
                    'browser_language' => $browserLanguage,
                    'unsubscribed_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return view('mail.unsubscribe_success', ['email' => $email])->with('success', 'You have been successfully unsubscribed.');
        } else {
            Log::warning('Email not found for unsubscription:', ['email' => $email]);
            return back()->with('error', 'Email not found.');
        }
    }

    public function showUnsubscribeDetails($company_id)
    {
        $company = DB::table('email_companies')->where('id', $company_id)->first();

        if (!$company) {
            return redirect()->back()->with('error', 'Company not found.');
        }

        $unsubscribeLog = DB::table('unsubscribe_logs')->where('email', $company->recipient_email)->first();

        if (!$unsubscribeLog) {
            return view('mail.unsubscribe_details', ['message' => 'No unsubscription log found for this company.', 'company' => $company]);
        }

        return view('mail.unsubscribe_details', ['unsubscribeLog' => $unsubscribeLog, 'company' => $company]);
    }

    public function logs()
    {
        $logPathHelloEmail = storage_path('logs/helloemail.log');
        $logPathAgainEmail = storage_path('logs/againemail.log');
        $logPathLastEmail = storage_path('logs/lastemail.log');

        $getLastLines = function ($logPath) {
            if (File::exists($logPath)) {
                $lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                return array_reverse(array_slice($lines, -15));
            }
            return ['Log file not found.'];
        };

        $helloEmailLogs = $getLastLines($logPathHelloEmail);
        $againEmailLogs = $getLastLines($logPathAgainEmail);
        $lastEmailLogs = $getLastLines($logPathLastEmail);

        return view('logs', [
            'helloEmailLogs' => $helloEmailLogs,
            'againEmailLogs' => $againEmailLogs,
            'lastEmailLogs' => $lastEmailLogs
        ]);
    }

    public function showHelloEmailLogs()
    {
        // Путь к файлу логов
        $logPath = storage_path('logs/helloemail.log');

        if (File::exists($logPath)) {
            $logs = File::get($logPath);

            $logLines = explode(PHP_EOL, $logs);

            $logLines = array_filter($logLines);

            $logLines = array_reverse($logLines);

            $logsCollection = collect($logLines);

            $perPage = 20;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageLogs = $logsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

            $paginatedLogs = new LengthAwarePaginator(
                $currentPageLogs,
                $logsCollection->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

            return view('hello-email-logs', ['logs' => $paginatedLogs]);
        } else {
            return view('hello-email-logs', ['logs' => 'Log file not found.']);
        }
    }

    public function showAgainEmailLogs()
    {
        $logPath = storage_path('logs/againemail.log');

        if (File::exists($logPath)) {
            $logs = File::get($logPath);

            $logLines = explode(PHP_EOL, $logs);

            $logLines = array_filter($logLines);

            $logLines = array_reverse($logLines);

            $logsCollection = collect($logLines);

            $perPage = 20;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageLogs = $logsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

            $paginatedLogs = new LengthAwarePaginator(
                $currentPageLogs,
                $logsCollection->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

            return view('again-email-logs', ['logs' => $paginatedLogs]);
        } else {
            return view('again-email-logs', ['logs' => 'Log file not found.']);
        }
    }

    public function showLastEmailLogs()
    {
        $logPath = storage_path('logs/lastemail.log');

        if (File::exists($logPath)) {
            $logs = File::get($logPath);

            $logLines = explode(PHP_EOL, $logs);

            $logLines = array_filter($logLines);

            $logLines = array_reverse($logLines);

            $logsCollection = collect($logLines);

            $perPage = 20;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageLogs = $logsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

            $paginatedLogs = new LengthAwarePaginator(
                $currentPageLogs,
                $logsCollection->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

            return view('last-email-logs', ['logs' => $paginatedLogs]);
        } else {
            return view('last-email-logs', ['logs' => 'Log file not found.']);
        }
    }
}
