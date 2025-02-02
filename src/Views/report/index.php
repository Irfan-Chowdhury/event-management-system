<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <section class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand text-light" href="#">Event Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/reports">Reports</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-danger nav-link text-light" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Event Report of Attendee Lists</h2>

        <div class="col-md-6">
            <label for="eventSelect">Select Event:</label>
            <select class="form-control" id="eventSelect">
                <option value="">--Select Event--</option>
                <?php foreach ($getEvents as $event): ?>
                    <option value="<?php echo $event['id']; ?>"><?php echo $event['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <span></span>
        </div>
        <br>
        <div class="col-md-6 d-flex align-items-end">
            <form action="reports/download-csv" method="post">
                <input type="hidden" name="event_id" id="eventId">
                <button class="btn btn-success" type="submit">Download CSV</button>
            </form>
        </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#eventSelect').change(function() {
                var eventId = $(this).val();
                $('#eventId').val(eventId);
            });
        });
    </script>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#eventSelect').change(function() {
            var eventId = $(this).val();
            $('#eventId').val(eventId);
        });

        $('form').submit(function(event) {
            var eventId = $('#eventSelect').val();
            if (eventId === "") {
                event.preventDefault();
                $('span').text('Please select an event.').css('color', 'red');
            }
        });
    });
</script>