@extends('layouts.main')
@section('title', 'Criar Evento')
@section('content')
    <div id="event_container">
        <h1>Crie o seu evento</h1>
        <div id="event_create_container">
            <form action="/events" method="post" enctype="multipart/form-data">
                @csrf
                <label for="title">Evento:</label>
                <input type="text" class="form_event_create" name="title" id="title"
                    placeholder="Digite o nome do evento" maxlength="15" minlength="4">

                <label for="date">Data do evento:</label>
                <input type="date" name="date" id="date" class="form_event_create">

                <label for="city">Cidade:</label>
                <input type="text" class="form_event_create" name="city" id="city"
                    placeholder="Digite a cidade do evento">

                <label for="descriptionEvent">Descrição:</label>
                <textarea name="descriptionEvent" id="descriptionEvent" class="form_event_create" cols="30" rows="10"
                    placeholder="Digite uma descrição para o evento"></textarea>

                <label for="imageEvent" id="labelForImageEvent">Imagem:</label>
                <input type="file" name="image" id="imageEvent">

                <label for="privateOrPublic" id="LabelprivateOrPublic">Público / Privado</label>
                <select name="privateOrPublic" id="privateOrPublic" class="form_event_create">
                    <option value="0">Privado</option>
                    <option value="1">Público</option>
                </select>
                <div class="items-group">
                    <label id="itemsText">Itens Adicionais:</label>
                    <div class="containerItems">
                        <label for="chairs" class="custom-checkbox">
                            <input type="checkbox" name="items[]" class="check" id="chairs" value="Cadeiras">Cadeiras
                            <span class="checkmark">&#10003;</span>
                        </label>
                        <label for="openFood" class="custom-checkbox">
                            <input type="checkbox" name="items[]" class="check" id="openFood" value="OpenFood">Comida
                            grátis
                            <span class="checkmark">&#10003;</span>

                        </label>
                        <label for="openBeer" class="custom-checkbox">
                            <input type="checkbox" name="items[]" class="check" id="openBeer" value="OpenBeer">Cerveja
                            grátis
                            <span class="checkmark">&#10003;</span>

                        </label>
                        <label for="stage" class="custom-checkbox">
                            <input type="checkbox" name="items[]" class="check" id="stage" value="Palco">Palco
                            <span class="checkmark">&#10003;</span>
                        </label>

                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success" id="btnCreateEvent">Criar Evento</button>
            </form>
        </div>
    </div>
@endsection
