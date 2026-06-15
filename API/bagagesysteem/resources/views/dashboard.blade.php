<!doctype html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="/Styling/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.8.0/dist/tabler-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script src="/scripts/loadcolors.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" defer></script>
  </head>
  <body class="dashboard-body">
    @php
        $kpiTotalBagage = $summary['totalBagage'] ?? 0;
        $kpiProcessedToday = $summary['processedToday'] ?? 0;
        $kpiMissing = $summary['missing'] ?? 0;
        $kpiMachinesActive = $summary['machinesActive'] ?? 0;
        $kpiMachinesTotal = $summary['machinesTotal'] ?? 0;
        $kpiMachinesMaintenance = $summary['machinesMaintenance'] ?? 0;
        $chartHourLabels = $hourLabels ?? [];
        $chartProcessedData = $processedData ?? [];
        $chartDeliveredData = $deliveredData ?? [];
        $chartStatusLabels = $bagageStatusLabels ?? [];
        $chartStatusData = $bagageStatusData ?? [];
        $openGates = collect($gates ?? [])->where('is_open', true)->count();
        $gateCollection = collect($gateCards ?? []);
        $machineCollection = collect($machineCards ?? []);
        $eventCollection = collect($eventCards ?? []);
        $zoneTotals = [
            'Zone 0' => $gateCollection->where('open', true)->count(),
            'Zone 1' => $gateCollection->where('open', false)->count(),
            'Zone 2' => $openGates,
            'Zone 3' => $kpiMissing,
            'Zone 4' => $kpiMachinesActive,
        ];
        $zoneMeta = [
          ['label' => 'Zone 0', 'name' => 'Inname', 'icon' => 'ti-luggage', 'class' => 'zone-0'],
          ['label' => 'Zone 1', 'name' => 'Sortering', 'icon' => 'ti-git-branch', 'class' => 'zone-1'],
          ['label' => 'Zone 2', 'name' => 'Ophaalband', 'icon' => 'ti-rotate-clockwise', 'class' => 'zone-2'],
          ['label' => 'Zone 3', 'name' => 'Opslag', 'icon' => 'ti-building-warehouse', 'class' => 'zone-3'],
          ['label' => 'Zone 4', 'name' => 'Gates', 'icon' => 'ti-door-enter', 'class' => 'zone-4'],
        ];
    @endphp

    <header class="header">
      <h1 class="header-text">BHS: Dashboard</h1>
      <div class="menu-container">
        <button class="header-button" id="menu-toggle" aria-label="Toggle navigation menu" type="button">
          <i class="ti ti-menu-2" aria-hidden="true"></i>
        </button>
        <nav class="dropdown-menu" id="dropdown-menu">
          <a href="/dashboard" class="menu-item active"><span>Dashboard</span></a>
          <a href="/instellingen" class="menu-item"><span>Instellingen</span></a>
        </nav>
      </div>
    </header>

    <div class="container">
      <div class="algemeen">
        <div class="dashboard-boxes-1">
          <div class="dashboard-panel">
            <div class="dashboard-label">Aantal koffers in systeem</div>
            <div class="dashboard-value">{{ $kpiTotalBagage }}</div>
            <div class="dashboard-note">Actieve bagage in de database</div>
          </div>
        </div>
        <div class="dashboard-boxes-1">
          <div class="dashboard-panel">
            <div class="dashboard-label">Aantal koffers vandaag verwerkt</div>
            <div class="dashboard-value">{{ $kpiProcessedToday }}</div>
            <div class="dashboard-note">Verwerkt op basis van aflevertijd</div>
          </div>
        </div>
        <div class="dashboard-boxes-1">
          <div class="dashboard-panel">
            <div class="dashboard-label">Aantal koffers met zoek-status</div>
            <div class="dashboard-value">{{ $kpiMissing }}</div>
            <div class="dashboard-note">Status: zoek</div>
          </div>
        </div>
        <div class="dashboard-boxes-1">
          <div class="dashboard-panel">
            <div class="dashboard-label">Aantal machines in gebruik</div>
            <div class="dashboard-value">{{ $kpiMachinesActive }}<span class="dashboard-note"> / {{ $kpiMachinesTotal }}</span></div>
            <div class="dashboard-note">{{ $kpiMachinesMaintenance }} in onderhoud</div>
          </div>
        </div>
      </div>

      <div class="zones">
        @foreach ($zoneTotals as $zoneName => $zoneCount)
          @php $zoneInfo = $zoneMeta[$loop->index] ?? null; @endphp
          <div class="dashboard-boxes-4 {{ $zoneInfo['class'] ?? '' }}">
            <div class="dashboard-panel">
              <div class="dashboard-label">{{ $zoneInfo['label'] ?? $zoneName }}</div>
              <div class="dashboard-list-title" style="display:flex;align-items:center;justify-content:center;gap:8px; margin-top: 4px; margin-bottom: 2px;">
                @if ($zoneInfo)
                  <i class="ti {{ $zoneInfo['icon'] }}" aria-hidden="true"></i>
                @endif
                <span>{{ $zoneInfo['name'] ?? $zoneName }}</span>
              </div>
              <div class="dashboard-value">{{ $zoneCount }}</div>
              <div class="dashboard-note">Database count</div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="boxes">
        <div class="dashboard-boxes-3">
          <div class="dashboard-panel">
            <div class="dashboard-label">Koffers vandaag verwerkt per uur</div>
            <div class="dashboard-chart">
              <canvas id="chartHour" aria-label="Staafdiagram van verwerkte en afgeleverde bagage per uur" role="img"></canvas>
            </div>
          </div>
        </div>
        <div class="dashboard-boxes-3">
          <div class="dashboard-panel">
            <div class="dashboard-label">Status verdeling</div>
            <div class="dashboard-legend">
              @foreach ($chartStatusLabels as $index => $label)
                <span class="dashboard-legend-item">
                  <span class="dashboard-legend-swatch" style="background: {{ ['#4ade80', '#60a5fa', '#fbbf24', '#f87171', '#a78bfa', '#38bdf8'][$index] ?? '#ffffff' }}"></span>
                  {{ $label }} {{ $chartStatusData[$index] ?? 0 }}
                </span>
              @endforeach
            </div>
            <div class="dashboard-chart donut">
              <canvas id="chartStatus" aria-label="Donutgrafiek van bagagestatussen" role="img"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="boxes">
        <div class="dashboard-boxes-2">
          <div class="dashboard-panel">
            <div class="dashboard-label">Overview van de gates</div>
            <div class="dashboard-list">
              @forelse ($gateCollection as $gate)
                <div class="dashboard-list-item">
                  <div>
                    <div class="dashboard-list-title">{{ $gate['name'] }}</div>
                    <div class="dashboard-list-subtitle">{{ $gate['position'] }}</div>
                  </div>
                  <span class="dashboard-badge {{ $gate['open'] ? 'ok' : 'warn' }}">{{ $gate['open'] ? 'Beschikbaar' : 'Niet beschikbaar' }}</span>
                </div>
              @empty
                <div class="dashboard-empty">Geen gate-data in de database.</div>
              @endforelse
            </div>
          </div>
        </div>

        <div class="dashboard-boxes-2">
          <div class="dashboard-panel">
            <div class="dashboard-label">Status van de machines</div>
            <div class="dashboard-list">
              @forelse ($machineCollection as $machine)
                @php
                  $badgeClass = match ($machine['status']) {
                      'actief' => 'ok',
                      'onderhoud' => 'warn',
                      'error' => 'err',
                      default => 'warn',
                  };
                @endphp
                <div class="dashboard-list-item">
                  <div>
                    <div class="dashboard-list-title">{{ $machine['name'] }}</div>
                    <div class="dashboard-list-subtitle">{{ $machine['position'] }}</div>
                  </div>
                  <span class="dashboard-badge {{ $badgeClass }}">{{ ucfirst($machine['status']) }}</span>
                </div>
              @empty
                <div class="dashboard-empty">Geen machine-data in de database.</div>
              @endforelse
            </div>
          </div>
        </div>

        <div class="dashboard-boxes-2">
          <div class="dashboard-panel">
            <div class="dashboard-label">Recente meldingen</div>
            <div class="dashboard-list">
              @forelse ($eventCollection as $event)
                <div class="dashboard-list-item">
                  <div>
                    <div class="dashboard-list-title">{{ $event['text'] }}</div>
                    <div class="dashboard-list-subtitle">{{ $event['time'] }}</div>
                  </div>
                  <span class="dashboard-badge {{ str_contains($event['dot'], '#22c55e') ? 'ok' : (str_contains($event['dot'], '#f59e0b') ? 'warn' : 'err') }}">Live</span>
                </div>
              @empty
                <div class="dashboard-empty">Geen recente meldingen in de database.</div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const clock = document.getElementById('clk');
        const refreshButton = document.getElementById('btnRefresh');
        const hourCanvas = document.getElementById('chartHour');
        const statusCanvas = document.getElementById('chartStatus');

        const updateClock = () => {
          if (!clock) return;
          clock.textContent = new Intl.DateTimeFormat('nl-NL', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
          }).format(new Date());
        };

        updateClock();
        setInterval(updateClock, 1000);

        if (refreshButton) {
          refreshButton.addEventListener('click', () => window.location.reload());
        }

        if (!window.Chart || !hourCanvas || !statusCanvas) {
          return;
        }

        new Chart(hourCanvas.getContext('2d'), {
          type: 'bar',
          data: {
            labels: @json($chartHourLabels),
            datasets: [
              {
                label: 'Verwerkt',
                data: @json($chartProcessedData),
                backgroundColor: '#2670c7',
                borderRadius: 8,
              },
              {
                label: 'Afgeleverd',
                data: @json($chartDeliveredData),
                backgroundColor: '#22c55e',
                borderRadius: 8,
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                labels: {
                  color: '#ffffff'
                }
              }
            },
            scales: {
              x: {
                ticks: { color: '#ffffff' },
                grid: { color: 'rgba(255,255,255,0.08)' }
              },
              y: {
                beginAtZero: true,
                ticks: { color: '#ffffff' },
                grid: { color: 'rgba(255,255,255,0.08)' }
              }
            }
          }
        });

        new Chart(statusCanvas.getContext('2d'), {
          type: 'doughnut',
          data: {
            labels: @json($chartStatusLabels),
            datasets: [
              {
                data: @json($chartStatusData),
                backgroundColor: ['#4ade80', '#60a5fa', '#fbbf24', '#f87171', '#a78bfa', '#38bdf8'],
                borderWidth: 0,
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom',
                labels: {
                  color: '#ffffff'
                }
              }
            }
          }
        });
      });
    </script>

    <script type="module" src="/scripts/savecolors.js"></script>
  </body>
</html>
