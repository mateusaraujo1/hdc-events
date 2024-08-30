@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<script>
 
function Checkfiles(){
    var fup = document.getElementById('filename');
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

    if(ext =="jpeg" || ext=="png"){
        return true;
    }
    else{
        return false;
    }
}
</script>

<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Crie o seu evento</h1>

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do evento:</label>
            <input class="form-control-file" type="file" id="image" accept="image/*" name="image" placeholder="Imagem do evento">
        </div>

        <div class="form-group">
            <label for="title">Evento:</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Nome do evento" required>
        </div>

        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>

        <div class="form-group">
            <label for="city">Cidade:</label>
            <input class="form-control" type="text" id="city" name="city" placeholder="Local do evento" required>
        </div>

        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer?" required></textarea>
        </div>

        <div class="form-group">
            <label for="">Adicione itens de infraestrutura</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja"> Cerveja
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food"> Open food
            </div>
        </div>

        <input type="submit" class="btn btn-warning" value="Criar evento">

    </form>

</div>

@endsection