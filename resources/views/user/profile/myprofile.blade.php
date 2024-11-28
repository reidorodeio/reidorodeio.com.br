@extends('user.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
    <!-- Foto de Perfil -->
    <div class="profile-row">
        <div class="profile-photo">
            <div class="photo-wrapper" id="photo-preview" style="background-image: url('{{ $user->image_url }}');">
                <!-- Foto apenas exibição -->
            </div>
        </div>
    </div>

    <!-- Informações do Cliente -->
    <div class="profile-info">
        <p class="profile-instruction">Mantenha seu perfil atualizado para receber seus prêmios!</p>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <label for="name">Nome Completo</label>
                <input name="name" id="name" type="text" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="input-group">
                <label for="cpf">Número do CPF</label>
                <input name="cpf" id="cpf" type="text" value="{{ old('cpf', $user->cpf) }}" readonly>
            </div>

            <div class="input-group">
                <label for="chave_pix">Chave Pix</label>
                <input name="chave_pix" id="chave_pix" type="text" value="{{ old('chave_pix', $user->chave_pix) }}">
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input name="email" id="email" type="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="input-group">
                <label for="mobile">Whatsapp</label>
                <input name="mobile" id="mobile" type="text" value="{{ old('mobile', $user->mobile) }}">
            </div>

            <div class="input-group">
                <label for="photo">Atualizar Foto</label>
                <input type="file" name="photo" id="photo" accept="image/*">
            </div>

            <button type="submit" class="btn-update">Atualizar Perfil</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    // Adiciona interação ao campo de upload da foto
    document.getElementById('photo').addEventListener('change', function () {
        const photoPreview = document.getElementById('photo-preview');
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.style.backgroundImage = `url(${e.target.result})`;
                photoPreview.classList.add('photo-animation'); // Adiciona animação
                setTimeout(() => photoPreview.classList.remove('photo-animation'), 1000);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
