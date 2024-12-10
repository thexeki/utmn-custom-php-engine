<html>
<head>
	<link rel=stylesheet href="<?php echo e(asset('css/style.css')); ?>" type='text/css'>
	<title>Резюме и вакансии</title>
</head>
<body>
	<div class="header">
		<h1><?php echo $__env->yieldContent("header"); ?></h1>
		<div id="logo"></div>
	</div>
	<div class="leftcol">
		<?php echo $__env->yieldContent("main"); ?>
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
<?php /**PATH /var/www/app/resources/views/layouts/main.blade.php ENDPATH**/ ?>