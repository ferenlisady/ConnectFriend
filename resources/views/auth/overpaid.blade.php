<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overpayment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #F4F7F0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 p-3 mb-2 bg-white rounded-4">
                    <h3>Overpayment</h3>
                    <p>You have overpaid by: <strong>{{ $overpaid }}</strong></p>
                    <form method="POST" action="{{ route('handle-overpayment') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="balance_option" class="form-label">Would you like to add the balance to your
                                wallet?</label>
                            <select name="balance_option" id="balance_option" class="form-select" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>