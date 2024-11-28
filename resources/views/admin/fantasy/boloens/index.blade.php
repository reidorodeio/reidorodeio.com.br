@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Lista de Bolões</h4>
        <a href="{{ route('admin.fantasy.boloens.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Novo Bolão</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Valor</th>
                    <th>Valor Base</th>
                    <th>Meta de Equipes</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($boloens as $bolao)
                    <tr>
                        <td>{{ $bolao->id }}</td>
                        <td>{{ $bolao->event->name }}</td>
                        <td>{{ $bolao->value }}</td>
                        <td>{{ $bolao->valor_base }}</td>
                        <td>{{ $bolao->meta_equipes }}</td>
                        <td>{{ $bolao->status ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            @if ($bolao->photo)
                                <img src="{{ asset('public/storage/boloens/' . $bolao->photo) }}" alt="Foto do Bolão" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.fantasy.boloens.edit', $bolao->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.fantasy.boloens.delete', $bolao->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $boloens->links() }} <!-- Paginação -->
    </div>
</div>
@endsection
