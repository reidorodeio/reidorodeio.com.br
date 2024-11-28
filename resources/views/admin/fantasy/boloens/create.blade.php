@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Adicionar Novo Bolão</h4>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.fantasy.boloens.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            <label for="valor_base">Valor Base do Prêmio</label>
            {!! Form::number('valor_base', null, ['class' => 'form-control', 'placeholder' => 'Ex: 10000', 'required']) !!}
        </div>

        <div class="form-group">
            <label for="meta_equipes">Meta de Equipes</label>
            {!! Form::number('meta_equipes', null, ['class' => 'form-control', 'placeholder' => 'Ex: 1200', 'required']) !!}
        </div>    

        <div class="form-group">
            <label for="event_id">Evento</label>
            <select name="event_id" class="form-control" required>
                <option value="">Selecione um Evento</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">
                        {{ $event->name }} - Categoria: {{ $event->category ?? 'Sem Categoria' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="value">Valor</label>
            {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Valor']) !!}
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            {!! Form::select('status', [1 => 'Ativo', 0 => 'Inativo'], 1, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="photo">Foto do Bolão</label>
            {!! Form::file('photo', ['class' => 'form-control']) !!}
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
