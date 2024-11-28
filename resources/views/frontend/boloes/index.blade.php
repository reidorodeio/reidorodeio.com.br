@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <h1>{{ $event->event_name }} - Categoria: {{ $category }}</h1>
    
    <div class="row">
        @foreach ($boloens as $bolao)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('public/storage/boloens/' . $bolao->photo) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Bolão #{{ $bolao->id }}</h5>
                        <p class="card-text">Valor: R$ {{ $bolao->value }}</p>
                        <p class="card-text">Meta de Equipes: {{ $bolao->meta_equipes }}</p>
                        <a href="{{ route('teams.create', $bolao->id) }}" class="btn btn-primary">Participar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
