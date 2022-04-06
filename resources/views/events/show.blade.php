@extends("layouts.main")

@section("title", $event->title)

@section("content")

<div class="card" style="width: 18rem;">
    <img src="/img/events/{{$event->image}}" class="card-img-top" alt="{{$event->title}}">
    <div class="card-body">
      <h5 class="card-title">{{$event->title}}</h5>
      <p class="card-text"><ion-icon name="location-outline"></ion-icon>{{$event->city}}</p>
      <p class="card-text"><ion-icon name="people-outline"></ion-icon>{{count($event->users)}}</p>
      <p class="card-text"><ion-icon name="star-outline"></ion-icon>{{$eventOwner["name"]}}</p>
        @if (!$hasUserJoined)
        <form action="/events/join/{{$event->id}}" method="POST">
            @csrf
            <a href="/events/join/{{$event->id}}" class="btn btn-primary"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                Confirmar presença
            </a>
        </form>
        @else
        <p>Ja cadastrado no evento!</p>
        @endif
      <a href="/" class="btn btn-warning">Home</a>
    </div>
  </div>
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <p>Descrição do evento:</p>
      <h5 class="card-title">{{$event->description}}</h5>
      <p>O evento correrá dia:</p>
      <h5 class="card-title">{{date("d/m/y", strtotime($event->date))}}</h5>
      <h3>O evento com com:</h3>
      <ul class="list-group">
       @foreach ($event->items as $items)
       <li class="list-group-item">{{$items}}</li>
       @endforeach
      </ul>
    </div>
  </div>

@endsection
