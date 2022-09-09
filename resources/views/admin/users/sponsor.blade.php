@extends('layouts.dashboard')

<x-header />

@section('content')
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>
    <div id="sponsorship" class="">
        <form id="payment-form" action="/admin/pay" method="post">
            @csrf
            <div class="container">
                <div class="row bg-transp px-4">
                    <h4 class="bd-word pt-2 mt-1 mt-5 mb-2"><span class="bd-letter">S</span>ponsorizza il tuo profilo!</h4>
                    <h5 class="mb-4">Sponsorizza il tuo profilo scegliendo fra questi piani, avrai più possibilità di essere
                        visitato!</h5>
                    <div class="col-sm-12 col-md-4 col-4">
                        <div class="card text-center py-5 px-5 mb-3">
                            <h5>Piano "Bronzo"</h5>
                            <h6>Costo: 2,99 €</h6>
                            <p>Durata: 24h (1gg)</p>
                            <input type="radio" value="bronz0" name="tier" id="bronz0" class="btn-check"
                                autocomplete="off" required />
                            <label class="btn btn-outline-dark" for="bronz0">Scegli</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-4 ">
                        <div class="card text-center py-3 px-5 mb-3">
                            <h5>Piano "Argento"</h5>
                            <h6>Costo: 5,99 €</h6>
                            <p>Durata: 72h (3gg)</p>
                            <input type="radio" value="argento" name="tier" id="argento" class="btn-check"
                                autocomplete="off" />
                            <label class="btn btn-outline-dark" for="argento">Scegli</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-4 mb-3">
                        <div class="card text-center py-3 px-5" style="height: 100%">
                            <h5>Piano "Oro"</h5>
                            <h6>Costo: 9.99 €</h6>
                            <p>Durata: 144h (6gg)</p>
                            <input type="radio" value="oro" name="tier" id="oro" class="btn-check btn"
                                autocomplete="off" />
                            <label class="btn btn-outline-dark" for="oro">Scegli</label>
                        </div>
                    </div>
                </div>
                <div class="row bg-transp">
                    <div class="col-12">
                        <div class="mt-3 p-0">
                            <div class="col-12">
                                <div id="dropin-container"></div>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6">
                                <input class="w-100" type="submit" value="Paga"/>
                                <input type="hidden" id="nonce" name="payment_method_nonce" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            const form = document.getElementById('payment-form');
            let deviceDataInput = form['device_data'];

            braintree.dropin.create({
                authorization: '{{ $clientToken }}',
                container: '#dropin-container',
                dataCollector: true
            }, (error, dropinInstance) => {
                if (error) console.error(error);

                form.addEventListener('submit', event => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod((error, payload) => {
                        if (deviceDataInput == null) {
                            deviceDataInput = document.createElement('input');
                            deviceDataInput.name = 'device_data';
                            deviceDataInput.type = 'hidden';
                            form.appendChild(deviceDataInput);
                        }
                        if (error) console.error(error);
                        
                        document.getElementById('nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        </script>
    </div>
@endsection

<style>
    #sponsorship {
        background-image: url('/images/bg-admin.png'),
        linear-gradient(rgba(255, 255, 255, 0.1),rgba(255, 255, 255, 0.1));
        background-size: 100%;
        background-blend-mode: overlay;
        padding-top: 4rem;
    }

    .bg-transp {
        background-color: rgba(255,255,255,0.5);
    }

    .bd-letter {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
        padding-left: .3rem;
        margin-right: .2rem;
        border: 1px solid black;
    }

    .bd-word {
        text-transform: uppercase;
        letter-spacing: .4rem;
        font-size: 1.1rem;
    }

</style>