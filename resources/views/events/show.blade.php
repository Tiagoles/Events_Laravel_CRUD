@extends('layouts.main')
@section('title', $event->title)
@section('content')

    <div class="containerOneEvent col-md-12 ms-2 d-flex flex-md-row mt-4 mb-4">
        <div class="row">
            <div class="imageContainer col-md-4 mt-5 ms-3 flex-md-column ">
                <img class="img-fluid" src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" id="imageOneEvent">
                <div class="descriptionContainer">
                    <p>{{ ucfirst($event->description) }}</p>
                </div>
            </div>

            <div class="infoContainer col-md-4 text-center mt-5 pe-5">
                <h1>{{ ucfirst($event->title )}}</h1>
                <p class="eventCity">
                    <ion-icon name="location-outline"></ion-icon>
                    {{ ucfirst($event->city) }}
                </p>
                <p class="eventDate">
                    <ion-icon name="calendar-outline"></ion-icon>
                    {{date('d-m-Y', strtotime($event->date))}}
                </p>
                <p class="event-participants">
                    <ion-icon name="people-outline"></ion-icon>
                    X participantes
                </p>
                <p class="event-owner">
                    <ion-icon name="star-outline"></ion-icon>
                    {{ ucfirst($eventOwner['name']) }}
                </p>
                <a href="#" class="btnSubmit" id="confirmPresence">Confirmar presença</a>
                <ul class="ContainerItemsIncluse">
                    @foreach ($event->items as $item)
                        <li>
                            <ion-icon name="play-outline"></ion-icon>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
