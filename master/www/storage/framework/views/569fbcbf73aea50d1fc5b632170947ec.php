<?php $__env->startSection('main'); ?>
    <div class="forms-reg">
        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <h2>Форма регистрации</h2>
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Номер телефона</label>
                <input type="tel" name="phone" required>
            </div>
            <div class="form-group">
                <button class="btn" type="submit">Отправить</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/forms/reg.blade.php ENDPATH**/ ?>