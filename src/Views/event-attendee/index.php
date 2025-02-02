<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Event Registration Form</h4>
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
                        <form id="registrationForm" action="/event-attendee-reg-store" method="POST">
                            <div class="form-group">
                                <label for="event_id">Event</label>
                                <select name="event_id" id="event_id" class="form-control">
                                    <option value="">--Select Event--</option>
                                    <?php foreach ($getEvents as $event) : ?>
                                        <option value="<?php echo $event['id']; ?>"> <?php echo $event['title']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="event_id_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <span class="text-danger" id="name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <span class="text-danger" id="email_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <span class="text-danger" id="phone_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" required></textarea>
                                <span class="text-danger" id="address_error"></span>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
            $('#registrationForm').on('submit', function(event) {
                var isValid = true;

                // Clear previous error messages
                $('span.text-danger').text('');

                // Validate Event
                if ($('#event_id').val() === '') {
                    $('#event_id_error').text('Please select an event.');
                    isValid = false;
                }

                // Validate Full Name
                if ($('#name').val().trim() === '') {
                    $('#name_error').text('Please enter your full name.');
                    isValid = false;
                }

                // Validate Email
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if ($('#email').val().trim() === '') {
                    $('#email_error').text('Please enter your email.');
                    isValid = false;
                } else if (!emailPattern.test($('#email').val().trim())) {
                    $('#email_error').text('Please enter a valid email address.');
                    isValid = false;
                }

                // Validate Phone
                if ($('#phone').val().trim() === '') {
                    $('#phone_error').text('Please enter your phone number.');
                    isValid = false;
                }

                // Validate Address
                if ($('#address').val().trim() === '') {
                    $('#address_error').text('Please enter your address.');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>