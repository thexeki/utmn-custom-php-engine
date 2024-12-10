<html>
<head>
	<link rel=stylesheet href="{{ asset('css/style.css') }}" type='text/css'>
	<title>Резюме и вакансии</title>
</head>
<body>
	<div class="header">
		<h1>@yield("header")</h1>
		<div id="logo"></div>
	</div>
	<div class="leftcol">
		@yield("main")
	</div>
	<div class="rightcol">
		<ul class="menu">
			<li><a href="">Вакансии</a></li>
			<li><a href="">Резюме по профессиям</a></li>
			<li><a href="">Избранное резюме</a></li>
		</ul>
	</div>
	<div class="footer">&copy; Copyright 2024</div>
</body>
</html>
