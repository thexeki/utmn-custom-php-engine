<?php $__env->startSection('header', $category->name); ?>

<?php $__env->startSection('main'); ?>
    <div class="category">
        <h1 class="category__title"><?php echo e($category->name); ?></h1>
        <div class="row--small grid between">
            <div class="category__content">
                <img src="<?php echo e($category->img ? asset('storage/' . $category->img) : '/logo.svg'); ?>"
                     alt="Иллюстрация <?php echo e($category->name); ?>">
                <p><?php echo e($category->description); ?></p>
            </div>
            <h3 class="category__more">Другие категории:</h3>
            <div class="category__grid">
                <?php $__currentLoopData = $otherCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal77343b4405a3e8bf66a7a88cb0d29606 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77343b4405a3e8bf66a7a88cb0d29606 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-card','data' => ['category' => $cat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('category-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal77343b4405a3e8bf66a7a88cb0d29606)): ?>
<?php $attributes = $__attributesOriginal77343b4405a3e8bf66a7a88cb0d29606; ?>
<?php unset($__attributesOriginal77343b4405a3e8bf66a7a88cb0d29606); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal77343b4405a3e8bf66a7a88cb0d29606)): ?>
<?php $component = $__componentOriginal77343b4405a3e8bf66a7a88cb0d29606; ?>
<?php unset($__componentOriginal77343b4405a3e8bf66a7a88cb0d29606); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="row shedule">
            <div class="row--small">
                <h2>Расписание</h2>
                <?php $__errorArgs = ['error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php if(session('success')): ?>
                    <div class="complete-message"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <div class="drivers">
                    <?php $__empty_1 = true; $__currentLoopData = $masterClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $masterClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if (isset($component)) { $__componentOriginal364e13c75beb160a8593ac1757fe4e6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal364e13c75beb160a8593ac1757fe4e6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.driver-card','data' => ['masterClass' => $masterClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('driver-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['masterClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($masterClass)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal364e13c75beb160a8593ac1757fe4e6f)): ?>
<?php $attributes = $__attributesOriginal364e13c75beb160a8593ac1757fe4e6f; ?>
<?php unset($__attributesOriginal364e13c75beb160a8593ac1757fe4e6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal364e13c75beb160a8593ac1757fe4e6f)): ?>
<?php $component = $__componentOriginal364e13c75beb160a8593ac1757fe4e6f; ?>
<?php unset($__componentOriginal364e13c75beb160a8593ac1757fe4e6f); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>В этой категории пока нет мастер-классов.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="registerModal" class="modal hidden">
        <div class="modal-content">
            <button class="modal-close" id="modalClose">×</button>
            <h2>Подтверждение записи</h2>
            <p><strong>ФИО пользователя:</strong> <span id="userName"><?php echo e(Auth::user()->name); ?></span></p>
            <p><strong>Вид творчества:</strong> <span id="categoryName"></span></p>
            <p><strong>ФИО мастера:</strong> <span id="teacherName"></span></p>
            <p><strong>Дата:</strong> <span id="masterClassDate"></span></p>
            <p><strong>Время:</strong> <span id="masterClassTime"></span></p>
            <form method="POST" id="registerForm">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn confirm-btn">Подтвердить</button>
                <button type="button" class="btn cancel-btn" id="cancelBtn">Отменить</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const registerButtons = document.querySelectorAll('.driver-btn');
            const modal = document.getElementById('registerModal');
            const modalClose = document.getElementById('modalClose');
            const cancelBtn = document.getElementById('cancelBtn');
            const categoryName = document.getElementById('categoryName');
            const teacherName = document.getElementById('teacherName');
            const masterClassDate = document.getElementById('masterClassDate');
            const masterClassTime = document.getElementById('masterClassTime');
            const registerForm = document.getElementById('registerForm');

            registerButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const masterClassData = JSON.parse(button.dataset.masterClass);
                    categoryName.textContent = masterClassData.category_name;
                    teacherName.textContent = masterClassData.teacher_name;
                    masterClassDate.textContent = masterClassData.date;
                    masterClassTime.textContent = masterClassData.time;

                    registerForm.action = `/register/${masterClassData.id}`;
                    modal.classList.remove('hidden');
                });
            });

            modalClose.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/category.blade.php ENDPATH**/ ?>