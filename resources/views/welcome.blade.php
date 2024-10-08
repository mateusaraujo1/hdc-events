@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <div id="search-container" class="col-md-12">

        <h1>Busque um evento</h1>

        <form action="">

            <input type="text" id="search" name="search" class="form-control" placeholder="procurar...">

        </form>

    </div>

        <div id="events-container" class="col-md-12">

            <h2>Próximos Eventos</h2>

            <p class="subtitle">Veja os eventos dos próximos dias</p>

            <div id="cards-container" class="row">

                @foreach ($events as $event)

                    <div class="card col-md-3">

                        <img class="card-img" src="/img/events/{{$event->image}}" alt="{{ $event->title }}">

                        <div class="card-body">

                            <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>

                            <h5 class="card-title">{{ $event->title }}</h5>

                            <p class="card-participants">{{count($event->users)}} participantes</p>

                            <a href="/events/{{ $event->id }}" class="btn btn-warning">Saber mais</a>

                        </div>

                    </div>

                @endforeach

                @if (count($events) == 0)

                    <p>Não há eventos disponíveis</p>

                @endif

            </div>

        </div>


@endsection 