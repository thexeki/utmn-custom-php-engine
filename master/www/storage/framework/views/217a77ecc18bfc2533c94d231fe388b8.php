<!DOCTYPE html>
<html>
<head>
    <title><?php echo $__env->yieldContent("header"); ?></title>
    <link rel=stylesheet href="<?php echo e(asset('css/setting.css')); ?>" type='text/css'>
    <link rel=stylesheet href="<?php echo e(asset('css/styles.css')); ?>" type='text/css'>
    <link rel=stylesheet href="<?php echo e(asset('css/sections.css')); ?>" type='text/css'>
</head>
<body >

<div class="wrapper">
    <div class="content">
        <div class="header container">
            <div class="header__items">
                <div class="logo">
                    <a class="" href="/">
                        <img src="/logo.svg" alt="Логотип сайта">
                    </a>
                </div>
                <div class="title circumference">
                    <h2>
                        Клуб любителей творчества «ОчУмелые ручки»
                    </h2>
                </div>
                <div class="auth ">
                    <?php if(Auth::check()): ?>
                        <a class="circumference" href="<?php echo e(route('cabinet')); ?>">Кабинет</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit">Выход</button>
                        </form>
                    <?php else: ?>
                        <a class="circumference" href="<?php echo e(route('login.form')); ?>">Вход</a>
                        <a class="circumference" href="<?php echo e(route('register.form')); ?>">Регистрация</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="main container">
            <?php echo $__env->yieldContent("main"); ?>
        </div>
    </div>

    <div class="footer">
        <div class="row container">
            <div class="address">Наш адрес: ВДНХ, 120в</div>
            <div class="tel">Тел: 89123456765</div>
            <div class="copy">(с) Copyright, 2017</div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/app/resources/views/layouts/main.blade.php ENDPATH**/ ?>