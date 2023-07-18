<x-app-layout>
    <div class="container">
        <div class="card payment-card">
            <h1 class="card-header">Payment Page</h1>
            <div class="card-body">
                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="text" name="amount" id="amount" class="form-control" required value="{{ $offencefine }}" >
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required value="254{{ $phoneNumber }}" >
                    </div>

                    <div class="form-group">
                        <label for="ticketid">Ticket ID:</label>
                        <input type="text" name="ticketId" id="ticketId" class="form-control" required value="{{ $ticketid }}" >
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block" >
                        <a class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-3 bg-green-200 rounded hover:bg-blue-200">
                        Pay Now
                    </a>
                    </button>

                    <div class="payment-instructions">
                        <h4>Instructions:</h4>
                        <p>1. Click the "Pay Now" button to initiate the payment.</p>
                        <p>2. You will receive a prompt on your device.</p>
                        <p>3. Enter your M-Pesa PIN to authorize the payment.</p>
                        <p>4. Wait for the payment confirmation message from M-Pesa.</p>
                        <p>5. Once the payment is successful, you will be redirected to the payment success page.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-card {
            width: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .btn-primary:disabled,
        .btn-primary[disabled] {
            background-color: #007bff;
            border-color: #007bff;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .spinner-border {
            margin-right: 10px;
        }

        .payment-instructions {
            margin-top: 30px;
        }

        .payment-instructions h4 {
            margin-bottom: 10px;
        }

        .payment-instructions p {
            margin-bottom: 5px;
        }
    </style>
</x-app-layout>
