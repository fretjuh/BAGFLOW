<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/loadcolors.js') }}"></script>
    <script src="{{ asset('js/savecolors.js') }}"></script>
</head>
    <body class="dashboard-body">
        <header class="header">
            <h1 class="header-text">BHS: Dashboard</h1>
            <button class="header-button" id="theme-toggle" aria-label="Toggle theme"
                title="Toggle dark/light theme">
                <img src="/Img/SVG/moon.svg" width="24px" height="24px" alt="theme icon" />
            </button>
            <div class="menu-container">
                <button class="header-button" id="menu-toggle" aria-label="Toggle navigation menu">
                    <img src="/Img/SVG/list.svg" width="25px" height="25px" alt="menu icon" />
                </button>
                <nav class="dropdown-menu" id="dropdown-menu">
                    <a href="/Dashboard" class="menu-item active">
                        <span>Dashboard</span>
                    </a>
                    <a href="/Instellingen" class="menu-item">
                        <span>Instellingen</span>
                    </a>
                </nav>
            </div>
        </header>
            <div class="container">
                <div class="algemeen">
                    <!-- Aantal koffers in systeem -->
                    <div class="dashboard-boxes-1">
                        <p style="text-align: center">Koffers in systeem:</p>
                        <div class="data">
                            <h1 style="text-align:center">{{ $aantalKoffers ?? 0 }}</h1>
                        </div>
                    </div>

                    <!-- Aantal koffers vandaag verwerkt -->
                    <div class="dashboard-boxes-1">
                        <p style="text-align: center">Koffers vandaag verwerkt:</p>
                        <div class="data">
                            <h1 style="text-align:center">{{ $verwerktVandaag ?? 0 }}</h1>
                        </div>
                    </div>

                    <!-- Aantal koffers met zoek-status -->
                    <div class="dashboard-boxes-1">
                        <p style="text-align: center">Koffers met zoek-status:</p>
                        <div class="data">
                            <h1 style="text-align:center">{{ $zoekStatus ?? 0 }}</h1>
                        </div>
                    </div>

                    <!-- Aantal machines in gebruik -->
                    <div class="dashboard-boxes-1">
                        <p style="text-align: center">Machines in gebruik:</p>
                        <div class="data">
                            <h1 style="text-align:center">{{ $machinesActief ?? 0 }}</h1>
                        </div>
                    </div>

                </div>
                <div class="zones">

                    <div class="dashboard-boxes-4">
                        <p style="text-align: center">Zone 0</p>
                        <div class="data" style="color: #a78bfa; text-align:center;">
                            <h1>{{ $zonesMap[0] ?? 0 }}</h1>
                        </div>
                    </div>


                    <!-- Zone 0 (aantal koffers in zone 0)-->
                    <div class="dashboard-boxes-4">
                        <p style="text-align: center">Zone 1</p>
                        <div class="data" style="color: #38bdf8; text-align:center;">
                            <h1>{{ $zonesMap[1] ?? 0 }}</h1>
                        </div>
                    </div>
                    <!-- Zone 1 (aantal koffers in zone 1) -->
                    <div class="dashboard-boxes-4">
                        <p style="text-align: center">Zone 2</p>
                        <div class="data" style="color: #4abe80; text-align:center;">
                            <h1>{{ $zonesMap[2] ?? 0 }}</h1>
                        </div>
                    </div>
                    <!-- Zone 2 (aantal koffers in zone 2) -->
                    <div class="dashboard-boxes-4">
                        <p style="text-align: center">Zone 3</p>
                        <div class="data" style="color: #fbbf24; text-align:center;">
                            <h1>{{ $zonesMap[3] ?? 0 }}</h1>
                        </div>
                    </div>


                    <div class="dashboard-boxes-4">
                        <p style="text-align: center">Zone 4</p>
                        <div class="data" style="color: #f87171; text-align:center;">
                            <h1>{{ $zonesMap[4] ?? 0 }}</h1>
                        </div>
                    </div>

                </div>
                <div class="boxes">
                    <div class="dashboard-boxes-3">
                        <h2>Status verdeling</h2>
                        <div style="padding:12px">
                            @foreach ($statussen as $status)
                                <p>{{ $status->naam }}: {{ $status->bagages_count }}</p>
                            @endforeach
                        </div>
                    </div>
                    <!-- Koffers vandaag verwerkt per uur (displayed de voorgaande uren van die dag) -->
                    <div class="dashboard-boxes-3">
                        <!-- Placeholder for per-hour chart -->
                    </div>
                </div>
                <div class="boxes">
                    <div class="dashboard-boxes-2">
                        <h2>Gates</h2>
                        <div style="padding:12px">
                            @foreach ($gates as $gate)
                                <p>{{ $gate->naam }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="dashboard-boxes-2">
                        <h2>Machines</h2>
                        <!-- Optional: list machines or statuses -->
                    </div>
                    <div class="dashboard-boxes-2">
                        <h2>Recente meldingen</h2>
                    </div>
                </div>
            </div>
        <script type="module" src="/scripts/savecolors.js"></script>
    </body>
</html>
