@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Editar Competidor</h4>
    </div>
    <div class="card-body">
        {!! Form::model($competitor, ['route' => ['admin.fantasy.competitors.update', $competitor->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <!-- Campo para nome do competidor -->
        <div class="form-group">
            <label for="name">Nome do Competidor</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Competidor', 'required']) !!}
        </div>

        <!-- Campo para evento e categoria -->
        <div class="form-group">
            <label for="event_id">Evento</label>
            {!! Form::select('event_id', $events->pluck('name', 'id'), $competitor->event_id, ['class' => 'form-control', 'required', 'id' => 'event-select']) !!}
        </div>

        <div class="form-group">
            <label for="category">Categoria do Evento</label>
            {!! Form::text('category', $competitor->event->category, ['class' => 'form-control', 'readonly', 'id' => 'category-field']) !!}
        </div>

        <!-- Campo para tipo de competidor -->
        <div class="form-group">
            <label for="type">Tipo de Competidor</label>
            {!! Form::select('type', ['Capitão' => 'Capitão', 'Médio' => 'Médio', 'Presilha' => 'Presilha'], null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Upload de foto -->
        <div class="form-group">
            <label for="photo">Foto do Competidor</label>
            {!! Form::file('photo', ['class' => 'form-control']) !!}
            @if($competitor->photo)
                <img src="{{ asset('public/images/competitors/' . $competitor->photo) }}" alt="Foto do Competidor" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
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
