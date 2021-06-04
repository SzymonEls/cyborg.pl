<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewreport" content="width=device-width, initial-scale=1.0">
	<title>Cyborg.pl</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}" />
</head>
<body>
	<div class="container-fluid banner">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-md">
					<div class="navbar-brand">Cyborg.pl</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="#">Strona główna</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Aktualności</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">O systemie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Kontakt</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="col-md-8 offset-md-2 info">
				<h1 class="text-center">Cyborg.pl</h1>
				<p class="text-center">
				    Prosty w obsłudze Discord Bot Maker
				</p>
				<a href="{{ route('login') }}" class="btn btn-md text-center">Przejdź do panelu</a>
			</div>
		</div>
	</div>
</body>
</html>