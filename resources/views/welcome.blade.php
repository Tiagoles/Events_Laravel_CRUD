@extends('layouts.main')
@section('title', 'Hdc Events')
@section('content')
    <div id="search_container">
        <h1 id="title_search">Busque por um evento</h1>
        <div id="search_input_container">
            <form action="/" method="GET">
                <input type="text" id="search" name="search" placeholder="Procurar">
            </form>
        </div>
    </div>
    <div id="events_container">
        @if ($search)
            <h2 class="title_event_container">Buscando por"{{ $search }}"</h2>
            <p class="show_next_events">Veja os eventos buscados dos próximos dias</p>
        @else
            <h2 class="title_event_container">Proximos eventos</h2>
            <p class="show_next_events">Veja os eventos dos próximos dias</p>
        @endif

        <div class="card_container">
            @foreach ($events as $event)
                <div class="card">
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" id="img_card">
                    <p class="card_date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h3 class="card_title">{{ Str::ucfirst($event->title) }}</h3>
                    <p class="card_participants">{{count($event->users)}} participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn_card">Saber mais</a>
                </div>
            @endforeach

        </div>
    </div>
    @if (count($events) == 0 && $search)
        <p class="noEvents">Não foi possível encontrar resultados para "{{ $search }}". <a href="/">Veja todos</a></p>
    @elseif (count($events) == 0)
        <p class="noEvents">Não há eventos disponíveis no momento.</p>
    @endif


@endsection
