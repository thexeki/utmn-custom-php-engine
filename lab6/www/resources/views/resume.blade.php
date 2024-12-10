@extends("layouts.main")
@section('header', 'Резюме')
@section('main')
    <h1>Резюме</h1>
    <div class="pinline1"><img class="pic" src="{{ $data['avatar'] }}"></div>
    <p class="pinline second">
        {{ $data['secondName'] }}
        <br>
        Телефон: {{ $data['phone'] }}
    </p>
    <p class="pinline third">
        Профессия: {{ $data['specialization'] }}
        <br>
        Стаж: {{ $data['experience'] }}
    </p>
@endsection

