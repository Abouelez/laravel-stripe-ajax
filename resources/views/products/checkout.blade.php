<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="payment-form">
                        <!-- CSRF Token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <!-- Cardholder Name -->
                        <div>
                            <label for="cardholder-name" class="block text-sm font-medium text-gray-700">
                                Cardholder Name
                            </label>
                            <input type="text" id="cardholder-name" name="cardholder-name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Card Number, Expiry, and CVC will be injected by Stripe Elements -->
                        <div id="card-element" class="mt-4"></div>

                        <!-- Error Display -->
                        <div id="card-errors" class="text-red-500 mt-2"></div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Set up Stripe
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    // Create an instance of the card Element
    const card = elements.create('card');
    card.mount('#card-element');

    // Handle form submission
    const form = document.getElementById('payment-form');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            "your-client-secret-here", // Replace with your Client Secret from Laravel
            {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: document.getElementById('cardholder-name').value,
                    },
                },
            }
        );

        if (error) {
            // Display error to the user
            cardErrors.textContent = error.message;
        } else {
            // Send payment data to server
            fetch('/process-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        payment_method: setupIntent.payment_method
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Payment successful!');
                    } else {
                        alert('Payment failed: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
