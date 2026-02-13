<!DOCTYPE html>
<html lang="en">

<head>
  @include('include.head')
  <title>Account</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/account.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .bold {
      font-weight: bold;
    }
    @media (max-width: 767px) {
      .dashboard-sidebar {
        display: none !important;
      }
    }
  </style>
</head>

<body>
  @include('errors.success')
  @include('errors.error')
  @include('include.header')
  <div class="dashboard-container">

    @include('account.aside')

    <!-- Desktop -->
    <main class="dashboard-main">

<div class="container" style="max-width: 1200px;">

  <h1>Billing Monitor</h1>

  {{-- Filters --}}
  <form method="GET" action="{{ route('admin.billing-monitor') }}" style="margin: 16px 0; padding: 12px; border: 1px solid #ddd;">
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <div>
        <label>Days</label><br/>
        <input type="number" name="days" value="{{ $filters['days'] }}" min="1" max="90" style="width:90px;">
      </div>

      <div>
        <label>reference_number</label><br/>
        <input type="text" name="reference_number" value="{{ $filters['reference'] }}" style="width:260px;">
      </div>

      <div>
        <label>transaction_id</label><br/>
        <input type="text" name="transaction_id" value="{{ $filters['txid'] }}" style="width:260px;">
      </div>

      <div>
        <label>decision</label><br/>
        <input type="text" name="decision" value="{{ $filters['decision'] }}" placeholder="ACCEPT/REJECT" style="width:140px;">
      </div>

      <div>
        <label>process_status</label><br/>
        <input type="text" name="process_status" value="{{ $filters['status'] }}" placeholder="ok/error/skipped" style="width:140px;">
      </div>

      <div>
        <label>flow</label><br/>
        <input type="text" name="flow" value="{{ $filters['flow'] }}" placeholder="pay/token_create" style="width:160px;">
      </div>

      <div style="align-self:end;">
        <button type="submit">Apply</button>
        <a href="{{ route('admin.billing-monitor') }}" style="margin-left:10px;">Reset</a>
      </div>
    </div>
  </form>

  {{-- Metrics --}}
  <div style="display:flex; flex-wrap:wrap; gap:12px; margin-bottom: 16px;">
    <div style="flex:1; min-width:260px; border:1px solid #ddd; padding:12px;">
      <h3 style="margin-top:0;">ACCEPT → processed ok</h3>
      <div>Total ACCEPT: <b>{{ $metrics['accept_total'] }}</b></div>
      <div>Processed OK: <b>{{ $metrics['accept_ok'] }}</b></div>
      <div>OK %: <b>{{ $metrics['accept_pct'] }}%</b></div>
    </div>

    <div style="flex:1; min-width:260px; border:1px solid #ddd; padding:12px;">
      <h3 style="margin-top:0;">pending_orders</h3>

      @if(!$pending['table_exists'])
        <div style="color:#666;">Table not found (Schema::hasTable = false).</div>
      @else
        @if(isset($pending['error']))
          <div style="color:#b00;">Error: {{ $pending['error'] }}</div>
        @else
          <div>Failed total: <b>{{ $pending['failed_total'] }}</b></div>
          <div>Failed 24h: <b>{{ $pending['failed_24h'] }}</b></div>
          <div>Processed 24h: <b>{{ $pending['processed_24h'] }}</b></div>
        @endif
      @endif
    </div>

    <div style="flex:1; min-width:260px; border:1px solid #ddd; padding:12px;">
      <h3 style="margin-top:0;">Renew success rate</h3>

      @if(isset($renew['error']))
        <div style="color:#b00;">Error: {{ $renew['error'] }}</div>
      @else
        <div>Total renew: <b>{{ $renew['total'] }}</b></div>
        <div>Paid: <b>{{ $renew['paid'] }}</b></div>
        <div>Failed: <b>{{ $renew['failed'] }}</b></div>
        <div>Success %: <b>{{ $renew['pct'] }}%</b></div>
        <div style="color:#666; margin-top:6px; font-size: 12px;">{{ $renew['note'] }}</div>
      @endif
    </div>
  </div>

  {{-- Events table --}}
  <h2>payment_events (latest)</h2>

  <div style="overflow:auto; border:1px solid #ddd;">
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="background:#f7f7f7;">
          <th style="padding:8px; border-bottom:1px solid #ddd;">id</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">created_at</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">reference_number</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">transaction_id</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">flow</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">decision</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">reason_code</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">process_status</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">processed_at</th>
          <th style="padding:8px; border-bottom:1px solid #ddd;">process_error</th>
        </tr>
      </thead>
      <tbody>
        @forelse($events as $e)
          <tr>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->id }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->created_at }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->reference_number }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->transaction_id }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->flow }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->decision }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->reason_code }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">
              <b>{{ $e->process_status }}</b>
            </td>
            <td style="padding:8px; border-bottom:1px solid #eee;">{{ $e->processed_at }}</td>
            <td style="padding:8px; border-bottom:1px solid #eee; color:#b00;">
              {{ \Illuminate\Support\Str::limit((string)$e->process_error, 120) }}
            </td>
          </tr>
        @empty
          <tr><td colspan="10" style="padding:12px;">No events found for current filter.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top: 12px;">
    {{ $events->links() }}
  </div>

</div>



    </main>

  </div>

  @include('account.popup')
  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
