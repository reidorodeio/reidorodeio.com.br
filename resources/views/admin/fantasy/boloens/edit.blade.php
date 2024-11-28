@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Editar Bolão</h4>
    </div>
    <div class="card-body">
        {!! Form::model($bolao, ['route' => ['admin.fantasy.boloens.update', $bolao->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

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
                    <option value="{{ $event->id }}" {{ $event->id == $bolao->event_id ? 'selected' : '' }}>
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
            {!! Form::select('status', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="photo">Foto do Bolão</label>
            {!! Form::file('photo', ['class' => 'form-control']) !!}
            @if($bolao->photo)
                <img src="{{ asset('storage/boloens/' . $bolao->photo) }}" alt="Foto do Bolão" style="width: 100px; height: 50px; object-fit: cover;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
