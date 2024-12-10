<?php $__env->startSection('main'); ?>
    <div class="cabinet">
        <h1 class="cabinet__title">Личный кабинет</h1>
        <div class="content driver-page">
            <div class="driver__info-grid">
                <div>
                    <div class="driver-page-photo">
                        <img src="<?php echo e(Auth::user()->img ? asset('storage/' . Auth::user()->img) : '/logo.svg'); ?>"
                             alt="Фото <?php echo e(Auth::user()->name); ?>">
                    </div>
                </div>
                <div class="driver-page-btn-wrapper">
                    <h3 class="driver-page-name"><?php echo e(Auth::user()->name); ?></h3>
                    <?php if(Auth::user()->role === 'teacher'): ?>
                        <a href="<?php echo e(route('masterclass.create')); ?>" class="driver-page-btn btn">
                            <button>
                                Добавить мастер-класс
                            </button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="driver-page-text">
                <?php if(Auth::user()->role === 'visitor'): ?>
                    <h3 class="driver-page-my">Записанные мастер-классы</h3>
                    <table class="driver-page-table">
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = Auth::user()->registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($registration->masterClass->date)->format('d.m.Y')); ?> в <?php echo e($registration->masterClass->time); ?></td>
                                <td>
                                    <b><?php echo e($registration->masterClass->title); ?></b>
                                    <p><?php echo e($registration->masterClass->description); ?></p>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('register.cancel', $registration->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="driver-page__cancel btn">Отменить запись</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3">Вы пока не записаны на мастер-классы.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h3 class="driver-page-my">Мои мастер-классы</h3>
                    <table class="driver-page-table">
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = Auth::user()->masterClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $masterClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($masterClass->date)->format('d.m.Y')); ?> в <?php echo e($masterClass->time); ?></td>
                                <td>
                                    <b><?php echo e($masterClass->title); ?></b>
                                    <p><?php echo e($masterClass->description); ?></p>
                                    <p>
                                        <?php $__currentLoopData = $masterClass->registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($loop->iteration); ?>. <?php echo e($registration->user->name); ?> (<?php echo e($registration->user->email); ?>)<br>
                                            Номер телефона: <?php echo e($registration->user->phone); ?>

                                            <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('masterclass.update.form', $masterClass->id)); ?>" class="driver-page__edit btn">
                                        <button class="driver-page__edit">Редактировать</button>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('masterclass.destroy', $masterClass->id)); ?>" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn driver-page__delete" onclick="return confirm('Вы уверены, что хотите удалить мастер-класс?');">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3">У вас пока нет мастер-классов.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <h3>
            Доступные категории
        </h3>
        <div class="category__grid">
            <?php $__currentLoopData = App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal77343b4405a3e8bf66a7a88cb0d29606 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77343b4405a3e8bf66a7a88cb0d29606 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-card','data' => ['category' => $category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('category-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category)]); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/cabinet.blade.php ENDPATH**/ ?>