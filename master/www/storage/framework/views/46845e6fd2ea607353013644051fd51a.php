<?php $__env->startSection('main'); ?>
    <div class="master-class">
        <form method="POST"
              action="<?php echo e(isset($masterClass->id) ? route('masterclass.update', $masterClass->id) : route('masterclass.store')); ?>"
              enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($masterClass->id)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <h2><?php echo e(isset($masterClass->id) ? 'Редактирование мастер-класса' : 'Создание мастер-класса'); ?></h2>

            <div class="form-group">
                <label for="category_id">Вид творчества</label>
                <select id="category_id" name="category_id" required <?php echo e(isset($masterClass->id) ? 'disabled' : ''); ?>>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                                <?php echo e(old('category_id', $masterClass->category_id ?? '') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="title">Название мастер-класса</label>
                <input type="text" id="title" name="title"
                       value="<?php echo e(old('title', $masterClass->title ?? '')); ?>"
                       required <?php echo e(isset($masterClass->id) ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="description">Описание мастер-класса</label>
                <textarea id="description" name="description"
                          required><?php echo e(old('description', $masterClass->description ?? '')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="date">Дата</label>
                <input type="date" id="date" name="date"
                       value="<?php echo e(old('date', isset($masterClass->date) ? \Carbon\Carbon::parse($masterClass->date)->format('Y-m-d') : '')); ?>"
                       required <?php echo e(isset($masterClass->id) ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="time">Время занятия</label>
                <select id="time" name="time" required <?php echo e(isset($masterClass->id) ? 'disabled' : ''); ?>>
                    <?php $__currentLoopData = ['9-11' => '09:00-11:00', '11-13' => '11:00-13:00', '13-15' => '13:00-15:00', '15-17' => '15:00-17:00']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($slot); ?>"><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="group_size">Количество человек в группе</label>
                <input type="number" id="group_size" name="group_size"
                       value="<?php echo e(old('group_size', $masterClass->group_size ?? 10)); ?>"
                       required min="1" <?php echo e(isset($masterClass->id) ? 'disabled' : ''); ?>>
                <?php $__errorArgs = ['group_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="price">Стоимость</label>
                <input type="number" id="price" name="price"
                       value="<?php echo e(old('price', $masterClass->price ?? 0)); ?>" required min="0" step="1">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <?php if(!isset($masterClass->id)): ?>
                <div class="form-group">
                    <label for="img">Изображение</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    <?php if(isset($masterClass->img)): ?>
                        <div>
                            <img src="<?php echo e(asset('storage/' . $masterClass->img)); ?>"
                                 alt="Изображение <?php echo e($masterClass->title); ?>" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                    <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <button class="btn"><?php echo e(isset($masterClass->id) ? 'Сохранить изменения' : 'Создать'); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('date');
        const timeSelect = document.getElementById('time');

        dateInput.addEventListener('change', function () {
            const selectedDate = dateInput.value;

            if (!selectedDate) return;

            // Отправляем запрос на сервер для получения занятых слотов
            fetch(`/api/unavailable-slots?date=${selectedDate}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
                .then(response => response.json())
                .then(unavailableSlots => {
                    // Очищаем существующие опции
                    Array.from(timeSelect.options).forEach(option => {
                        option.disabled = false;
                    });

                    // Делаем занятые слоты неактивными
                    unavailableSlots.forEach(slot => {
                        const option = Array.from(timeSelect.options).find(opt => opt.value === slot);
                        if (option) {
                            option.disabled = true;
                        }
                    });
                })
                .catch(error => {
                    console.error('Ошибка при загрузке занятых слотов:', error);
                });
        });
    });
</script>

<?php echo $__env->make("layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/app/resources/views/forms/master-class.blade.php ENDPATH**/ ?>