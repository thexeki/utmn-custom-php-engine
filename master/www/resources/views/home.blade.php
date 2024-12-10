@extends("layouts.main")

@section('header', 'Главная страница')

@section('main')
    <div class="home">
        <h1>Добро пожаловать!</h1>
        <p>Выберите категорию мастер-классов:</p>

        <div class="home__grid">
            @forelse ($categories as $category)
                <x-category-card :category="$category"></x-category-card>
            @empty
                <div class="error-container">Категории отсутствуют</div>
            @endforelse
        </div>
    </div>
@endsection
