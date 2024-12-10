<?php $__env->startSection('main'); ?>
    <h1>Программист</h1>

    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
        <p class="pinline second">
            <?php echo e($item['secondName']); ?><br>
            Телефон: <?php echo e($item['phone']); ?>

        </p>
        <p class="pinline third">
            Стаж:
            <?php echo e($item['experience']); ?>

        </p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/page.blade.php ENDPATH**/ ?>