<!DOCTYPE html>
<html>

<head>

<title>BAGFLOW Login</title>

<link rel="stylesheet"
href="{{ asset('styling/main.css') }}">

</head>


<body>


<form method="POST" action="/login">

@csrf


<h1>BAGFLOW</h1>


<input 
type="email"
name="email"
placeholder="Email">


<input 
type="password"
name="password"
placeholder="Wachtwoord">


<button>
Inloggen
</button>


@if($errors->any())

<p>
{{ $errors->first() }}
</p>

@endif


</form>


</body>

</html>