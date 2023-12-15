@extends('layouts.mainLayout')

@section('title', 'Fashion Rent')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="my-5 col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
    <h1 class="mb-3">Fashion Rent Form</h1>

    <p class="mb-3">See detailed <a href="/" class="text-decoration-none">Fashion List</a></p>

    @if (session('message'))
    <div class="alert {{ session('alert-class') }} mt-5">
        {{ session('message') }}
    </div>
    @endif

    <form action="fashion-rent" method="post">
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
                @foreach ($fashions as $item)
                <option value="{{ $item->id }}">{{ $item->fashion_code }} - {{ $item->title }}</option>
                @endforeach
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
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function () {
        $('.select-2').select2();
    });
</script>

@endsection