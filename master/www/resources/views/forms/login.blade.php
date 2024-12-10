@extends("layouts.main")
@section('main')
    <div class="forms-login">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Форма входа</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="error-container">
                {{ $errors->first('email') }}
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="error-container">
                {{ $errors->first('password') }}
            </div>
            <div class="form-group">
                <button class="btn" type="submit">Войти</button>
            </div>
        </form>
    </div>
@endsection
