<!DOCTYPE html>
<html lang="en">
<head>
  @include('include.head')
  <title>Billing Monitor</title>

  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/account.css') }}" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    /* Billing Monitor additions (в твоей стилистике) */
    .bm-wrap { max-width: 1400px; width: 100%; }
    .bm-table-wrap { width: 100%; overflow: auto; border-radius: 7px; background: #282828; outline: 1px #474747 solid; outline-offset: -1px; }
    .bm-table { width: 100%; border-collapse: collapse; min-width: 980px; }
    .bm-table th, .bm-table td { padding: 14px 16px; border-bottom: 1px solid #3a3a3a; vertical-align: top; color: white; font-size: 16px; }
    .bm-table th { color: #b5d9a7; font-size: 16px; font-weight: 700; text-align: left; background: #1f1f1f; position: sticky; top: 0; z-index: 1; }
    .bm-muted { color: #afbcb8; }
    .bm-bad { color: #ff8a80; }
    .bm-pill { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 999px; background: #1f1f1f; outline: 1px #3a3a3a solid; outline-offset: -1px; }
    .bm-form-row { display: flex; flex-wrap: wrap; gap: 16px; width: 100%; }
    .bm-field { display: flex; flex-direction: column; gap: 8px; min-width: 180px; flex: 1; }
    .bm-label { color: #afbcb8; font-size: 14px; }
    .bm-input {
      height: 48px;
      border-radius: 7px;
      outline: 2px white solid;
      outline-offset: -2px;
      background: transparent;
      color: white;
      padding: 0 14px;
      font-size: 16px;
    }
    .bm-actions { display: flex; gap: 12px; align-items: flex-end; }
    .bm-reset { color: #b5d9a7; text-decoration: underline; text-decoration-color: transparent; transition: text-decoration-color .2s; }
    .bm-reset:hover { text-decoration-color: #b5d9a7; }

    /* Pagination (laravel links) a bit readable on dark */
    .pagination { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 18px; }
    .pagination a, .pagination span {
      padding: 10px 14px;
      border-radius: 7px;
      outline: 1px #474747 solid;
      outline-offset: -1px;
      color: white;
      background: #282828;
      font-size: 16px;
    }
    .pagination .active span { background: #1f1f1f; color: #b5d9a7; }

    @media (max-width: 767px) {
      .dashboard-sidebar { display: none !important; }
      .dashboard-main { padding: 24px; }
      .bm-table { min-width: 900px; }
    }
  </style>
</head>

<body>
  @include('errors.success')
  @include('errors.error')
  @include('include.header')

  <div class="dashboard-container">

    {{-- LEFT --}}
    @include('account.aside')

    {{-- RIGHT --}}
    <main class="dashboard-main">
      <div class="bm-wrap">

        <div class="title-and-description">
          <div>
            <h1 class="content-main-title" style="width:auto;">Billing</h1>
            <p class="content-description-text">Monitor payment events and processing health</p>
          </div>
        </div>

        {{-- FILTERS CARD --}}
        <div class="cards-desktop" style="margin-bottom: 24px;">
          <div class="card-desktop" style="max-width: 100%;">
            <div class="content-desktop">
              <div class="details-desktop" style="align-items: stretch;">
                <div class="title-desktop" style="text-align:left;">Filters</div>

                <form method="GET" action="{{ route('billing-monitor') }}">
                  <div class="bm-form-row">
                    <div class="bm-field" style="max-width:120px;">
                      <div class="bm-label">Days</div>
                      <input class="bm-input" type="number" name="days" value="{{ $filters['days'] }}" min="1" max="90">
                    </div>

                    <div class="bm-field">
                      <div class="bm-label">reference_number</div>
                      <input class="bm-input" type="text" name="reference_number" value="{{ $filters['reference'] }}">
                    </div>

                    <div class="bm-field">
                      <div class="bm-label">transaction_id</div>
                      <input class="bm-input" type="text" name="transaction_id" value="{{ $filters['txid'] }}">
                    </div>

                    <div class="bm-field" style="max-width:180px;">
                      <div class="bm-label">decision</div>
                      <input class="bm-input" type="text" name="decision" value="{{ $filters['decision'] }}" placeholder="ACCEPT/REJECT">
                    </div>

                    <div class="bm-field" style="max-width:220px;">
                      <div class="bm-label">process_status</div>
                      <input class="bm-input" type="text" name="process_status" value="{{ $filters['status'] }}" placeholder="ok/error/skipped">
                    </div>

                    <div class="bm-field" style="max-width:220px;">
                      <div class="bm-label">flow</div>
                      <input class="bm-input" type="text" name="flow" value="{{ $filters['flow'] }}" placeholder="pay/token_create">
                    </div>

                    <div class="bm-actions">
                      <button type="submit" class="button-desktop" style="width: 220px;">Apply</button>
                      <a class="bm-reset" href="{{ route('billing-monitor') }}">Reset</a>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>

        {{-- METRICS CARDS --}}
        <div class="cards-desktop" style="margin-bottom: 24px;">
          <div class="card-desktop">
            <div class="content-desktop">
              <div class="details-desktop" style="align-items: stretch;">
                <div class="title-desktop" style="text-align:left;">ACCEPT → processed ok</div>
                <div class="remaining-desktop">
                  <div class="bm-pill">Total ACCEPT: <b>{{ $metrics['accept_total'] }}</b></div>
                  <div style="height:10px;"></div>
                  <div class="bm-pill">Processed OK: <b>{{ $metrics['accept_ok'] }}</b></div>
                  <div style="height:10px;"></div>
                  <div class="bm-pill">OK %: <b>{{ $metrics['accept_pct'] }}%</b></div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-desktop">
            <div class="content-desktop">
              <div class="details-desktop" style="align-items: stretch;">
                <div class="title-desktop" style="text-align:left;">pending_orders</div>
                <div class="remaining-desktop">
                  @if(!$pending['table_exists'])
                    <div class="bm-muted">Table not found (Schema::hasTable = false).</div>
                  @else
                    @if(isset($pending['error']))
                      <div class="bm-bad">Error: {{ $pending['error'] }}</div>
                    @else
                      <div class="bm-pill">Failed total: <b>{{ $pending['failed_total'] }}</b></div>
                      <div style="height:10px;"></div>
                      <div class="bm-pill">Failed 24h: <b>{{ $pending['failed_24h'] }}</b></div>
                      <div style="height:10px;"></div>
                      <div class="bm-pill">Processed 24h: <b>{{ $pending['processed_24h'] }}</b></div>
                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="card-desktop">
            <div class="content-desktop">
              <div class="details-desktop" style="align-items: stretch;">
                <div class="title-desktop" style="text-align:left;">Renew success rate</div>
                <div class="remaining-desktop">
                  @if(isset($renew['error']))
                    <div class="bm-bad">Error: {{ $renew['error'] }}</div>
                  @else
                    <div class="bm-pill">Total renew: <b>{{ $renew['total'] }}</b></div>
                    <div style="height:10px;"></div>
                    <div class="bm-pill">Paid: <b>{{ $renew['paid'] }}</b></div>
                    <div style="height:10px;"></div>
                    <div class="bm-pill">Failed: <b>{{ $renew['failed'] }}</b></div>
                    <div style="height:10px;"></div>
                    <div class="bm-pill">Success %: <b>{{ $renew['pct'] }}%</b></div>
                    <div class="bm-muted" style="margin-top: 10px; font-size: 12px;">{{ $renew['note'] }}</div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- EVENTS TABLE --}}
        <div class="title-desktop" style="text-align:left; margin-bottom: 14px;">payment_events (latest)</div>

        <div class="bm-table-wrap">
          <table class="bm-table">
            <thead>
              <tr>
                <th>id</th>
                <th>created_at</th>
                <th>reference_number</th>
                <th>transaction_id</th>
                <th>flow</th>
                <th>decision</th>
                <th>reason_code</th>
                <th>process_status</th>
                <th>processed_at</th>
                <th>process_error</th>
              </tr>
            </thead>
            <tbody>
              @forelse($events as $e)
                <tr>
                  <td>{{ $e->id }}</td>
                  <td class="bm-muted">{{ $e->created_at }}</td>
                  <td>{{ $e->reference_number }}</td>
                  <td class="bm-muted">{{ $e->transaction_id }}</td>
                  <td>{{ $e->flow }}</td>
                  <td><b>{{ $e->decision }}</b></td>
                  <td class="bm-muted">{{ $e->reason_code }}</td>
                  <td><b>{{ $e->process_status }}</b></td>
                  <td class="bm-muted">{{ $e->processed_at }}</td>
                  <td class="bm-bad">{{ \Illuminate\Support\Str::limit((string)$e->process_error, 140) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="10" class="bm-muted" style="padding: 18px;">No events found for current filter.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div>
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
