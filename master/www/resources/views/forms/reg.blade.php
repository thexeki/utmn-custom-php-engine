@extends("layouts.main")
@section('main')
    <div class="forms-reg">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Форма регистрации</h2>
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Номер телефона</label>
                <input type="tel" name="phone" required>
            </div>
            <div class="form-group">
                <button class="btn" type="submit">Отправить</button>
            </div>
        </form>
    </div>
@endsection
