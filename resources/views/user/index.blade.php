<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">User Management</h2>
        <div>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="confirmAddUser()"><i class="fas fa-user-plus"></i> Add User</a>
        </div>        
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">
                            <a href="/user/information/{{$user->id}}" class="user-id" data-id="{{ $user->id }}">{{ $user->id }}</a>
                        </th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="/update/{{ $user->id }}" class="btn btn-info" data-toggle="tooltip" title="Update">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/delete/{{ $user->id }}" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
    <script>
        function confirmAddUser() {
            Swal.fire({
                title: 'Are you sure ?',
                text: "Do you want to add a new user ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add user'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/ajouter';
                }
            });
        }
        $(document).ready(function() {
            function loadSection(section) {
                $.ajax({
                    url: '/' + section,
                    type: 'GET',
                    success: function(data) {
                        $('#content').html(data);
                        attachUserIdClickListener();
                    }
                });
            }

            function attachUserIdClickListener() {
                $('.user-id').click(function(e) {
                    e.preventDefault();
                    let userId = $(this).data('id');
                    loadUserInformation(userId);
                });
            }

            function loadUserInformation(userId) {
                $.ajax({
                    url: '/user/information/' + userId,
                    type: 'GET',
                    success: function(data) {
                        $('#content').html(data);
                    }
                });
            }
            $('[data-toggle="tooltip"]').tooltip();
            attachUserIdClickListener();
        });
    </script>
</body>
</html>
