<x-main-layout>
    <div class="row justify-content-center">
        <div class="col-8 ">
            <div id="payment-element"></div>
            <button id="submit" class="btn btn-primary mt-2">
                <div class="d-flex">
                    <div class="spinner-border d-none" role="status" id="spiner">
                        <span class="sr-only"></span>
                    </div>
                    <div class="px-2">{{ __('site.Pay') }} {{ $amount }} $</div>
                </div>

            </button>
        </div>

    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe(
            ' {{ env('STRIPE_KEY') }}')

        const elements = stripe.elements({
            clientSecret: '{{ $clientSecret }}'
        });
        const options = {
            layout: {
                type: 'accordion',
                defaultCollapsed: false,
            },

            fields: {
                billingDetails: {
                    name: 'auto',
                    email: 'auto',

                }
            },

            wallets: {
                link: 'never'
            }
        };
        const paymentElement = elements.create('payment', options);
        paymentElement.mount('#payment-element');

        document.getElementById('submit').addEventListener('click', async () => {
            document.getElementById("submit").disabled = true;
            document.getElementById("spiner").classList.remove('d-none');
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: '{{ route('subscription.complete') }}',
                },
            });

            if (error) {
                // Display "error.message" to the user...
            }
        });
    </script>


</x-main-layout>
