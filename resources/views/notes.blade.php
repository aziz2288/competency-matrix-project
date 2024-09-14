@extends('layouts.app')

@section('content')
<h2 style="text-align: center; margin:0% auto 3%; ">Your Notes</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Technology</th>
            <th scope="col">Rating</th>
            <th scope="col">Operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach($techs as $index => $tech)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $tech->name }}</td>
                <td>
                    <input type="number" name="rating" value="1" min="1" max="5" class="rating-input form-control" data-tech-id="{{ $tech->id }}">
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-confirm submit-rating" data-tech-id="{{ $tech->id }}">
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
        background-color: #268b3c;
    }

    .rating-input {
        max-width: 60px;
        text-align: center;
        margin: 0 auto;
    }

    table {
        margin-top: 30px;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.submit-rating').on('click', function() {
            let techId = $(this).data('tech-id');
            let rating = $(this).closest('tr').find('.rating-input').val();

            $.ajax({
                url: '{{ route('notes') }}',
                type: 'POST',
                data: {
                    tech_id: techId,
                    note: rating,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.success);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Rating saved successfully!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to save rating. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#d33',
                    });
                }
            });
        });
    });
</script>
@endsection

@endsection
