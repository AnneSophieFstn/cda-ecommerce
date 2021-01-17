@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Page de paiment</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('checkout.store') }}" method="POST" class="my-4" id="payment-form">
                    @csrf
                    <div id="card-element">
                    <!-- Elements will create input elements here -->
                    </div>

                    <!-- We'll put the error messages in this element -->
                    <div id="card-errors" role="alert"></div>

                    <button class="btn btn-success mt-3" id="submit">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> Payer maintenant ({{ getPrice(Cart::total()) }})
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script>
    // Paiement Stripe
    var stripe = Stripe('pk_test_51IASu2FZEmW6TLriWX5SgJoOAj1RhaGZ7CvACSU4IrYj2o2o7MBNlN1whGtPzGIL4fBLleqy1j7UIVE6pPpUDnLX00lBc17MTY');
    var elements = stripe.elements();
    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
        },
        invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
        }
    };
    var card = elements.create("card", { style: style });
    card.mount("#card-element");
    card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert', 'alert-warning', 'mt-3');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-warning', 'mt-3');
            displayError.textContent = '';
        }
    });
    var submitButton = document.getElementById('submit');
    
    submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButtondisabled = true;
        stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            submitButtondisabled = false;
            console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var form = document.getElementById('payment-form');
                    var url = form.action;
                    var redirect = '/merci';
                        
                    fetch(
                        url,
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })
                        }).then((data) => {
                            console.log(data);
                            if (data.status === 400) {
                                redirect = '/boutique';
                            } else {
                                redirect = '/merci';
                            }
                            form.reset();
                            window.location.href = redirect;
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            }
        });
    });
</script>
@endsection