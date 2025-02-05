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
        <h2 class="mb-4 text-center">Events List</h2>
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#createEventModal">
            Create New Event
        </button>
        <table id="eventsTable" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Total Attendee</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>                
                <?php foreach ($getEvents as $event): ?>
                    <tr>
                        <td><?php echo $event['title']; ?></td>
                        <td><?php echo $event['description']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['venue']; ?></td>
                        <td class="text-center"><?php echo $event['capacity']; ?></td>
                        <td class="text-center"><?php echo $event['total_attendee']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm editBtn" data-id="<?php echo $event['id']; ?>" data-target="#editEventModal">Edit</button>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $event['id']; ?>">Delete</button>
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
                            <input type="text" class="form-control" name="title" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea name="description" cols="3" class="form-control" name="description" required ></textarea>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" class="form-control" name="venue" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" class="form-control" name="capacity" required>
                            <span class="text-danger"></span>
                        </div>
                        <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateEventForm" action="/events/edit" method="POST">
                        <input type="hidden" name="id" id="editEventId">
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" class="form-control" name="title" id="editEventTitle" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea name="description" cols="3" class="form-control" id="editEventDescription" required></textarea>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" id="editEventDate" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" class="form-control" name="venue" id="editEventVenue" required>
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="text" class="form-control" name="capacity" id="editEventCapacity" required>
                            <span class="text-danger"></span>
                        </div>
                        <button type="submit" id="editSubmitButton" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#eventsTable').DataTable();
            
            $("#createEventForm").on("submit", function(e) {
                e.preventDefault();
                let isValid = true;

                // Clear previous error messages
                $(this).find("span").text("");

                // Validate Event Title
                if ($("input[name='title']").val().trim() === "") {
                    $("input[name='title']").next("span").text("Event title is required.");
                    isValid = false;
                }

                // Validate Event Description
                if ($("textarea[name='description']").val().trim() === "") {
                    $("textarea[name='description']").next("span").text("Event description is required.");
                    isValid = false;
                }

                // Validate Date
                if ($("input[name='date']").val().trim() === "") {
                    $("input[name='date']").next("span").text("Event date is required.");
                    isValid = false;
                }

                // Validate Venue
                if ($("input[name='venue']").val().trim() === "") {
                    $("input[name='venue']").next("span").text("Event venue is required.");
                    isValid = false;
                }

                // Validate Capacity
                if ($("input[name='capacity']").val().trim() === "") {
                    $("input[name='capacity']").next("span").text("Event capacity is required.");
                    isValid = false;
                }

                if (isValid) {
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
                                timer: 2000,
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
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        },
                        error: function(response, status, error) {
                            console.log(response);
                            let message;
                            if (response.status == 500) {
                                errorMessage = response.statusText;
                            } else {
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
                }
            });
        
            $(document).on("click", ".editBtn", function(e) {
                e.preventDefault(); 

                $.ajax({
                    url: "/events/edit",
                    type: "GET",
                    data: {
                        id: $(this).data("id")
                    },
                    success: function(response) {
                        console.log(response);
                        $("#editEventId").val(response.id);
                        $("#editEventTitle").val(response.title);
                        $("#editEventDescription").val(response.description);
                        $("#editEventDate").val(response.date);
                        $("#editEventVenue").val(response.venue);
                        $("#editEventCapacity").val(response.capacity);
                    },
                    error: function(response, status, error) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to fetch event data'
                        });
                    }
                });
                $("#editEventModal").modal("show");
            });
        
            $("#updateEventForm").on("submit", function(e) {
                e.preventDefault();
                $('#editSubmitButton').text('Updating...');

                $.ajax({
                    url: "/events/update",
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
                            timer: 2000,
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
                        $('#editSubmitButton').text('Update');
                        $('#updateEventForm')[0].reset();
                        $("#editEventModal").modal("hide"); 
                        // Reload the page after 1 second to reflect the changes
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
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
                        $('#editSubmitButton').text('Update');
                    }
                });
            });
                          
            $(document).on("click", ".deleteBtn", function(e) {
                e.preventDefault(); 

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/events/delete",
                            type: "GET",
                            data: {
                                id: $(this).data("id")
                            },
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
                            },
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
                                // Reload the page after 1 second to reflect the changes
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });


            });
        
        });
    
    </script>

</body>

</html>
