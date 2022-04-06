@extends("layouts.main")

@section('title', 'Criar Evento')

@section('content')

    <div class="container">
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem do evento</label>
                <input type="file" class="form-control-file" name="image" id="image" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="title">Nome do Evento</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="date">Data do Evento:</label>
                <input type="date" class="form-control" name="date" id="date" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="private">Evento privado?</label>
                <select id="private" name="private" class="custom-select custom-select-lg mb-3">
                    <option selected>Evento privado?</option>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" class="form-control" id="description" placeholder="O que irá acontecer no evento"></textarea>
            </div>
            <div class="form-group">
                <label for="description">Itens</label>
                <div class="form-check">
                    <input class="form-check-input" name="items[]" type="checkbox" value="Cadeiras">Cadeiras
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="items[]" type="checkbox" value="Palco">Palco
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="items[]" type="checkbox" value="Cerveja grátis">Cerveja grátis
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="items[]" type="checkbox" value="open Food">open Food
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="items[]" type="checkbox" value="Brindes">Brindes
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Criar Evento</button>
        </form>
    </div>

@endsection
