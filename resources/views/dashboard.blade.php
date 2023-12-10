@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-event-container">
        @if(count($events) > 0)
        
        @else
            <p>Você ainda não possui eventos. <a href="/events/create">Crie</a> um agora mesmo!</p>
        @endif
    </div>
@endsection
