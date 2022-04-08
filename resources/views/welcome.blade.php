@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <main class="container-fluid">

        <section id="welcome-section" class="jumbotron text-center">
            <form action="/" method="GET">
                <div class="form-group"><br><br><br><br>
                    <h1>Busque por um evento</h1>
                    <input type="text" class="form-control" name="search" placeholder="Procurando...">
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
                <div class="card mr-3 ml-3 mt-3" style="width: 18rem;">
                    <img id="welcome-image" src="/img/events/{{ $event->image }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                      <p class="card-text">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                      <h5 class="card-title">{{ $event->title }}</h5>
                      <p class="card-text">{{ count($event->users) }}</p>
                      <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                  </div>
            @endforeach
            @if (count($events) == 0 && $search)
                <p>Não foi possível encontrar nenhum evento com {{ $search }}! </p> <a href="/">Ver todos!</a>
            @elseif (count($events) == 0)
                <h3 class="ml-2">Não há eventos disponíveis!</h3>
            @endif
        </div>
    </main>
@endsection
