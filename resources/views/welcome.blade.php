@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <main class="container">

        <section class="jumbotron text-center">
            <form>
                <div class="form-group">
                    <h1>Busque por um evento</h1>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </form>
        </section>

        @if ($search)
            <h2>Buscando por: {{ $search }}</h2>
        @else
            <h2>Próximos eventos</h2>
            <p>Veja os eventos dos próximos dias</p>
        @endif

        <div id="cards-container" class="row">
            @foreach ($events as $event)
                <div class="card mr-5 col-md-3">
                    <img id="welcome-image" src="/img/events/{{ $event->image }}" class="" alt="{{ $event->title }}">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{ count($event->users) }}</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            @endforeach
            @if (count($events) == 0 && $search)
                <p>Não foi possível encontrar nenhum evento com {{ $search }}! </p> <a href="/">Ver todos!</a>
            @elseif (count($events) == 0)
                não há eventos disponíveis
            @endif
    </main>
@endsection
