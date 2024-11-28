<header class="navbar-top">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/nav.css') }}">
    <div class="logo">
        <a href="{{ route('frontend.layouts.partials.inside') }}">
            <img src="{{ asset('public/images/logo/logo.png') }}" width="200" alt="Logo">
        </a>
    </div>
    <nav class="navigation">
        @guest
            <!-- Exibe o botão de login caso o usuário não esteja autenticado -->
            <a href="{{ route('login') }}" class="buttonheadertop">
                Entrar agora
            </a>
        @endguest

        @auth
            <!-- Menu expansível -->
            <div class="btn-pluss-wrapper">
                <button id="menu-toggle" class="btn-pluss">+</button>

                <!-- Menu pop-out -->
                <div id="menu-container" class="menu-popout">
                    <ul>
                        <!-- Link para o perfil -->
                        <li>
                            <a href="{{ route('profile.index') }}">Perfil</a>
                        </li>
                        <!-- Botão para logout -->
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0; padding: 0;">
                                @csrf
                                <button type="submit" class="logout-button">
                                    Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Verifica se Auth::user() existe antes de exibir a foto -->
            @if (Auth::user() && Auth::user()->image_url)
                <div class="profile-wrapper">
                    <img 
                        src="{{ Auth::user()->image_url }}" 
                        alt="Foto de Perfil" 
                        class="profile-picture">
                </div>
            @endif
        @endauth
    </nav>
</header>

<!-- Script para o menu expansível -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('menu-toggle');
        const menuContainer = document.getElementById('menu-container');

        // Alterna a exibição do menu ao clicar no botão
        toggleButton.addEventListener('click', () => {
            menuContainer.classList.toggle('active');
        });

        // Fecha o menu ao clicar fora dele
        document.addEventListener('click', (event) => {
            if (!menuContainer.contains(event.target) && !toggleButton.contains(event.target)) {
                menuContainer.classList.remove('active');
            }
        });
    });
</script>
