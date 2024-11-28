@if(count($competitors) > 0)
    <ul class="list-group">
        @foreach($competitors as $competitor)
            <li class="list-group-item">{{ $competitor->name }}</li>
        @endforeach
    </ul>
@else
    <p>Nenhum competidor encontrado para este evento.</p>
@endif
