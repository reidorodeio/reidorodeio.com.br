@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Lista de Competidores</h4>
        <a href="{{ route('admin.fantasy.competitors.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Novo Competidor</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Evento</th> <!-- Exibe o evento -->
                    <th>Categoria</th> <!-- Exibe a categoria -->
                    <th>Tipo</th>
                    <th>Pontos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competitors as $competitor)
                <tr>
                    <td>{{ $competitor->id }}</td>
                    <td>
                        @if($competitor->photo)
                            <img src="{{ asset('public/images/competitors/' . $competitor->photo) }}" alt="Foto do Competidor" width="50">
                        @else
                            Sem Foto
                        @endif
                    </td>
                    <td>{{ $competitor->name }}</td>
                    <td>{{ $competitor->event->name }}</td> <!-- Exibe o nome do evento -->
                    <td>{{ $competitor->event->category ?? 'Sem Categoria' }}</td> <!-- Exibe a categoria -->
                    <td>{{ $competitor->type }}</td>
                    <td>{{ $competitor->points }}</td>
                    <td>
                        <a href="{{ route('admin.fantasy.competitors.edit', $competitor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.fantasy.competitors.delete', $competitor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $competitors->links() }} <!-- Paginação -->
    </div>
</div>
@endsection
