<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Admin gate (как у тебя в adminer): только твой email
        $user = Auth::user();
        if (!$user || $user->email !== 'ilia.oborin@getwab.com') {
            abort(404);
        }

        // ===== Filters =====
        $reference = trim((string)$request->get('reference_number', ''));
        $txid      = trim((string)$request->get('transaction_id', ''));
        $decision  = trim((string)$request->get('decision', ''));
        $status    = trim((string)$request->get('process_status', ''));
        $flow      = trim((string)$request->get('flow', ''));
        $days      = (int)$request->get('days', 7);
        if ($days <= 0 || $days > 90) $days = 7;

        $fromTs = now()->subDays($days);

        // ===== payment_events list =====
        $q = DB::table('payment_events')
            ->where('created_at', '>=', $fromTs)
            ->orderByDesc('id');

        if ($reference !== '') $q->where('reference_number', $reference);
        if ($txid !== '')      $q->where('transaction_id', $txid);
        if ($decision !== '')  $q->where('decision', $decision);
        if ($status !== '')    $q->where('process_status', $status);
        if ($flow !== '')      $q->where('flow', $flow);

        $events = $q->paginate(50)->appends($request->query());

        // ===== Metrics: ACCEPT -> processed ok % =====
        $acceptAgg = DB::table('payment_events')
            ->selectRaw("COUNT(*) as total_accept")
            ->selectRaw("SUM(process_status = 'ok') as accept_ok")
            ->where('created_at', '>=', $fromTs)
            ->where('decision', 'ACCEPT')
            ->first();

        $totalAccept = (int)($acceptAgg->total_accept ?? 0);
        $acceptOk    = (int)($acceptAgg->accept_ok ?? 0);
        $acceptPct   = $totalAccept > 0 ? round(100 * $acceptOk / $totalAccept, 2) : 0.0;

        // ===== pending_orders (optional) =====
        $pending = [
            'table_exists' => false,
            'failed_total' => null,
            'failed_24h'   => null,
            'processed_24h'=> null,
        ];

        if (Schema::hasTable('pending_orders')) {
            $pending['table_exists'] = true;

            try {
                $pending['failed_total'] = (int) DB::table('pending_orders')
                    ->where('status', 'failed')
                    ->count();

                $pending['failed_24h'] = (int) DB::table('pending_orders')
                    ->where('status', 'failed')
                    ->where('processed_at', '>=', now()->subDay())
                    ->count();

                $pending['processed_24h'] = (int) DB::table('pending_orders')
                    ->where('status', 'processed')
                    ->where('processed_at', '>=', now()->subDay())
                    ->count();
            } catch (\Throwable $e) {
                $pending['error'] = $e->getMessage();
            }
        }

        // ===== Renew metrics (heuristic): billing_records.description LIKE 'RENEW:%' =====
        // В renew-flow просто ставь description = "RENEW: ...."
        $renew = [
            'total' => 0,
            'paid'  => 0,
            'failed'=> 0,
            'pct'   => 0.0,
            'note'  => 'Counts billing_records where description LIKE "RENEW:%". Add this prefix in renew flow.',
        ];

        try {
            $renewAgg = DB::table('billing_records')
                ->selectRaw("COUNT(*) as total")
                ->selectRaw("SUM(status IN ('completed','Paid')) as paid")
                ->selectRaw("SUM(status IN ('failed','Declined','Failed')) as failed")
                ->where('created_at', '>=', $fromTs)
                ->where('description', 'like', 'RENEW:%')
                ->first();

            $renew['total'] = (int)($renewAgg->total ?? 0);
            $renew['paid']  = (int)($renewAgg->paid ?? 0);
            $renew['failed']= (int)($renewAgg->failed ?? 0);
            $renew['pct']   = $renew['total'] > 0 ? round(100 * $renew['paid'] / $renew['total'], 2) : 0.0;
        } catch (\Throwable $e) {
            $renew['error'] = $e->getMessage();
        }

        return view('billing-monitor', [
            'events'  => $events,
            'filters' => compact('reference', 'txid', 'decision', 'status', 'flow', 'days'),
            'metrics' => [
                'accept_total' => $totalAccept,
                'accept_ok'    => $acceptOk,
                'accept_pct'   => $acceptPct,
            ],
            'pending' => $pending,
            'renew'   => $renew,
        ]);
    }
}
