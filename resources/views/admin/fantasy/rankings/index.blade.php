@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $page_title }}</h4>
    </div>
    <div class="card-body">
        @if($rankings->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID da Equipe</th>
                    <th>ID do Usuário</th>
                    <th>Pontos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $ranking)
                    <tr>
                        <td>{{ $ranking->id }}</td>
                        <td>{{ $ranking->team_id }}</td>
                        <td>{{ $ranking->user_id }}</td>
                        <td>{{ $ranking->points }}</td>
                        <td>
                            <a href="{{ route('admin.fantasy.rankings.edit', $ranking->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            
                            <form action="{{ route('admin.fantasy.rankings.delete', $ranking->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rankings->links() }} <!-- Paginação -->
        @else
            <p>Não há rankings cadastrados no momento.</p>
        @endif
    </div>
</div>
@endsection
