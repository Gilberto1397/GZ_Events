@extends('layouts.main')

LAYOUT WELCOME

@section('title', 'HDC Events')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Busque um evento</h1>
        <form action="/" method="GET">
            <input class="form-control" type="text" name="search" id="search" placeholder="Procurando...">
        </form>
    </div>
    @if ($search)
        <h2>Buscando por: {{ $search }}</h2>
    @else
        <h2>Próximos eventos</h2>
        <p>Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
            @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" class="w-25%" alt="{{ $event->title }}">
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
    </div>
    </div>

@endsection
