@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header fs-4 fw-bold text-center">Create User</div>

                </div>
            </div>
                <form method="POST" action="/user/store" enctype="multipart/form-data" class="d-flex justify-content-center">
                    @csrf
                    <div class="border border-black p-4 justify-content-center mt-5 rounded-2 col-md-8" >
                        <div class="mb-3 mt-4 my-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name')}}">
                        </div>
                        @error('name')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" >
                        </div>
                        @error('email')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" >
                        </div>
                        @error('password')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

        </div>
    </div>

@endsection
