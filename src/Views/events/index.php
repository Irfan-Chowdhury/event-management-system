<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Events List</h2>
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#createEventModal">
            Create New Event
        </button>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Event Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>                
                <?php foreach ($getEvents as $event): ?>
                    <tr>
                        <!-- <th scope="row"><?php echo $event['id']; ?></th> -->
                        <td><?php echo $event['title']; ?></td>
                        <td><?php echo $event['description']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['venue']; ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">View</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Create Event Modal -->
    <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Create New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createEventForm" action="/events/store" method="POST">
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea name="description" cols="3" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" class="form-control" name="venue">
                        </div>
                        <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#createEventForm").on("submit", function(e) {
                e.preventDefault();
                $('#submitButton').text('Saving...');

                $.ajax({
                    url: "/events/store",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        $('#createEventModal').modal('hide');
                        $('#submitButton').text('Save');
                        $('#createEventForm')[0].reset();
                    },
                    error: function(response, status, error) {
                        console.log(response);
                        let message;
                        if (response.status==500) {
                            errorMessage = response.statusText;
                        }else {
                            errorMessage = response.responseJSON.error.charAt(0).toUpperCase() + response.responseJSON.error.slice(1);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: '<p class="text-danger">' + errorMessage + '</p>'
                        });
                        $('#submitButton').text('Save');
                    }
                });
            });
        });
    </script>

</body>

</html>