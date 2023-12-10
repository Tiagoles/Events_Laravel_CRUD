@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1 class="">Meus eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-event-container">
        @if (count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td id="dashboard-event-title">
                                <a href="/events/{{ $event->id }}"> {{ Str::ucfirst($event->title) }} </a>
                            </td>
                            <td>0</td>
                            <td>
                                <button href="#" class="dashboard-actions btn btn-outline-primary" id="btnEditForm"
                                    data-bs-toggle="modal" data-bs-target="#modalEdit_{{ $event->id }}">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </button>

                                <div class="modal fade" tabindex="-1" id="modalEdit_{{ $event->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="events/update/{{$event->id}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editando: {{ Str::ucfirst($event->title) }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items center flex-column">

                                                    <label for="title">Nome do evento:</label>
                                                    <input type="text" class="form_event_create" name="title"
                                                        id="title" placeholder="Edite o nome do evento" maxlength="15"
                                                        minlength="4" value="{{Str::ucfirst($event->title)}}">

                                                    <label for="date">Data do evento:</label>
                                                    <input type="date" name="date" id="date"
                                                        class="form_event_create" value="{{date('Y-m-d', strtotime($event->date)) }}">

                                                    <label for="city">Cidade:</label>
                                                    <input type="text" class="form_event_create" name="city"
                                                        id="city" placeholder="Edite a cidade do evento" value="{{Str::ucfirst($event->city)}}">

                                                    <label for="descriptionEvent">Descrição:</label>
                                                    <textarea name="descriptionEvent" id="descriptionEvent" class="form_event_create" cols="30" rows="10"
                                                        placeholder="Edite a descrição do evento" style="width: auto">{{Str::ucfirst($event->description)}}</textarea>

                                                    <label for="imageEvent" id="labelForImageEvent">Edite a Imagem:</label>
                                                    <input type="file" name="image" id="imageEvent"
                                                        style="display:block">
                                                    <div class="img-preview-container-arrow">
                                                        <p>Preview da imagem
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-caret-down-fill arrowDownEditEvent" viewBox="0 0 16 16"
                                                                    id="arrowDownEditEvent">
                                                                    <path
                                                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                                                </svg>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    id="arrowUpEditEvent" height="16" fill="currentColor"
                                                                    class="bi bi-caret-up-fill arrowUpEditEvent" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                                                </svg>
                                                            </span>
                                                        </p>
                                                        <div id="container-img-preview-edit-event" class="container-img-preview-edit-event">
                                                            <img src="/img/events/{{ $event->image }}" class="img-preview"
                                                                alt="{{ $event->title }}" id="img-preview-edit-event">
                                                        </div>
                                                    </div>
                                                    <label for="LabelprivateOrPublicEdit"
                                                        id="LabelprivateOrPublicEdit">Público / Privado</label>
                                                    <select name="privateOrPublic" id="privateOrPublic"
                                                        class="form_event_create">
                                                        <option value="1" >Público</option>
                                                        <option value="0" {{$event->private == "0" ? "selected" : ""}}>Privado</option>
                                                    </select>
                                                    <div class="items-group">
                                                        <label id="itemsText">Itens Adicionais:</label>
                                                        <div class="containerItems">
                                                            <label for="chairs" class="custom-checkbox">
                                                                <input type="checkbox" name="items[]" class="check"
                                                                    id="chairs" value="Cadeiras">Cadeiras
                                                                <span class="checkmark">&#10003;</span>
                                                            </label>
                                                            <label for="openFood" class="custom-checkbox">
                                                                <input type="checkbox" name="items[]" class="check"
                                                                    id="openFood" value="OpenFood">Comida
                                                                grátis
                                                                <span class="checkmark">&#10003;</span>

                                                            </label>
                                                            <label for="openBeer" class="custom-checkbox">
                                                                <input type="checkbox" name="items[]" class="check"
                                                                    id="openBeer" value="OpenBeer">Cerveja
                                                                grátis
                                                                <span class="checkmark">&#10003;</span>

                                                            </label>
                                                            <label for="stage" class="custom-checkbox">
                                                                <input type="checkbox" name="items[]" class="check"
                                                                    id="stage" value="Palco">Palco
                                                                <span class="checkmark">&#10003;</span>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Fechar
                                                    </button>
                                                    <button class="btn btn-success">
                                                        Salvar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <i class="bi bi-trash3-fill"></i>
                                <form action="/events/{{ $event->id }}" method="post" id="FormDeleteEvent">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger" class="btnDeleteForm">
                                        <ion-icon name="trash"></ion-icon>
                                        Deletar
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="noEvents">Você ainda não possui eventos.
                <button class="btn btn-sm btn-outline-warning btnCreateEventToDashboard">
                    Criar
                </button>
            </p>
        @endif
    </div>
@endsection
