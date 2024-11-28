@extends('frontend.layouts.master')

<link rel="stylesheet" href="{{ asset('public/frontend/css/team-selection.css') }}">

<!-- Incluir o arquivo de script -->
<script src="{{ asset('public/frontend/js/team-selection.js') }}"></script>

@section('content')
<div class="container">
    <h5>Montar Equipe para o Bolão: {{ $bolao->id }}</h5>

    <form action="{{ route('teams.store', ['bolao_id' => $bolao->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="bolao_id" value="{{ $bolao->id }}">

        <!-- Capitão -->
        <div class="mb-3">
            <label for="capitao" class="form-label">Capitão</label>
            <div class="competitor-carousel-wrapper">
                <div class="competitor-carousel" id="capitao-carousel">
                    @foreach($capitaes as $capitao)
                        <div class="competitor-item" data-id="{{ $capitao->id }}" data-photo="{{ asset('public/images/competitors/' . $capitao->photo) }}">
                            <img src="{{ asset('public/images/competitors/' . $capitao->photo) }}" alt="{{ $capitao->name }}" class="competitor-photo">
                            <span>{{ $capitao->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="capitao-selected" class="mt-3" style="display: none;">
                <img id="capitao-photo" src="" alt="Capitão" width="50">
                <input type="hidden" name="capitao_id" id="capitao-id">
            </div>
        </div>

        <!-- Médios -->
        <div class="mb-3">
            <label for="medio1" class="form-label">Médios</label>
            <div class="competitor-carousel-wrapper">
                <div class="competitor-carousel" id="medio-carousel">
                    @foreach($meios as $medio)
                        <div class="competitor-item" data-id="{{ $medio->id }}" data-photo="{{ asset('public/images/competitors/' . $medio->photo) }}">
                            <img src="{{ asset('public/images/competitors/' . $medio->photo) }}" alt="{{ $medio->name }}" class="competitor-photo">
                            <span>{{ $medio->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="medios-selected" class="mt-3" style="display: none;">
                <img id="medio1-photo" src="" alt="Médio 1" width="50">
                <img id="medio2-photo" src="" alt="Médio 2" width="50">
                <input type="hidden" name="meio1_id" id="medio1-id">
                <input type="hidden" name="meio2_id" id="medio2-id">
            </div>
        </div>

        <!-- Presilha -->
        <div class="mb-3">
            <label for="presilha" class="form-label">Presilha</label>
            <div class="competitor-carousel-wrapper">
                <div class="competitor-carousel" id="presilha-carousel">
                    @foreach($presilhas as $presilha)
                        <div class="competitor-item" data-id="{{ $presilha->id }}" data-photo="{{ asset('public/images/competitors/' . $presilha->photo) }}">
                            <img src="{{ asset('public/images/competitors/' . $presilha->photo) }}" alt="{{ $presilha->name }}" class="competitor-photo">
                            <span>{{ $presilha->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="presilha-selected" class="mt-3" style="display: none;">
                <img id="presilha-photo" src="" alt="Presilha" width="50">
                <input type="hidden" name="presilha_id" id="presilha-id">
            </div>
        </div>

    </form>
</div>

<!-- Bilhete fixo -->
<div id="bilhete-fixo">
    <div class="bilhete-item">
        <img id="bilhete-capitao-photo" src="" alt="Capitão" class="bilhete-photo" style="display: none;">
        <span id="bilhete-capitao-name">Capitão</span>
    </div>
    <div class="bilhete-item">
        <img id="bilhete-medio1-photo" src="" alt="Médio 1" class="bilhete-photo" style="display: none;">
        <span id="bilhete-medio1-name">Médio 1</span>
    </div>
    <div class="bilhete-item">
        <img id="bilhete-medio2-photo" src="" alt="Médio 2" class="bilhete-photo" style="display: none;">
        <span id="bilhete-medio2-name">Médio 2</span>
    </div>
    <div class="bilhete-item">
        <img id="bilhete-presilha-photo" src="" alt="Presilha" class="bilhete-photo" style="display: none;">
        <span id="bilhete-presilha-name">Presilha</span>
    </div>
    <button id="finalizar-btn" class="btn btn-primary" disabled>Finalizar</button>
</div>

@endsection
