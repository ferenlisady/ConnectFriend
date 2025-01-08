<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #F4F7F0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 p-3 mb-2 bg-white rounded-4">
                    <h3>Registration Payment</h3>
                    <p>The registration price is: <strong>Rp
                            {{ number_format(session('registration_price'), 0, ',', '.') }}</strong></p>

                    @if(session('payment_error'))
                        <div class="alert alert-danger">
                            {{ session('payment_error') }}
                        </div>
                    @endif

                    @if(session('overpaid'))
                        <div class="alert alert-warning">
                            <strong>Overpayment detected!</strong> You overpaid by Rp
                            {{ number_format(session('overpaid'), 0, ',', '.') }}.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('process-payment') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="payment" class="form-label">Enter Payment Amount</label>
                            <input type="number" name="payment" id="payment" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>