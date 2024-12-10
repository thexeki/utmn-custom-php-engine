<div class="driver grid">
    <div class="driver-left grid">
        <div class="driver-photo">
            <img src="<?php echo e($masterClass->user->img ? asset('storage/' . $masterClass->user->img) : '/img/default-driver.png'); ?>"
                 alt="Фото ведущего <?php echo e($masterClass->user->name); ?>">
        </div>
        <div class="driver-text">
            <h3 class="driver-name"><?php echo e($masterClass->user->name); ?></h3>
            <p class="driver-desc"><?php echo e($masterClass->description); ?></p>
        </div>
    </div>
    <div class="driver-right">
        <?php if(Auth::check()): ?>
            <?php if($masterClass->isAvailable()): ?>
                <button class="driver-btn" data-master-class="<?php echo e(json_encode([
                    'id' => $masterClass->id,
                    'category_name' => $masterClass->category->name,
                    'teacher_name' => $masterClass->user->name,
                    'date' => \Carbon\Carbon::parse($masterClass->date)->format('d.m.Y'),
                    'time' => $masterClass->time,
                ])); ?>">
                    Записаться
                </button>
            <?php else: ?>
                <button class="driver-btn" disabled>
                    <?php if($masterClass->available_slots <= 0): ?>
                        Мест нет
                    <?php elseif($masterClass->isPast()): ?>
                        Мастер-класс завершён
                    <?php else: ?>
                        Недоступен
                    <?php endif; ?>
                </button>
            <?php endif; ?>
        <?php else: ?>
            <button class="driver-btn" disabled>Требуется авторизация</button>
        <?php endif; ?>
        <div class="driver-time">
            <?php echo e(\Carbon\Carbon::parse($masterClass->date)->format('d.m.Y')); ?> в <?php echo e($masterClass->time); ?>

        </div>
    </div>
</div>


<?php /**PATH /var/www/app/resources/views/components/driver-card.blade.php ENDPATH**/ ?>