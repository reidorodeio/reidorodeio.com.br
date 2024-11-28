@extends('user.layouts.master')
@section('content')

    <div class="signup-area bg-navy-2 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-inner text-center">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="progress mt-3">
                                        <div id="progress-bar" class="progress-bar bg-success" role="progressbar"
                                            style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p id="countdown" class="mt-3">Tempo restante: 1:00</p>
                                </div>
                            </div>

                            <img src="{{ $result['charge']['qrCodeImage'] }}" class="img-fluid mx-auto d-block mb-3"
                                alt="QR Code" width="178" height="107" style="width: 350px; height: 175px;">
                            <p><small>Escaneie o código ou clique no botão azul abaixo!</small></p>
                            <input type="text" class="form-control mb-3" id="br-code"
                                value="{{ $result['charge']['brCode'] }}" readonly>
                            <button class="btn btn-primary" onclick="copyBrCode()">Copiar Código BR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        var totalTime = 60; // 1 minuto em segundos
        var timeleft = totalTime;

        var downloadTimer = setInterval(function() {
            var minutes = Math.floor(timeleft / 60);
            var seconds = timeleft % 60;
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Tempo expirado!";
                // Redireciona para a página 'home'
                window.location.href =
                    "{{ route('home') }}";
            } else {
                document.getElementById("countdown").innerHTML = "Tempo restante: " + minutes + ":" + seconds;
                var progress = (timeleft / totalTime) * 100;
                document.getElementById("progress-bar").style.width = progress + "%";
            }
            timeleft -= 1;
        }, 1000);

        function copyBrCode() {
            var brCodeInput = document.getElementById('br-code');
            brCodeInput.select();
            document.execCommand('copy');

            toastr.success('Código copiado com sucesso!');
        }
    </script>
@endsection
