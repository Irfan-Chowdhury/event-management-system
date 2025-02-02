<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/registration">Registration</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Register</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();
                        if (isset($_SESSION['success_message'])) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> ' . $_SESSION['success_message'] . '
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                            unset($_SESSION['success_message']);
                        }

                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> ' . $_SESSION['error_message'] . '
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                            unset($_SESSION['error_message']);
                        }
                        ?>
                        <form action="/registration" method="POST">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <span></span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            var isValid = true;
            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val().trim();
            var confirmPassword = $('#confirm_password').val().trim();

            if (name === '') {
                isValid = false;
                $('#name').next('span').text('Full Name is required.').css('color', 'red');
            } else {
                $('#name').next('span').text('');
            }

            if (email === '') {
                isValid = false;
                $('#email').next('span').text('Email address is required.').css('color', 'red');
            } else if (!validateEmail(email)) {
                isValid = false;
                $('#email').next('span').text('Please enter a valid email address.').css('color', 'red');
            } else {
                $('#email').next('span').text('');
            }

            if (password === '') {
                isValid = false;
                $('#password').next('span').text('Password is required.').css('color', 'red');
            } else {
                $('#password').next('span').text('');
            }

            if (confirmPassword === '') {
                isValid = false;
                $('#confirm_password').next('span').text('Confirm Password is required.').css('color', 'red');
            } else if (password !== confirmPassword) {
                isValid = false;
                $('#confirm_password').next('span').text('Passwords do not match.').css('color', 'red');
            } else {
                $('#confirm_password').next('span').text('');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
    </script>
</body>
</html>