<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="/Styling/main.css" />
    <script src="/scripts/loadcolors.js"></script>
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
        <div class="dashboard-boxes-1"></div> <!-- Aantal koffers in systeem -->
        <div class="dashboard-boxes-1"></div> <!-- Aantal koffers vandaag verwerkt -->
        <div class="dashboard-boxes-1"></div> <!-- Aantal koffers met zoek-status -->
        <div class="dashboard-boxes-1"></div> <!-- Aantal machines in gebruik -->
      </div>
      <div class="zones"> 
        <div class="dashboard-boxes-4"></div> <!-- Zone 0 (aantal koffers in zone 0)-->
        <div class="dashboard-boxes-4"></div> <!-- Zone 1 (aantal koffers in zone 1) -->
        <div class="dashboard-boxes-4"></div> <!-- Zone 2 (aantal koffers in zone 2) -->
        <div class="dashboard-boxes-4"></div> <!-- Zone 3 (aantal koffers in zone 3) -->
        <div class="dashboard-boxes-4"></div> <!-- Zone 4 (aantal koffers in zone 4) -->
      </div>
      <div class="boxes">
        <div class="dashboard-boxes-3"></div> <!-- Koffers vandaag verwerkt per uur (displayed de voorgaande uren van die dag) -->
        <div class="dashboard-boxes-3"></div> <!-- status verdeling -->
      </div>
      <div class="boxes">
        <div class="dashboard-boxes-2"></div> <!-- Overview van de gates (beschikbaar of niet beschikbaar) -->
        <div class="dashboard-boxes-2"></div> <!-- Status van de machines (individueel) -->
        <div class="dashboard-boxes-2"></div> <!-- Recente meldingen -->
      </div>
    </div>

    <script type="module" src="/scripts/savecolors.js"></script>
  </body>
</html>
