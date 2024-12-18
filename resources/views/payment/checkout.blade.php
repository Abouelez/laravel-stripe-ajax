<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <h2>Payment Form</h2>

    <form action="{{ route('checkout') }}" method="POST" id="payment-form">
        @csrf

        <div>
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit">Submit Payment</button>
    </form>

    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Your publishable key
        var elements = stripe.elements();

        var style = {
            base: {
                color: "#32325d",
                lineHeight: "24px",
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

        var card = elements.create("card", {
            style: style
        });
        card.mount("#card-element");

        // Handle form submission
        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            stripe
                .createToken(card)
                .then(function(result) {
                    if (result.error) {
                        // Show error in #card-errors
                        var errorElement = document.getElementById("card-errors");
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
        });

        // Submit the form with the token
        function stripeTokenHandler(token) {
            var form = document.getElementById("payment-form");

            var hiddenInput = document.createElement("input");
            hiddenInput.setAttribute("type", "hidden");
            hiddenInput.setAttribute("name", "stripeToken");
            hiddenInput.setAttribute("value", token.id);

            form.appendChild(hiddenInput);

            form.submit();
        }
    </script>
</body>

</html>
