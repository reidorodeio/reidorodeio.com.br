@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Editar Evento de Fantasy</h4>
    </div>
    <div class="card-body">
        {!! Form::model($event, ['route' => ['admin.fantasy.events.update', $event->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

            <!-- Campo para nome do evento -->
            <div class="form-group">
                <label for="name">Nome do Evento</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Evento']) !!}
            </div>

            <!-- Campo para categoria do evento -->
            <div class="form-group">
               <label for="category">Categoria</label>
               {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Nome da Categoria', 'required']) !!}
            </div>

            <!-- Exibição do total de prêmios -->
            <div class="form-group">
                <label for="total_premios">Total de Prêmios</label>
                <input type="text" class="form-control" value="R$ {{ number_format($event->calcularTotalPremios(), 2, ',', '.') }}" readonly>
            </div>

            <!-- Upload de imagem -->
            <div class="form-group">
                <label for="photo">Foto do Evento</label>
                <input type="file" class="form-control" name="photo">
                @if($event->photo)
                    <img src="{{ asset('public/storage/events/' . $event->photo) }}" alt="Imagem do Evento" width="100">
                @endif
            </div>

            <!-- Campo para status do evento -->
            <div class="form-group">
                <label for="status">Status</label>
                {!! Form::select('status', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) !!}
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>

        {!! Form::close() !!}
    </div>
</div>
@endsection
