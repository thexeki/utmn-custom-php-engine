<?php $__env->startSection('header', 'Резюме'); ?>
<?php $__env->startSection('main'); ?>
    <h1>Резюме</h1>
    <div class="pinline1"><img class="pic" src="<?php echo e($data['avatar']); ?>"></div>
    <p class="pinline second">
        <?php echo e($data['secondName']); ?>

        <br>
        Телефон: <?php echo e($data['phone']); ?>

    </p>
    <p class="pinline third">
        Профессия: <?php echo e($data['specialization']); ?>

        <br>
        Стаж: <?php echo e($data['experience']); ?>

    </p>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/resume.blade.php ENDPATH**/ ?>