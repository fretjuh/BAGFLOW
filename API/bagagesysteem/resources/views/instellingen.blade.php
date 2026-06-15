<!doctype html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customization</title>
    <link rel="stylesheet" href="/Styling/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.8.0/dist/tabler-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script src="/scripts/loadcolors.js"></script>
  </head>
  <body class="dashboard-body">
    <header class="header">
      <h1 class="header-text">BHS: Instellingen</h1>
      <div class="menu-container">
        <button
          class="header-button"
          id="menu-toggle"
          aria-label="Toggle navigation menu"
          type="button"
        >
          <i class="ti ti-menu-2" aria-hidden="true"></i>
        </button>
        <nav class="dropdown-menu" id="dropdown-menu">
          <a href="/dashboard" class="menu-item">
            <span>Dashboard</span>
          </a>
          <a href="/instellingen" class="menu-item active">
            <span>Instellingen</span>
          </a>
        </nav>
      </div>
    </header>

    <div class="main-container">
      <div class="settings-wrapper">
        <form id="colors-form" class="colors-form">
          <div class="form-section">
            <h2 class="form-title">Kleuren aanpassen</h2>
            <p class="form-subtitle">Personaliseer uw dashboard uiterlijk</p>
          </div>

          <div class="color-group">
            <label for="button-color-picker" class="color-label">
              <span class="label-text">Knoppen kleur:</span>
            </label>
            <div class="color-input-wrapper">
              <input
                type="color"
                id="button-color-picker"
                class="color-picker"
                value="#2670c7"
              />
              <span class="color-value" id="button-color-value">#2670c7</span>
            </div>
          </div>

          <div class="color-group">
            <label for="button-hover-color-picker" class="color-label">
              <span class="label-text">Knoppen hover kleur:</span>
            </label>
            <div class="color-input-wrapper">
              <input
                type="color"
                id="button-hover-color-picker"
                class="color-picker"
                value="#0057b8"
              />
              <span class="color-value" id="button-hover-color-value">#0057b8</span>
            </div>
          </div>

          <button type="submit" class="login-submit">
            Wijzigingen toepassen
          </button>
        </form>
      </div>
    </div>

    <script src="/scripts/savecolors.js" type="module"></script>
  </body>
</html>
