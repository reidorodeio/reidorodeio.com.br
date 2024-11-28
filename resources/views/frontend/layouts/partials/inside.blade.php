@extends('frontend.layouts.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/frontend/css/inside.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-parent">
    <!-- Primeiro container -->
    <div class="rounded-container">
        <h2>Sinta emoção em cada armada!</h2>
        <h3>O primeiro site de rodeio online do mundo.</h3>
        <div class="content-flex">
            <!-- Estatísticas e Botão -->
            <div class="stats-and-button">
                <div class="stats-container">
                    <div class="stat-item">
                        <i class="fa fa-user"></i> <span id="totalUsers">0</span>
                        <div class="label">Usuários Cadastrados</div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-piggy-bank"></i><span id="totalAwards">R$ 0,00</span>
                        <div class="label">Prêmios Ativos</div>
                    </div>
                </div>
                <div class="button-container">
                    <a href="{{ route('frontend.index') }}" class="btn-secondary my-custom-button">Entrar agora</a>
                </div>
            </div>

            <!-- Slider -->
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="{{ asset('public/images/sliderinside/img1.png') }}" alt="Imagem 1" style="width: 100%; height: auto;">
                    </div>
                    <div class="item">
                        <img src="{{ asset('public/images/sliderinside/img2.png') }}" alt="Imagem 2" style="width: 100%; height: auto;">
                    </div>
                    <div class="item">
                        <img src="{{ asset('public/images/sliderinside/img3.png') }}" alt="Imagem 3" style="width: 100%; height: auto;">
                    </div>
                    <div class="item">
                        <img src="{{ asset('public/images/sliderinside/img4.png') }}" alt="Imagem 4" style="width: 100%; height: auto;">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"><</button>
                    <button id="next">></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo container -->
    <div class="rounded-container2">
        <p class="typing-text3">Já imaginou sua equipe dos sonhos?</p>
        <img src="{{ asset('public/images/sliderinside/team.png') }}" alt="Imagem 3" style="width: auto; height: auto;">
        <p class="typing-text4">Você escolhe seu Capitão, Meios e Presilha...</p>
        <p class="typing-text4">Monte sua equipe campeã!</p>
        <p class="typing-text4">Dispute prêmios reais.</p>
        <p class="typing-text4">Viva o rodeio como nunca.</p>
        <p class="typing-text4">Cada armada conta pontos.</p>
        <p class="typing-text4">Suba no ranking do rodeio!</p>
        <a href="{{ route('frontend.index') }}" class="btn-secondary my-custom-button">Jogar agora</a>
    </div>
</div>

<!-- Inclui os scripts para o slider -->
<script src="{{ asset('public/backend/js/app.js') }}"></script>
<script src="{{ asset('public/frontend/js/slider.js') }}"></script>
<script>
    // Função para buscar dados do dashboard
    function fetchDashboardData() {
        fetch('{{ route('dashboard.data') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalUsers').textContent = data.totalUsers;
                document.getElementById('totalAwards').textContent = data.totalAwards;
                document.getElementById('totalBolao').textContent = data.totalBolao;
            })
            .catch(error => console.error('Erro ao buscar dados do dashboard:', error));
    }

    // Carrega os dados do dashboard quando a página é carregada
    document.addEventListener('DOMContentLoaded', fetchDashboardData);
</script>
@endsection
