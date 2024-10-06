<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class EmailCompanyController extends Controller
{
    public function create()
    {
        return view('add-company');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'nullable|string|max:255',
            'recipient_email' => 'required|email|unique:email_companies,recipient_email',
            'company_name' => 'nullable|string|max:255',
            'contract_id' => 'nullable|string|max:50',
            'contract_topic' => 'nullable|string|max:255',
            'contract_description' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'contract_start_date' => 'nullable|date',
            'contract_end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect('add-company')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        DB::table('email_companies')->insert([
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

        return redirect()->route('dashboard')->with('success', 'Company added successfully!');
    }

    public function unsubscribe(Request $request)
    {
        $email = $request->input('email');

        $exists = DB::table('email_companies')->where('recipient_email', $email)->exists();

        if ($exists) {
            DB::table('email_companies')->where('recipient_email', $email)
                ->update(['subscribe' => 1]);

            return view('mail.unsubscribe_success', ['email' => $email])
                ->with('success', 'You have been successfully unsubscribed.');
        } else {
            return back()->with('error', 'Email not found.');
        }
    }

    public function getDkim()
{
    // Чтение содержимого файлов конфигурации DKIM
    $dkimKeyTable = shell_exec('cat /etc/opendkim/KeyTable');
    $dkimSigningTable = shell_exec('cat /etc/opendkim/SigningTable');
    $trustedHosts = shell_exec('cat /etc/opendkim/TrustedHosts');

    // Получение прав доступа к файлам и их владельцев
    $keyTablePermissions = shell_exec('ls -l /etc/opendkim/KeyTable');
    $signingTablePermissions = shell_exec('ls -l /etc/opendkim/SigningTable');
    $trustedHostsPermissions = shell_exec('ls -l /etc/opendkim/TrustedHosts');

    // Статусы сервисов
    $opendkimStatus = shell_exec('systemctl status opendkim | grep Active');
    $postfixStatus = shell_exec('systemctl status postfix | grep Active');

    // Конфигурация Postfix для DKIM
    $postfixConfig = shell_exec('postconf | grep milter');

    // Проверка записи DKIM в DNS
    $dnsDkimRecord = shell_exec('dig TXT s1._domainkey.getwabinc.com');

    // Логи OpenDKIM
    $opendkimLogs = shell_exec('tail -n 20 /var/log/mail.log | grep opendkim');

    // Логи Postfix для проверки ошибок
    $postfixErrorLogs = shell_exec('tail -n 20 /var/log/mail.log | grep postfix');

    // Проверка сокета OpenDKIM
    $opendkimSocketExists = file_exists('/run/opendkim/opendkim.sock');
    $opendkimSocketPermissions = shell_exec('ls -l /run/opendkim/opendkim.sock');

    // Конфигурация OpenDKIM
    $opendkimConfig = shell_exec('cat /etc/opendkim.conf');

    // Проверка селектора DKIM в Postfix
    $postfixSelectorConfig = shell_exec('postconf | grep -i dkim');

    // Проверка обратной DNS-записи (PTR)
    $reverseDnsRecord = shell_exec('dig -x 45.88.106.243');

    // Существование файлов конфигурации
    $keyTableExists = file_exists('/etc/opendkim/KeyTable');
    $signingTableExists = file_exists('/etc/opendkim/SigningTable');
    $trustedHostsExists = file_exists('/etc/opendkim/TrustedHosts');

    return view('dkim', compact(
        'dkimKeyTable',
        'dkimSigningTable',
        'trustedHosts',
        'keyTablePermissions',
        'signingTablePermissions',
        'trustedHostsPermissions',
        'opendkimStatus',
        'postfixStatus',
        'postfixConfig',
        'dnsDkimRecord',
        'opendkimLogs',
        'postfixErrorLogs',
        'opendkimSocketExists',
        'opendkimSocketPermissions',
        'opendkimConfig',
        'postfixSelectorConfig',
        'reverseDnsRecord',
        'keyTableExists',
        'signingTableExists',
        'trustedHostsExists'
    ));
}

public function showLogs()
{
    // Путь к файлу логов
    $logPath = storage_path('logs/helloemail.log');

    // Проверяем, существует ли файл логов
    if (File::exists($logPath)) {
        // Читаем содержимое файла
        $logs = File::get($logPath);

        // Разделяем содержимое файла по строкам
        $logLines = explode(PHP_EOL, $logs);

        // Убираем пустые строки
        $logLines = array_filter($logLines);

        // Переворачиваем строки для реверсного отображения
        $logLines = array_reverse($logLines);

        // Присоединяем строки обратно
        $logs = implode(PHP_EOL, $logLines);

        return view('logs', ['logs' => $logs]);
    } else {
        return view('logs', ['logs' => 'Log file not found.']);
    }
}

}
