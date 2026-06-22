<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css" />
    <script src="/js/loadcolors.js"></script>
</head>
<header>
    <div class="header">
        <h1 class="header-text">BHS: inlogpagina</h1>
        <button class="header-button" id="theme-toggle" aria-label="Toggle theme" title="Toggle dark/light theme">
            <img src="/Img/SVG/moon.svg" width="24px" height="24px" alt="theme icon" />
        </button>
    </div>
</header>

<body>
    <div class="main-container">
        <form id="login-form" class="login-form" method="POST" action="/login">
            @csrf
            <label for="login" class="login-text" style="margin-top: 50px">Log hieronder in:</label>
            <input type="text" id="email" name="email" class="login-input" placeholder="Gebruikersnaam"
                required />
            <input type="password" id="password" name="password" class="login-input" placeholder="Wachtwoord"
                required />
            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif
            <button type="submit" class="login-submit">Inloggen</button>
            <p class="prelink">Nog geen account? <a href="/Registreren" class="link">Registreer hier</a></p>
        </form>
    </div>
    <script type="module" src="/js/savecolors.js"></script>
</body>

</html>
