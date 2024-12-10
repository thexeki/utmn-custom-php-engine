<div class="driver grid">
    <div class="driver-left grid">
        <div class="driver-photo">
            <img src="{{ $masterClass->user->img ? asset('storage/' . $masterClass->user->img) : '/img/default-driver.png' }}"
                 alt="Фото ведущего {{ $masterClass->user->name }}">
        </div>
        <div class="driver-text">
            <h3 class="driver-name">{{ $masterClass->user->name }}</h3>
            <p class="driver-desc">{{ $masterClass->description }}</p>
        </div>
    </div>
    <div class="driver-right">
        @if(Auth::check())
            @if($masterClass->isAvailable())
                <button class="driver-btn" data-master-class="{{ json_encode([
                    'id' => $masterClass->id,
                    'category_name' => $masterClass->category->name,
                    'teacher_name' => $masterClass->user->name,
                    'date' => \Carbon\Carbon::parse($masterClass->date)->format('d.m.Y'),
                    'time' => $masterClass->time,
                ]) }}">
                    Записаться
                </button>
            @else
                <button class="driver-btn" disabled>
                    @if($masterClass->available_slots <= 0)
                        Мест нет
                    @elseif($masterClass->isPast())
                        Мастер-класс завершён
                    @else
                        Недоступен
                    @endif
                </button>
            @endif
        @else
            <button class="driver-btn" disabled>Требуется авторизация</button>
        @endif
        <div class="driver-time">
            {{ \Carbon\Carbon::parse($masterClass->date)->format('d.m.Y') }} в {{ $masterClass->time }}
        </div>
    </div>
</div>


