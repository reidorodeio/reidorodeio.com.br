<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/login.css') }}">
    <title>Login ou Cadastro</title>
</head>

<body>
    <div class="main">
        @if(session('success'))
        <div class="popup-overlay">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="popup-overlay">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="popup-overlay">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <input type="checkbox" id="chk" aria-hidden="true" style="display: none;">

        <!-- Formulário de Cadastro -->
        <div class="signup">
            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                <img src="{{ asset('public/images/logo/logoverde.png') }}" alt="Logo">
                <input type="text" name="name" placeholder="Nome Completo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="cpf" placeholder="CPF" required>
                <input type="number" name="mobile" placeholder="Telefone" required>
                <input type="text" name="chave_pix" placeholder="Chave Pix" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="password" name="password_confirmation" placeholder="Confirme a Senha" required>
                <button type="submit">Cadastrar</button>
                <p>Já possui conta?</p>
                <button class="glowing-btn" type="button" onclick="document.getElementById('chk').checked = false;">
                      <span class='glowing-txt'>L<span class='faulty-letter'>og</span>in</span>
                </button>
            </form>
        </div>

        <!-- Formulário de Login -->
        <div class="login">
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <img src="{{ asset('public/images/logo/logoverde.png') }}" alt="Logo">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
                <p>Não possui conta?</p>
                <button class="glowing-btn" type="button" onclick="document.getElementById('chk').checked = true;">
                   <span class='glowing-txt'>Ca<span class='faulty-letter'>das</span>tro</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.querySelectorAll('.popup-overlay').forEach(overlay => {
                    overlay.style.animation = 'fadeOut 0.5s ease forwards';
                    overlay.addEventListener('animationend', () => overlay.remove());
                });
            }, 2500);
        });
    </script>
</body>
</html>
