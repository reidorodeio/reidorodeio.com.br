@extends('user.layouts.master')
@section('content')
    <div id="app" class="contact-area bg-navy-2 pd-bottom-220">
        <div class="container-sub bg-black-2 rounded-3 p-4">
            <div class="rows d-flex justify-content-center" v-if="step === 1">
                <div class="col-md-7 mt-5 mb-5">
                    <form @submit="submitAmount">
                        <div class="contact-inner">
                            <h2 class="title mb-4 text-center">Depositar</h2>
                            <div class="single-input-inner style-border">
                                <span class="input-group-text">Insira o Valor</span>
                                <span class="icon"><i class="fa fa-dollar-sign"></i></span>
                                <input name="amount" v-model="deposit.payment_amount" placeholder="Valor" type="text"
                                    autocomplete="off" min="0" required>
                                <p class="text-base">Valor minimo R$50 reais.</p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-base mt-3" type="submit">ENVIAR AGORA <i
                                        class="fas fa-arrow-circle-right ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" v-if="step === 2">
                <div class="col-md-12 mb-2">
                    <button class="btn btn-base" @click="backStepOne"><i class="fas fa-arrow-circle-left ms-2"></i>
                        Voltar</button>
                </div>
                @foreach ($gateways as $data)
                    <div class="col-lg-3 align-self-center">
                        <div class="single-payment-wrap">
                            <div class="thumb">
                                <img src="{{ $data->image_url }}" alt="{{ $data->name }}">
                            </div>
                            <div class="details">
                                <h4>{{ $data->name }}</h4>
                                <button class="btn btn-base" type="button"
                                    @click="selectGateway('{{ $data }}')">Depositar Agora</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-flex justify-content-center bg-black-2 rounded-3 mb-4" v-if="step === 3">
                <form ref="formPayment" action="{{ route('deposit.confirm') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="gateway_id" v-bind:value="gatewayItem.id">
                        <input type="hidden" name="amount" v-bind:value="deposit.payment_amount">

                        <div class="row">
                            <div class="col-md-12 mt-5 text-center">
                                <h6 class="text-base mb-5">Ao clicar em "Criar Pix", você terá um minuto para efetuar o pagamento.</h6>
                                <button class="btn btn-base mb-2" type="submit" @click="payNow">Criar Pix <i
                                        class="fas fa-arrow-circle-right ms-2"></i></button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        window.app = new Vue({
            el: '#app',
            data: {
                deposit: {},
                gatewayItem: {},
                step: 1,
            },
            methods: {
                backStepOne() {
                    this.step--;
                },
                backStepTwo() {
                    this.step--;
                },
                submitAmount(e) {
                    e.preventDefault();
                    if (this.deposit.payment_amount > 0) {
                        this.step++
                    } else {
                        toastr.error(msg)
                    }
                },
                selectGateway(item) {
                    var item = JSON.parse(item);
                    if ((parseFloat(this.deposit.payment_amount) >= parseFloat(item.minimum_deposit_amount)) && (
                            parseFloat(this.deposit.payment_amount) <= parseFloat(item.maximum_deposit_amount))) {
                        this.step++;
                        this.gatewayItem = item;
                    } else {
                        var msg = 'Por favor, volte e insira entre Min ' + item.minimum_deposit_amount + '- Max ' +
                            item.maximum_deposit_amount + ' para ' + item.name;
                        toastr.error(msg)
                    }
                },
                payNow() {
                    this.$refs.formPayment.$el.submit()
                }
            }
        })
    </script>
@endsection
