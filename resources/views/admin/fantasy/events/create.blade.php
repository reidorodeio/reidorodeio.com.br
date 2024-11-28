@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Adicionar Novo Evento de Fantasy</h4>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.fantasy.events.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
            <!-- Campo para nome do evento -->
            <div class="form-group">
                <label for="name">Nome do Evento</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Evento', 'required']) !!}
            </div>

            <!-- Campo para categoria do evento -->
            <div class="form-group">
                <label for="category">Categoria</label>
                {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Nome da Categoria', 'required']) !!}
            </div>

            <!-- Upload de imagem -->
            <div class="form-group">
                <label for="photo">Foto do Evento</label>
                <input type="file" class="form-control" name="photo" required>
            </div>

            <!-- Campo para status do evento -->
            <div class="form-group">
                <label for="status">Status</label>
                {!! Form::select('status', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control', 'required']) !!}
            </div>
            
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            
        {!! Form::close() !!}
    </div>
</div>
@endsection
