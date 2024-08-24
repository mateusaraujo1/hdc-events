@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Crie o seu evento</h1>

    <form action="/events" method="POST">

        <div class="form-group">
            <label for="title">Eventos:</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Nome do evento">
        </div>

        <div class="form-group">
            <label for="title">Cidade:</label>
            <input class="form-control" type="text" id="city" name="city" placeholder="Local do evento">
        </div>

        <div class="form-group">
            <label for="title">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer?"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Criar evento">

    </form>

</div>

@endsection