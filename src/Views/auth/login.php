<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Form</title>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();

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
                        <form id="loginForm" action="/login" method="POST">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                <span class="text-danger" id="emailError"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <span class="text-danger" id="passwordError"></span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                var isValid = true;
                $('#emailError').text('');
                $('#passwordError').text('');

                var email = $('input[name="email"]').val();
                var password = $('input[name="password"]').val();

                if (email === '') {
                    $('#emailError').text('Email is required.');
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $('#emailError').text('Invalid email format.');
                    isValid = false;
                }

                if (password === '') {
                    $('#passwordError').text('Password is required.');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            function validateEmail(email) {
                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(email);
            }
        });
    </script>
</body>

</html>