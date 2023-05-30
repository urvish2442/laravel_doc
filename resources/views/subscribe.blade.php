@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header fs-4 fw-bold text-center">{{ __('User Subscription Form') }}</div>

                </div>
            </div>
                <form method="POST" action="/user/subscribe" class="d-flex justify-content-center">
                    @csrf
                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $user->id }}">
                    <div class="border border-black p-4 justify-content-center mt-5 rounded-2 col-md-8" >
                        <div class="mb-3 mt-4 my-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>
                        @error('name')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email}}" readonly>
                        </div>
                        @error('email')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Choose Subscription Days</label>
                            <select name="end_date" class="form-control" id="end_date">
                                <option value="" disabled selected>Select your option</option>
                                <option value="30">1 Month</option>
                                <option value="90">3 Month</option>
                                <option value="365">1 Year</option>
                            </select>
                        </div>
                        @error('password')
                        <p class="text-danger text-xs mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>

                </form>

        </div>
    </div>

@endsection
