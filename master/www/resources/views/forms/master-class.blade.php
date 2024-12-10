@extends("layouts.main")

@section('main')
    <div class="master-class">
        <form method="POST"
              action="{{ isset($masterClass->id) ? route('masterclass.update', $masterClass->id) : route('masterclass.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($masterClass->id))
                @method('PUT')
            @endif

            <h2>{{ isset($masterClass->id) ? 'Редактирование мастер-класса' : 'Создание мастер-класса' }}</h2>

            <div class="form-group">
                <label for="category_id">Вид творчества</label>
                <select id="category_id" name="category_id" required {{ isset($masterClass->id) ? 'disabled' : '' }}>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('category_id', $masterClass->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Название мастер-класса</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $masterClass->title ?? '') }}"
                       required {{ isset($masterClass->id) ? 'disabled' : '' }}>
                @error('title')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Описание мастер-класса</label>
                <textarea id="description" name="description"
                          required>{{ old('description', $masterClass->description ?? '') }}</textarea>
                @error('description')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Дата</label>
                <input type="date" id="date" name="date"
                       value="{{ old('date', isset($masterClass->date) ? \Carbon\Carbon::parse($masterClass->date)->format('Y-m-d') : '') }}"
                       required {{ isset($masterClass->id) ? 'disabled' : '' }}>
                @error('date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="time">Время занятия</label>
                <select id="time" name="time" required {{ isset($masterClass->id) ? 'disabled' : '' }}>
                    @foreach(['9-11' => '09:00-11:00', '11-13' => '11:00-13:00', '13-15' => '13:00-15:00', '15-17' => '15:00-17:00'] as $slot => $label)
                        <option value="{{ $slot }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('time')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="group_size">Количество человек в группе</label>
                <input type="number" id="group_size" name="group_size"
                       value="{{ old('group_size', $masterClass->group_size ?? 10) }}"
                       required min="1" {{ isset($masterClass->id) ? 'disabled' : '' }}>
                @error('group_size')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Стоимость</label>
                <input type="number" id="price" name="price"
                       value="{{ old('price', $masterClass->price ?? 0) }}" required min="0" step="1">
                @error('price')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            @if(!isset($masterClass->id))
                <div class="form-group">
                    <label for="img">Изображение</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    @if(isset($masterClass->img))
                        <div>
                            <img src="{{ asset('storage/' . $masterClass->img) }}"
                                 alt="Изображение {{ $masterClass->title }}" style="max-width: 200px;">
                        </div>
                    @endif
                    @error('img')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <button class="btn">{{ isset($masterClass->id) ? 'Сохранить изменения' : 'Создать' }}</button>
            </div>
        </form>
    </div>
@endsection

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
