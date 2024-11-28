<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\FantasyEvent; // Certifique-se de importar o model correto

class NavbarComposer
{
    public function compose(View $view)
    {
        // Recupera todos os eventos com a categoria
        $events = FantasyEvent::with('category')->get(); 

        // Passa a variável $events para a view
        $view->with('events', $events);
    }
}
