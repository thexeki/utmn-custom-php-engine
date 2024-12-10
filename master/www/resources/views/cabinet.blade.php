@extends("layouts.main")

@section('main')
    <div class="cabinet">
        <h1 class="cabinet__title">Личный кабинет</h1>
        <div class="content driver-page">
            <div class="driver__info-grid">
                <div>
                    <div class="driver-page-photo">
                        <img src="{{ Auth::user()->img ? asset('storage/' . Auth::user()->img) : '/logo.svg' }}"
                             alt="Фото {{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="driver-page-btn-wrapper">
                    <h3 class="driver-page-name">{{ Auth::user()->name }}</h3>
                    @if (Auth::user()->role === 'teacher')
                        <a href="{{ route('masterclass.create') }}" class="driver-page-btn btn">
                            <button>
                                Добавить мастер-класс
                            </button>
                        </a>
                    @endif
                </div>
            </div>

            <div class="driver-page-text">
                @if (Auth::user()->role === 'visitor')
                    <h3 class="driver-page-my">Записанные мастер-классы</h3>
                    <table class="driver-page-table">
                        <tbody>
                        @forelse(Auth::user()->registrations as $registration)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($registration->masterClass->date)->format('d.m.Y') }} в {{ $registration->masterClass->time }}</td>
                                <td>
                                    <b>{{ $registration->masterClass->title }}</b>
                                    <p>{{ $registration->masterClass->description }}</p>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('register.cancel', $registration->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="driver-page__cancel btn">Отменить запись</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Вы пока не записаны на мастер-классы.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                @else
                    <h3 class="driver-page-my">Мои мастер-классы</h3>
                    <table class="driver-page-table">
                        <tbody>
                        @forelse(Auth::user()->masterClasses as $masterClass)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($masterClass->date)->format('d.m.Y') }} в {{ $masterClass->time }}</td>
                                <td>
                                    <b>{{ $masterClass->title }}</b>
                                    <p>{{ $masterClass->description }}</p>
                                    <p>
                                        @foreach($masterClass->registrations as $registration)
                                            {{ $loop->iteration }}. {{ $registration->user->name }} ({{ $registration->user->email }})<br>
                                            Номер телефона: {{ $registration->user->phone }}
                                            <br>
                                        @endforeach
                                    </p>
                                </td>
                                <td>
                                    <a href="{{ route('masterclass.update.form', $masterClass->id) }}" class="driver-page__edit btn">
                                        <button class="driver-page__edit">Редактировать</button>
                                    </a>
                                    <form method="POST" action="{{ route('masterclass.destroy', $masterClass->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn driver-page__delete" onclick="return confirm('Вы уверены, что хотите удалить мастер-класс?');">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">У вас пока нет мастер-классов.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <h3>
            Доступные категории
        </h3>
        <div class="category__grid">
            @foreach(App\Models\Category::all() as $category)
                <x-category-card :category="$category"></x-category-card>
            @endforeach
        </div>
    </div>
@endsection
