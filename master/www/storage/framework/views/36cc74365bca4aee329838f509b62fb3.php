<?php $__env->startSection('main'); ?>
    <div class="forms-login">
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <h2>Форма входа</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="error-container">
                <?php echo e($errors->first('email')); ?>

            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="error-container">
                <?php echo e($errors->first('password')); ?>

            </div>
            <div class="form-group">
                <button class="btn" type="submit">Войти</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/forms/login.blade.php ENDPATH**/ ?>