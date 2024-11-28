@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Lista de Eventos de Fantasy</h4>
        <a href="{{ route('admin.fantasy.events.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Novo Evento</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th> <!-- Nova Coluna para Foto -->
                    <th>Nome</th>
                    <th>Categoria</th> <!-- Atualizado para exibir categoria como texto -->
                    <th>Total de Prêmios</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>
                            @if($event->photo)
                                <img src="{{ asset('public/storage/events/' . $event->photo) }}" alt="Foto do Evento" style="width: 100px; height: 50px; object-fit: cover;">
                            @else
                                Sem Foto
                            @endif
                        </td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category }}</td> <!-- Exibe a categoria como texto -->
                        <td>R$ {{ number_format($event->calcularTotalPremios(), 2, ',', '.') }}</td> <!-- Total de Prêmios dos Bolões -->
                        <td>{{ $event->status ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('admin.fantasy.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.fantasy.events.delete', $event->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $events->links() }} <!-- Paginação -->
    </div>
</div>
@endsection
