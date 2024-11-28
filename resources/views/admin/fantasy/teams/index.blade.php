@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Times Fantasy</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID da Equipe</th>
                    <th>Competidores</th>
                    <th>Proprietário</th>
                    <th>Pontuação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td> <!-- Exibe o ID da equipe -->

                        <!-- Exibir IDs dos competidores -->
                        <td>
                            @foreach($team->competitors as $competitor)
                                {{ $competitor->id }}<br>
                            @endforeach
                        </td>

                        <!-- Exibe o nome do proprietário (usuário) -->
                        <td>{{ $team->owner->name }}</td>

                        <!-- Calcular a pontuação total -->
                        <td>
                            @php
                                $totalPoints = $team->competitors->sum('points');
                            @endphp
                            {{ $totalPoints }}
                        </td>

                        <!-- Botão para excluir a equipe -->
                        <td>
                            <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir essa equipe?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
