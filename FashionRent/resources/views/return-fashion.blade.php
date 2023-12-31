@extends('layouts.mainLayout')

@section('title', 'Fashion Return')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="my-5 col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-3">Fashion Return Form</h1>

        @if (session('message'))
            <div class="alert {{ session('alert-class') }} mt-5">
                {{ session('message') }}
            </div>
        @endif

        <form action="fashion-return" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="user" class="form-control select-2">
                    <option value="">Select User</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="fashion" class="form-label">Fashion</label>
                <select name="fashion_id" id="fashion" class="form-control select-2">
                    <option value="">Select Fashion</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select-2').select2();

            // ajax fashion
            $('#user').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        url: '/get-user-fashions/' + userId,
                        type: 'GET',
                        success: function(response) {
                            $('#fashion').empty();
                            $('#fashion').append('<option value="">Select Fashion</option>');
                            $.each(response, function(index, fashion) {
                                $('#fashion').append('<option value="' + fashion.id + '">' +
                                    fashion.fashion_code + ' - ' + fashion.title +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#fashion').empty();
                    $('#fashion').append('<option value="">Select Fashion</option>');
                }
            });
        });
    </script>

@endsection
