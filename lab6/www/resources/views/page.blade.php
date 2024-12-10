@extends("layouts.main")
@section('main')
    <h1>Программист</h1>

    @foreach($data as $item):
        <p class="pinline second">
            {{$item['secondName']}}<br>
            Телефон: {{$item['phone']}}
        </p>
        <p class="pinline third">
            Стаж:
            {{$item['experience']}}
        </p>
    @endforeach

@endsection
