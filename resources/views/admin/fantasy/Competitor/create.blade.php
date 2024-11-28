@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Adicionar Novo Competidor</h4>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.fantasy.competitors.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <!-- Campo para nome do competidor -->
        <div class="form-group">
            <label for="name">Nome do Competidor</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Competidor', 'required']) !!}
        </div>

        <!-- Campo para selecionar o evento e exibir a categoria -->
        <div class="form-group">
            <label for="event_id">Evento</label>
            {!! Form::select('event_id', $events->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Selecione o Evento', 'required', 'id' => 'event-select']) !!}
        </div>

        <div class="form-group">
            <label for="category">Categoria do Evento</label>
            {!! Form::text('category', null, ['class' => 'form-control', 'readonly', 'id' => 'category-field']) !!}
        </div>

        <!-- Campo para tipo de competidor -->
        <div class="form-group">
            <label for="type">Tipo de Competidor</label>
            {!! Form::select('type', ['Capitão' => 'Capitão', 'Médio' => 'Médio', 'Presilha' => 'Presilha'], null, ['class' => 'form-control', 'placeholder' => 'Selecione o Tipo', 'required']) !!}
        </div>

        <!-- Campo para adicionar foto -->
        <div class="form-group">
            <label for="photo">Foto do Competidor</label>
            {!! Form::file('photo', ['class' => 'form-control']) !!}
        </div>

        <!-- Botão de submit -->
        <button type="submit" class="btn btn-success">Salvar</button>

        {!! Form::close() !!}
    </div>
</div>

<script>
// Atualiza a categoria ao selecionar o evento
document.getElementById('event-select').addEventListener('change', function() {
    var selectedEventId = this.value;
    var events = {!! $events->toJson() !!};

    // Busca o evento e atualiza o campo de categoria
    var selectedEvent = events.find(event => event.id == selectedEventId);
    if (selectedEvent) {
        document.getElementById('category-field').value = selectedEvent.category;
    }
});
</script>
@endsection
