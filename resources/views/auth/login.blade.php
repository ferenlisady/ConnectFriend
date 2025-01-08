<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <title>Login</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #F4F7F0;">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <div class="d-flex mb-3 justify-content-center align-items-center fs-4">
                    <p class="text-decoration-underline me-3 mb-0" style="color: #A0B948;">Login</p>
                    <a href="{{ route('register') }}" class="text-decoration-none ms-3"
                        style="color: #183F23;">Register</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <i class="fa fa-eye-slash position-absolute" id="togglePassword"
                            style="top: 73%; right: 18px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        // Set initial icon based on password visibility
        const setPasswordIcon = () => {
            const type = password.getAttribute('type');
            if (type === 'password') {
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            } else {
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            }
        };

        setPasswordIcon();

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            setPasswordIcon();
        });
    </script>
</body>

</html>