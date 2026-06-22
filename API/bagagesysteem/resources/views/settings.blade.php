<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customization</title>
    <link rel="stylesheet" href="/css/style.css" />
    <script src="/js/loadcolors.js"></script>
  </head>
  <body>
    <header>
      <div class="header">
        <h1 class="header-text">BHS: Instellingen</h1>
        <button
          class="header-button"
          id="theme-toggle"
          aria-label="Toggle theme"
          title="Toggle dark/light theme"
        >
          <img
            src="/Img/SVG/moon.svg"
            width="24px"
            height="24px"
            alt="theme icon"
          />
        </button>
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
                <a href="/dashboard" class="menu-item active">
                    <span>Dashboard</span>
                </a>
                <a href="/instellingen" class="menu-item">
                    <span>Instellingen</span>
                </a>
                <form method="POST" action="/logout" class="menu-item">
                    @csrf
                    <button type="submit">Uitloggen</button>
                </form>
            </nav>
        </div>
      </div>
    </header>

    <div class="main-container">
      <div class="settings-wrapper">
        <form id="colors-form" class="colors-form">
          <div class="form-section">
            <h2 class="form-title">Kleuren aanpassen</h2>
            <p class="form-subtitle">Personalizeer uw dashboard uiterlijk</p>
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
              <span class="color-value" id="button-hover-color-value"
                >#0057b8</span
              >
            </div>
          </div>

          <button type="submit" class="login-submit">
            Wijzigingen toepassen
          </button>
        </form>
      </div>
    </div>

    <script src="/js/savecolors.js"></script>
  </body>
</html>