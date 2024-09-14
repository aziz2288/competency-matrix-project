@extends('layouts.app')

@section('content')
<h2 style="text-align: center; margin:0% auto 3%;">Your Projects</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Project</th>
            <th scope="col">Date</th>
            <th scope="col">Duration</th>
            <th scope="col">Operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $index => $project)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $project->name }}</td>
                <td>
                    <input type="date" name="day" class="day-input form-control" data-project-id="{{ $project->id }}">
                </td>
                <td>
                    <input type="number" name="duration" value="0" min="0" max="1" step="0.25" class="duration-input form-control" data-project-id="{{ $project->id }}">
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-confirm submit-duration" data-project-id="{{ $project->id }}">
                        <i class="fas fa-check"></i> Confirm
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@section('styles')
<style>
    .btn-confirm {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-confirm i {
        margin-right: 5px;
    }

    .btn-confirm:hover {
        background-color: #218838;
    }

    .day-input, .duration-input {
        max-width: 150px;
        margin: 0 auto;
    }

    table {
        margin-top: 20px;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.submit-duration').on('click', function() {
            let projectId = $(this).data('project-id');
            let duration = $(this).closest('tr').find('.duration-input').val();
            let day = $(this).closest('tr').find('.day-input').val();
            
            $.ajax({
                url: '{{ route('projects.saveDuration') }}',
                type: 'POST',
                data: {
                    project_id: projectId,
                    duration: duration,
                    day: day,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Duration saved successfully!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.error) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.error,
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to save duration. Please try again.',
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
@endsection
