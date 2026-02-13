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

      <div id="subscription" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Subscription</h1>
          <p class="content-description-text">
            Manage your subscription <br>
            and billing preferences.
          </p>
        </div>

        <!-- Desktop Subscription -->
        <div class="cards-desktop">

          <!-- Cancel Query -->
          @if ($hasActiveFpdsQuery)
          <form method="POST" action="{{ route('cancel.subscription') }}">
            <input type="hidden" name="subscription_type" value="fpds_query">
            @csrf
            <div class="card-desktop">

              <div class="content-desktop">
                <div class="details-desktop">
                  <div class="title-desktop">FPDS Query</div>

                  <div class="remaining-desktop"><span class="bold">Status:</span> {{ $fpds_query->status }}</div>
                  <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_query->plan }}</div>
                  <div class="remaining-desktop"><span class="bold">Next billing:</span> {{ $fpds_query->next_billing_at->format('m/d/Y') }}</div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="elem-price">${{ $fpds_query->amount }}</span>
                  </div>

                  <button class="cancel-button" type="button" onclick="cancelSubscription('fpds_query')">
                    Cancel Subscription
                  </button>

                </div>
              </div>

            </div>
          </form>
          @elseif ($hasCancelledFpdsQuery)
          <!-- Cancelled Query -->
          <form method="POST" action="{{ route('restore.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_query">
            <div class="card-desktop">
                <div class="content-desktop">
                    <div class="details-desktop">
                        <div class="title-desktop">FPDS Query</div>

                          <div class="remaining-desktop"><span class="bold">Status:</span> Cancelled</div>
                          <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_query->plan }}</div>
                          <div class="remaining-desktop"><span class="bold">Access until:</span> {{ $fpds_query->expires_at->format('m/d/Y') }}</div>

                <div class="selector-desktop">
                    <select class="dropdown-trigger" name="new_plan" id="restore-plan-select" required>
                        @php
                    $currentPlan = $fpds_query->plan;
                @endphp
                <option value="monthly" {{ $currentPlan === 'monthly' ? 'selected' : '' }}>Monthly ($49.00/month)</option>
                <option value="annual" {{ $currentPlan === 'annual' ? 'selected' : '' }}>Yearly ($390.00/year) — Save 32%</option>
                    </select>
                </div>

                <div class="price-desktop">
                    <span>Total</span>
                    <span id="restore-price">$0.00</span>
                </div>

                <button class="button-desktop" type="button" onclick="restoreSubscription('fpds_query')">Restore Subscription</button>
                    </div>
                </div>
            </div>
          </form>
          @elseif ($hasExpiredFpdsQuery)
          <!-- Expired Query -->
          <form method="POST" action="{{ route('renew.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_query">
            <div class="card-desktop">
                <div class="content-desktop">
                    <div class="details-desktop">
                      <div class="title-desktop">FPDS Query</div>

                      <div class="remaining-desktop"><span class="bold">Status:</span> Expired</div>
                      <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_query->plan }}</div>
                      <div class="remaining-desktop"><span class="bold">Expired on:</span> {{ $fpds_query->expires_at->format('m/d/Y') }}</div>

                      <div class="selector-desktop">
                          <select class="dropdown-trigger" name="new_plan" id="renew-plan-select" required>
                              <option value="monthly">Monthly ($49.00/month)</option>
                              <option value="annual">Yearly ($390.00/year) — Save 32%</option>
                          </select>
                      </div>

                      <div class="price-desktop">
                          <span>Total</span>
                          <span id="renew-price">$0.00</span>
                      </div>

                      <button class="button-desktop" type="button" onclick="renewSubscription('fpds_query')">Renew Subscription</button>
                    </div>
                </div>
            </div>
          </form>
          @else
          <!-- Trial Query -->
          <form method="POST" action="{{ route('order.subscription') }}">
            <input type="hidden" name="subscription_type" value="fpds_query">
            @csrf
            <div class="card-desktop">

              <div class="content-desktop">
                <div class="details-desktop">
                  <div class="title-desktop">FPDS Query</div>
                  <div class="remaining-desktop"><span class="bold">Status:</span> Not Subscribed</div>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="subscription_plan" id="elem-reports-select" required>
                      <option value="monthly" data-price="49.00">Monthly ($49.00/month)</option>
                      <option value="annual" data-price="390.00">Yearly ($390.00/year) — Save 32%</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="elem-price">$0.00</span>
                  </div>

                  <button class="button-desktop" type="button" onclick="startTrial('fpds_query')">Start 7‑Day Free Trial</button>
                </div>
              </div>

            </div>
          </form>
          @endif


          {{-- Cancel Reports --}}
          @if ($hasActiveFpdsReports)
          <form method="POST" action="{{ route('cancel.subscription') }}">
            <input type="hidden" name="subscription_type" value="fpds_reports">
            @csrf
            <div class="card-desktop">
              <div class="content-desktop">
                <div class="details-desktop">
                  <div class="title-desktop">FPDS Reports</div>

                  <div class="remaining-desktop"><span class="bold">Status:</span> {{ $fpds_reports->status }}</div>
                  <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                  <div class="remaining-desktop"><span class="bold">Next billing:</span> {{ $fpds_reports->next_billing_at->format('m/d/Y') }}</div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="composite-price-desktop">${{ $fpds_reports->amount }}</span>
                  </div>

                  <button class="cancel-button" type="button" onclick="cancelSubscription('fpds_reports')">Cancel Subscription</button>
                </div>
              </div>
            </div>
          </form>
          @elseif ($hasCancelledFpdsReports)

          {{-- Cancelled Reports --}}
          <form method="POST" action="{{ route('restore.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_reports">
            <div class="card-desktop">
                <div class="content-desktop">
                    <div class="details-desktop">
                        <div class="title-desktop">FPDS Reports</div>

                        <div class="remaining-desktop"><span class="bold">Status:</span> Cancelled</div>
                        <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                        <div class="remaining-desktop"><span class="bold">Access until:</span> {{ $fpds_reports->expires_at->format('m/d/Y') }}</div>

                        <div class="selector-desktop">
                            <select class="dropdown-trigger" name="new_plan" id="reports-restore-plan-select" required>
                            @php
                            $currentPlan = $fpds_reports->plan;
                        @endphp
                        <option value="monthly" {{ $currentPlan === 'monthly' ? 'selected' : '' }}>Monthly ($799.00/month)</option>
                        <option value="annual" {{ $currentPlan === 'annual' ? 'selected' : '' }}>Yearly ($6 490.00/year) — Save 32%</option>
                            </select>
                        </div>

                        <div class="price-desktop">
                            <span>Total</span>
                            <span id="reports-restore-price">$0.00</span>
                        </div>

                        <button class="button-desktop" type="button" onclick="restoreSubscription('fpds_reports')">Restore Subscription</button>
                    </div>
                </div>
            </div>
          </form>
          @elseif ($hasExpiredFpdsReports)

          {{-- Expired Reports --}}
          <form method="POST" action="{{ route('renew.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_reports">
            <div class="card-desktop">
                <div class="content-desktop">
                    <div class="details-desktop">
                      <div class="title-desktop">FPDS Reports</div>

                      <div class="remaining-desktop"><span class="bold">Status:</span> Expired</div>
                      <div class="remaining-desktop"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                      <div class="remaining-desktop"><span class="bold">Expired on:</span> {{ $fpds_reports->expires_at->format('m/d/Y') }}</div>

                      <div class="selector-desktop">
                          <select class="dropdown-trigger" name="new_plan" id="reports-renew-plan-select" required>
                              <option value="monthly">Monthly ($799.00/month)</option>
                              <option value="annual">Yearly ($6 490.00/year) — Save 32%</option>
                          </select>
                      </div>

                      <div class="price-desktop">
                          <span>Total</span>
                          <span id="reports-renew-price">$0.00</span>
                      </div>

                      <button class="button-desktop" type="button" onclick="renewSubscription('fpds_reports')">Renew Subscription</button>
                    </div>
                </div>
            </div>
          </form>
          @else

          {{-- Activate Reports --}}
          <form method="POST" action="{{ route('order.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_reports">
            <input type="hidden" name="subscription_status" value="active">
            
            <div class="card-desktop">
              <div class="content-desktop">
                <div class="details-desktop">
                  <h2 class="title-desktop">FPDS Reports</h2>
                  <p class="remaining-desktop"><span class="bold">Status:</span> Not Subscribed</p>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="subscription_plan" id="composite-reports-select" required>
                      <option value="monthly" data-price="149.00">Monthly ($799.00/month)</option>
                      <option value="annual" data-price="670.00">Yearly ($6490.00/year) — Save 32%</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="composite-price-desktop">$0.00</span>
                  </div>

                  <button class="button-desktop" type="button" onclick="activateSubscription('fpds_reports')">Activate</button>
                </div>
              </div>
            </div>
          </form>
          @endif

        </div>

      </div>

    </main>

    {{-- Mobile --}}
    <main class="mobile-dashboard-main">

      <div class="mobile-container">
        <div class="mobile-title">Subscription</div>
        <div class="mobile-content">
          <div class="mobile-description">
            Manage your subscription and billing preferences.
          </div>
          
          
          {{-- Subscription --}}
          <div class="mobile-list">

          {{-- Cancel Query Mobile --}}
          @if ($hasActiveFpdsQuery)
          <form method="POST" action="{{ route('cancel.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_query">
              @csrf
              <div class="cards-mobile">
                <div class="card-mobile">
                  <div class="inner-mobile">
                    <div class="header-mobile">
                      <div class="title-mobile">FPDS Query</div>

                      <div class="remaining-mobile"><span class="bold">Status:</span> {{ $fpds_query->status }}</div>
                      <div class="remaining-mobile"><span class="bold">Plan:</span> {{ $fpds_query->plan }}</div>
                      <div class="remaining-mobile"><span class="bold">Next billing:</span> {{ $fpds_query->next_billing_at->format('m/d/Y') }}</div>
                      
                      <div class="price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="elementary-price-mobile">${{ $fpds_query->amount }}</div>
                      </div>
                    </div>
                    <button class="cancel-button" type="button" onclick="cancelSubscription('fpds_query')">
                      Cancel Subscription
                    </button>
                  </div>
                </div>
          </form>
          @elseif ($hasCancelledFpdsQuery)

          {{-- Cancelled Query Mobile --}}
          <form method="POST" action="{{ route('restore.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_query">
            <div class="cards-mobile">
              <div class="card-mobile">
                <div class="inner-mobile">
                  <div class="header-mobile">
                    <div class="title-mobile">FPDS Query</div>

                    <div class="remaining-mobile"><span class="bold">Status:</span> Cancelled</div>
                    <div class="remaining-mobile"><span class="bold">Plan:</span> {{ $fpds_query->plan }}</div>
                    <div class="remaining-mobile"><span class="bold">Access until:</span> {{ $fpds_query->expires_at->format('m/d/Y') }}</div>
                    <div class="selector-desktop">
                      <select class="dropdown-trigger" name="new_plan" id="mobile-restore-plan-select" required>
                        @php
                        $currentPlan = $fpds_query->plan;
                        @endphp
                        <option value="monthly" {{ $currentPlan === 'monthly' ? 'selected' : '' }}>Monthly ($49.00/month)</option>
                        <option value="annual" {{ $currentPlan === 'annual' ? 'selected' : '' }}>Yearly ($490.00/year) — Save 16%</option>
                      </select>
                    </div>
                    <div class="price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="mobile-restore-price">$0.00</div>
                    </div>
                  </div>
                  <button class="button-mobile">
                    <div class="button-text-mobile" type="button" onclick="restoreSubscription('fpds_query')">Restore Subscription</div>
                  </button>
                </div>
              </div>
            </div>
          </form>
          @elseif ($hasExpiredFpdsQuery)
          
          {{-- Expired Query Mobile --}}
          <form method="POST" action="{{ route('renew.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_query">
            <div class="cards-mobile">
                <div class="card-mobile">
                    <div class="inner-mobile">
                <div class="header-mobile">
                    <div class="title-mobile">FPDS Query</div>
                    <div class="remaining-mobile"><span class="bold">Status:</span> Expired</div>
                    <div class="remaining-mobile"><span class="bold">Expired on:</span> {{ $fpds_query->expires_at->format('M/d/Y') }}</div>

                    <div class="selector-desktop">
                <select class="dropdown-trigger" name="new_plan" id="mobile-renew-plan-select" required>
                    <option value="monthly">Monthly ($49.00/month)</option>
                    <option value="annual">Yearly ($490.00/year) — Save 16%</option>
                </select>
                    </div>

                    <div class="price-mobile">
                <div class="price-label-mobile">Total</div>
                <div class="price-value-mobile" id="mobile-renew-price">$0.00</div>
                    </div>
                </div>
                <button class="button-mobile">
                    <div class="button-text-mobile" type="button" onclick="renewSubscription('fpds_query')">Renew Subscription</div>
                </button>
                    </div>
                </div>
            </div>
          </form>
          @else

          {{-- Trial Query Mobile --}}
          <form method="POST" action="{{ route('order.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_query">
              @csrf
              <div class="cards-mobile">
                <div class="card-mobile">
                  <div class="inner-mobile">
                    <div class="header-mobile">
                      <div class="title-mobile">FPDS Query</div>
                      <div class="remaining-mobile"><span class="bold">Status:</span> Not Subscribed</div>

                      <div class="selector-desktop">
                        <select class="dropdown-trigger" name="subscription_plan" id="mobile-elem-select" required>
                          <option value="monthly" data-price="49.00">Monthly ($49.00/month)</option>
                          <option value="annual" data-price="490.00">Yearly ($490.00/year) — Save 16%</option>
                        </select>
                      </div>

                      <div class="price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="elementary-price-mobile">$49.00</div>
                      </div>

                    </div>
                    <button class="button-mobile">
                      <div class="button-text-mobile" type="button" onclick="startTrial('fpds_query')">Start 7‑Day Free Trial</div>
                    </button>
                  </div>
                </div>
          </form>
          @endif

          {{-- Cancel Reports Mobile --}}
          @if ($hasActiveFpdsReports)
          <form method="POST" action="{{ route('cancel.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_reports">
              @csrf
              <div class="card-mobile">
                <div class="inner-mobile">
                  <div class="header-mobile">
                    <div class="title-mobile">FPDS Reports</div>
                    <div class="remaining-mobile"><span class="bold">Status:</span> {{ $fpds_reports->status }}</div>
                    <div class="remaining-mobile"><span class="bold">Next billing:</span> {{ $fpds_reports->next_billing_at->format('M/d/Y') }}</div>
                    <div class="remaining-mobile"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                    

                    <div class="price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="composite-price-mobile">${{ $fpds_reports->amount }}</div>
                    </div>
                  </div>
                  <button class="cancel-button" type="button" onclick="cancelSubscription('fpds_reports')">
                    Cancel Subscription
                  </button>
                </div>
              </div>
          </form>
          @elseif ($hasCancelledFpdsReports)

          {{-- Cancelled Reports Mobile --}}
          <form method="POST" action="{{ route('restore.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_reports">
            <div class="card-mobile">
                <div class="inner-mobile">
                    <div class="header-mobile">
                        <div class="title-mobile">FPDS Reports</div>

                        <div class="remaining-mobile"><span class="bold">Status:</span> Cancelled</div>
                        <div class="remaining-mobile"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                        <div class="remaining-mobile"><span class="bold">Access until:</span> {{ $fpds_reports->expires_at->format('m/d/Y') }}</div>

                        <div class="selector-desktop">
                            <select class="dropdown-trigger" name="new_plan" id="mobile-reports-restore-plan-select" required>
                            @php
                            $currentPlan = $fpds_reports->plan;
                        @endphp
                        <option value="monthly" {{ $currentPlan === 'monthly' ? 'selected' : '' }}>Monthly ($799.00/month)</option>
                        <option value="annual" {{ $currentPlan === 'annual' ? 'selected' : '' }}>Yearly ($6 490.00/year) — Save 32%</option>
                            </select>
                        </div>

                        <div class="price-mobile">
                            <div class="price-label-mobile">Total</div>
                            <div class="price-value-mobile" id="mobile-reports-restore-price">$0.00</div>
                        </div>
                    </div>
                    <button class="button-mobile">
                        <div class="button-text-mobile" type="button" onclick="restoreSubscription('fpds_reports')">Restore Subscription</div>
                    </button>
                </div>
            </div>
          </form>
          @elseif ($hasExpiredFpdsReports)

          {{-- Expired Reports Mobile --}}
          <form method="POST" action="{{ route('renew.subscription') }}">
            @csrf
            <input type="hidden" name="subscription_type" value="fpds_reports">
            <div class="card-mobile">
                <div class="inner-mobile">
                    <div class="header-mobile">
                <div class="title-mobile">FPDS Reports</div>
                <div class="remaining-mobile"><span class="bold">Status:</span> Expired</div>
                <div class="remaining-mobile"><span class="bold">Plan:</span> {{ $fpds_reports->plan }}</div>
                <div class="remaining-mobile"><span class="bold">Expired on:</span> {{ $fpds_reports->expires_at->format('m/d/Y') }}</div>

                <div class="selector-desktop">
                    <select class="dropdown-trigger" name="new_plan" id="mobile-reports-renew-plan-select" required>
                        <option value="monthly">Monthly ($799.00/month)</option>
                <option value="annual">Yearly ($6 490.00/year) — Save 32%</option>
                    </select>
                </div>

                <div class="price-mobile">
                    <div class="price-label-mobile">Total</div>
                    <div class="price-value-mobile" id="mobile-reports-renew-price">$0.00</div>
                </div>
                    </div>
                    <button class="button-mobile">
                <div class="button-text-mobile" type="button" onclick="renewSubscription('fpds_reports')">Renew Subscription</div>
                    </button>
                </div>
            </div>
          </form>
          @else

          {{-- Activate Reports Mobile --}}
          <form method="POST" action="{{ route('order.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_reports">
              <input type="hidden" name="subscription_status" value="active">
              @csrf
              <div class="card-mobile">
                <div class="inner-mobile">
                  <div class="header-mobile">
                    <div class="title-mobile">FPDS Reports</div>
                    <div class="remaining-mobile"><span class="bold">Status:</span> Not Subscribed</div>

                    <div class="selector-desktop">
                      <select class="dropdown-trigger" name="reports_count" id="mobile-composite-select" required>
                        <option value="monthly" data-price="799.00">Monthly ($799.00/month)</option>
                        <option value="annual" data-price="6490.00">Yearly ($6490.00/year) — Save 32%</option>
                      </select>

                    </div>

                    <div class="price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="composite-price-mobile">$0.00</div>
                    </div>
                  </div>
                  <button class="button-mobile">
                    <div class="button-text-mobile" type="button" onclick="activateSubscription('fpds_reports')">Activate</div>
                  </button>
                </div>
              </div>
          </form>
          @endif

          </div>

        </div>

      </div>

    </main>

  </div>

  @include('account.popup')
  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
