<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <title>Register</title>
</head>
<style>
    .form-group {
        padding-bottom: 15px;
    }

    .remove-field {
        cursor: pointer;
        color: red;
    }
</style>

<body>
    <div class="d-flex justify-content-center align-items-center" style="background-color: #F4F7F0;">
        <div class="container pt-5 ">
            <div class="row align-items-center">
                <div class="col-md-5 p-4 mb-4 bg-white rounded-4 card shadow-sm mx-auto">
                    <div class="d-flex mb-4 justify-content-center align-items-center fs-4">
                        <a href="{{ route('login') }}" class="text-decoration-none me-3"
                            style="color: #A0B948;">Login</a>
                        <p class="text-decoration-underline mb-0" style="color: #183F23;">Register</p>
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

                    <form action="" {{ route('register') }}"" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div>
                                <input type="radio" id="male" name="gender" value="Male" required>
                                <label for="male" class="me-3">Male</label>
                                <input type="radio" id="female" name="gender" value="Female" required>
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="current_job">Current Job</label>
                            <input type="text" id="current_job" name="current_job" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Field of Work Interest</label>
                            <div id="fieldOfWorkContainer">
                                <input type="text" name="field_of_work[]" class="form-control mb-2"
                                    placeholder="Field of Work Interest" required>
                                <input type="text" name="field_of_work[]" class="form-control mb-2"
                                    placeholder="Field of Work Interest" required>
                                <input type="text" name="field_of_work[]" class="form-control mb-2"
                                    placeholder="Field of Work Interest" required>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="addFieldOfWork">Add More</button>
                        </div>
                        <div class="form-group">
                            <label for="linkedin">LinkedIn Profile</label>
                            <input type="url" id="linkedin" name="linkedin" class="form-control"
                                placeholder="https://www.linkedin.com/in/username" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Phone Number</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mx-auto d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-md mt-3 rounded-pill">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addFieldOfWork').addEventListener('click', function () {
            const container = document.getElementById('fieldOfWorkContainer');
            const input = document.createElement('div');
            input.innerHTML = `
                <div class="d-flex align-items-center mb-2">
                    <input type="text" name="field_of_work[]" class="form-control me-2" placeholder="Field of Work" required>
                    <span class="remove-field">x</span>
                </div>
            `;
            container.appendChild(input);

            input.querySelector('.remove-field').addEventListener('click', function () {
                input.remove();
            });
        });
    </script>
</body>

</html>