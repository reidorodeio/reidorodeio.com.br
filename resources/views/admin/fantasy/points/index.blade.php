@extends('admin.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Pontuar Fantasy: Lista de Eventos</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Evento</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category }}</td>
                        <td>
                            <!-- Botão para abrir o modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#competitorsModal-{{ $event->id }}">
                                Ver Competidores
                            </button>

                            <!-- Modal com lista de competidores -->
                            <div class="modal fade" id="competitorsModal-{{ $event->id }}" tabindex="-1" aria-labelledby="competitorsModalLabel-{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="competitorsModalLabel-{{ $event->id }}">Competidores do Evento: {{ $event->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- Live do YouTube -->
                                            <div class="youtube-live mb-3">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/0XS2_XXjCU8?si=hxH593mSd93wSj5X" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <input type="text" class="form-control mb-3 search-competitor" placeholder="Pesquisar competidor..." data-event-id="{{ $event->id }}">
                                            
                                            <!-- Lista de Competidores -->
                                            <div id="competitorList-{{ $event->id }}">
                                                @foreach($event->competitors as $competitor)
                                                    <div class="competitor-section mb-3">
                                                        <!-- Linha clicável para abrir o menu -->
                                                        <div class="competitor-header d-flex justify-content-between align-items-center" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#competitorOptions-{{ $competitor->id }}" aria-expanded="false" aria-controls="competitorOptions-{{ $competitor->id }}">
                                                            <h5 class="mb-0">{{ $competitor->name }}</h5>
                                                            <i class="fas fa-chevron-down"></i> <!-- Ícone de abrir/fechar -->
                                                        </div>

                                                        <!-- Menu de pontuação -->
                                                        <div class="collapse competitor-collapse" id="competitorOptions-{{ $competitor->id }}">
                                                            <div class="card card-body mt-2">
                                                                <!-- Submenus -->
                                                                <h6 data-bs-toggle="collapse" data-bs-target="#armadasBoas-{{ $competitor->id }}" aria-expanded="false" aria-controls="armadasBoas-{{ $competitor->id }}" style="cursor: pointer;">Armadas Boas</h6>
                                                                <div class="collapse" id="armadasBoas-{{ $competitor->id }}">
                                                                    <div class="d-flex flex-wrap">
                                                                        <button class="btn btn-success m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="50">BOA +50</button>
                                                                        <button class="btn btn-success m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="100">Limpo Cupim +100</button>
                                                                        <button class="btn btn-success m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="150">Limpo Garupa +150</button>
                                                                        <button class="btn btn-success m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">Pescou +200</button>
                                                                        <button class="btn btn-success m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="500">Limpo TOP +500</button>
                                                                    </div>
                                                                </div>

                                                                <h6 data-bs-toggle="collapse" data-bs-target="#armadasBrancas-{{ $competitor->id }}" aria-expanded="false" aria-controls="armadasBrancas-{{ $competitor->id }}" style="cursor: pointer;">Armadas Brancas</h6>
                                                                <div class="collapse" id="armadasBrancas-{{ $competitor->id }}">
                                                                    <div class="d-flex flex-wrap">
                                                                        <button class="btn btn-danger m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="-200">Pescoço -200</button>
                                                                        <button class="btn btn-danger m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="-300">Dobrada -300</button>
                                                                        <button class="btn btn-danger m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="-150">Garupa -150</button>
                                                                        <button class="btn btn-danger m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="-500">Top -500</button>
                                                                    </div>
                                                                </div>

                                                                <h6 data-bs-toggle="collapse" data-bs-target="#vitoriasExtras-{{ $competitor->id }}" aria-expanded="false" aria-controls="vitoriasExtras-{{ $competitor->id }}" style="cursor: pointer;">Vitórias e Extras</h6>
                                                                <div class="collapse" id="vitoriasExtras-{{ $competitor->id }}">
                                                                    <div class="d-flex flex-wrap">
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#forcaA-{{ $competitor->id }}" aria-expanded="false" aria-controls="forcaA-{{ $competitor->id }}" style="cursor: pointer;">Força A  /</h6>
                                                                        <div class="collapse" id="forcaA-{{ $competitor->id }}">
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="400">Racha +7 +400</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="800">Racha +3 +800</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="1000">Racha -3 +1000</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="1600">Sozinho +1600</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="400">2 Vidas +400</button>
                                                                        </div>
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#forcaB-{{ $competitor->id }}" aria-expanded="false" aria-controls="forcaB-{{ $competitor->id }}" style="cursor: pointer;">Força B  /</h6>
                                                                        <div class="collapse" id="forcaB-{{ $competitor->id }}">
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">Racha +7 +200</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="400">Racha +3 +400</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="500">Racha -3 +500</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="800">Sozinho +800</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">2 Vidas +200</button>
                                                                        </div>
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#forcaC-{{ $competitor->id }}" aria-expanded="false" aria-controls="forcaC-{{ $competitor->id }}" style="cursor: pointer;">Força C  /</h6>
                                                                        <div class="collapse" id="forcaC-{{ $competitor->id }}">
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="100">Racha +7 +100</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">Racha +3 +200</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="250">Racha -3 +250</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="400">Sozinho +400</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="100">2 Vidas +100</button>
                                                                        </div>
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#forcaD-{{ $competitor->id }}" aria-expanded="false" aria-controls="forcaD-{{ $competitor->id }}" style="cursor: pointer;">Força D  /</h6>
                                                                        <div class="collapse" id="forcaD-{{ $competitor->id }}">
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="50">Racha +7 +50</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="100">Racha +3 +100</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="125">Racha -3 125</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">Sozinho +200</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="50">2 Vidas +50</button>
                                                                        </div>
                                                                        <h6 data-bs-toggle="collapse" data-bs-target="#extras-{{ $competitor->id }}" aria-expanded="false" aria-controls="extras-{{ $competitor->id }}" style="cursor: pointer;">Extras  /</h6>
                                                                        <div class="collapse" id="extras-{{ $competitor->id }}">
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="200">+1 Modalidade +200</button>
                                                                            <button class="btn btn-primary m-1 update-points" data-competitor-id="{{ $competitor->id }}" data-points="300">+1 Laçada Extra +300</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de sucesso -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Sucesso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Pontuação atualizada! Nova pontuação: <span id="newPoints"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Incluindo o jQuery antes de qualquer outro script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para alternar o ícone e fechar menus corretamente -->
<script>
    $(document).ready(function() {
        // Remover eventuais ouvintes duplicados e garantir que o evento de clique seja configurado apenas uma vez
        $('.competitor-header').off('click').on('click', function() {
            var target = $(this).data('bs-target');
            var icon = $(this).find('i');

            // Verificar se o colapso já está aberto
            if ($(target).hasClass('show')) {
                $(target).collapse('hide');
                icon.removeClass('fa-times').addClass('fa-chevron-down'); // Troca para seta ao fechar
            } else {
                // Fechar todos os outros colapsos abertos
                $('.competitor-collapse').collapse('hide');
                $('.competitor-header i').removeClass('fa-times').addClass('fa-chevron-down'); // Reseta as setas

                // Abrir o colapso atual e trocar o ícone para "X"
                $(target).collapse('show');
                icon.removeClass('fa-chevron-down').addClass('fa-times');
            }
        });

        // Submenu: apenas submenus internos são afetados
        $('.competitor-collapse .collapse').on('show.bs.collapse', function() {
            $(this).parent().find('.collapse').not(this).collapse('hide');
        });

        // Função de pesquisa
        $('.search-competitor').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            var eventId = $(this).data('event-id');

            $('#competitorList-' + eventId + ' .competitor-section').each(function() {
                var competitorName = $(this).find('.competitor-header h5').text().toLowerCase();
                if (competitorName.indexOf(searchText) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Atualizar pontos via Ajax
        $('.update-points').off('click').on('click', function(e) {
            e.preventDefault();

            var competitorId = $(this).data('competitor-id');
            var points = $(this).data('points');

            $.ajax({
                url: "{{ route('competitor.updatePoints') }}",  // Certifique-se de que a rota esteja correta
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",  // Token CSRF para segurança
                    competitor_id: competitorId,
                    points: points
                },
                success: function(response) {
                    if (response.success) {
                        // Atualiza o modal com a nova pontuação
                        $('#newPoints').text(response.new_points);

                        // Exibe o modal de sucesso
                        $('#successModal').modal('show');

                        // Atualiza o ranking em tempo real (caso necessário)
                        updateRanking();
                    } else {
                        alert('Erro: ' + response.message);
                    }
                },
                error: function() {
                    alert('Erro ao tentar atualizar a pontuação. Tente novamente.');
                }
            });
        });

        function updateRanking() {
            $.ajax({
                url: "{{ route('ranking.update') }}", // Rota que atualiza o ranking
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Atualizar a interface do ranking (se necessário)
                },
                error: function() {
                    alert('Erro ao tentar atualizar o ranking.');
                }
            });
        }
    });
</script>

@endsection
