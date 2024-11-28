<link rel="stylesheet" href="{{ asset('public/frontend/css/footer.css') }}">
<footer class="footer">
      <div class="row">
            <div class="img">
                <img class="footer-certification-img" src="{{ asset('public/images/cert/18.svg') }}" alt="Logo 1" loading="lazy">
            </div>
            <div class="img">
                <img class="footer-certification-img" src="{{ asset('public/images/cert/jcr.svg') }}" alt="Jogue com responsabilidade" loading="lazy">
            </div>
            <div class="img">
                <img class="footer-certification-img" src="{{ asset('public/images/cert/csl.svg') }}" alt="Conheça seus limites" loading="lazy">
            </div>
            <div class="img">
                <img class="footer-certification-img" src="{{ asset('public/images/cert/comodo.svg') }}" alt="Logo 4" loading="lazy">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom text-center">
            <div class="widget footer-widget mb-2">
                <div class="footer-social">
                    <ul class="footer-social-list">
                        @foreach ($social as $data)
                            <li>
                                <a href="{{ $data->link }}" class="social-link {{ $data->icon }}">
                                    <i class="fab fa-{{ $data->icon }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <p class="footer-copyright">Todos os direitos reservados a Rei do rodeio.</p>
        </div>
</footer>
