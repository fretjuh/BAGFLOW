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
      <div class="menu-container">
        <button
          class="header-button"
          id="menu-toggle"
          aria-label="Toggle navigation menu"
        >
          <img
            src="/Img/SVG/list.svg"
            width="25px"
            height="25px"
            alt="menu icon"
          />
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
        <div class="dashboard-boxes-1">
            <h2>Totaal koffers</h2>
            <h1>{{ $aantalKoffers }}</h1>
        </div>

        <div class="dashboard-boxes-1">
            <h2>Vandaag verwerkt</h2>
            <h1>{{ $verwerktVandaag }}</h1>
        </div>

        <div class="dashboard-boxes-1">
            <h2>Zoek status</h2>
            <h1>{{ $zoekStatus }}</h1>
        </div>
        <div class="dashboard-boxes-1">
            <h2>Machines actief</h2>
            <h1>{{ $machinesActief }}</h1>
        </div> <!-- Aantal machines in gebruik -->
      </div>

     <div class="zones">

        @foreach($zones as $zone)

        <div class="dashboard-boxes-4">

        <h2>
        Zone {{ $zone->zone }}
        </h2>

        <h1>
        {{ $zone->totaal }}
        </h1>

        </div>

        @endforeach

    </div>
      <div class="boxes">
        
        <div class="dashboard-boxes-3"></div> <!-- Koffers vandaag verwerkt per uur (displayed de voorgaande uren van die dag) -->
       <div class="dashboard-boxes-3">

            <h2>Status verdeling</h2>


            @foreach($statussen as $status)

            <p>
            {{ $status->naam }}

            :
            {{ $status->bagages_count }}

            </p>

            @endforeach
        </div>
      </div>
      <div class="boxes">
        <div class="dashboard-boxes-2">

            <h2>Gates</h2>

            @foreach($gates as $gate)

            <p>
            {{ $gate->naam }}
            </p>

            @endforeach

        </div> <!-- Overview van de gates (beschikbaar of niet beschikbaar) -->
        <div class="dashboard-boxes-2"></div> <!-- Status van de machines (individueel) -->
        <div class="dashboard-boxes-2"></div> <!-- Recente meldingen -->
      </div>
    </div>

    

    <script type="module" src="/scripts/savecolors.js"></script>
  </body>
</html>
