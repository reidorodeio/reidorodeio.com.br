<link rel="stylesheet" href="{{ asset('public/frontend/css/navbar.css') }}">
<script src="{{ asset('public/frontend/js/navbar.js') }}"></script>
<body>

    <div class="centered-container">
        <header class="header">
            <h1>Seja bem vindo!</h1>
            <p class="subtitle">Aqui você escolhe a categoria que gostaria de participar.</p>
        </header>
        
        <div class="event-list">
            @forelse($events as $event)
                <div class="event-card">
                    <h2 class="event-title">{{ $event->event_name }}</h2>
                    <p class="event-category">Categoria: {{ $event->category }}</p>
                    <a href="{{ route('frontend.boloes', ['event_id' => $event->id, 'category' => $event->category]) }}" class="btn">
                        Ver Bolões
                    </a>
                </div>
            @empty
                <p class="no-events">Nenhum evento disponível no momento.</p>
            @endforelse
        </div>
    </div>
  </div>
</body>