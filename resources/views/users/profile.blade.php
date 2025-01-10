@extends('layout_siswa.master')
@section('content')
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <!-- Save Button in the Header Section -->
                        <div class="d-flex align-items-center mt-4">
                            <p class="mb-0">Update Profile</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                        </div>
                        <!-- Saved Confirmation Message -->
                        @if (session('status') === 'profile-updated')
                            <p class="alert alert-success mt-4" x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)">
                                {{ __('Profile Berhasil Di Update!') }}
                            </p>
                        @endif
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('patch')
                        <!-- Row for Name and Email -->
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" required autofocus>
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror

                                    <!-- Email Verification Notice -->
                                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !Auth::user()->hasVerifiedEmail())
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-800">
                                                Your email address is unverified.
                                            <form id="send-verification" method="post"
                                                action="{{ route('verification.send') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-link p-0">{{ __('Click here to re-send the verification email.') }}</button>
                                            </form>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="text-sm text-success mt-2">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
    </form>
    <hr class="horizontal dark">
    <!-- Update Password Section -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <!-- Header with Save Button -->
        <div class="d-flex align-items-center mb-3">
            <p class="mb-0">Update Password</p>
            <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
        </div>

        <!-- Current Password -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="current_password" class="form-control-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control"
                        autocomplete="current-password">
                    @error('current_password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- New Password -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password" class="form-control-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password_confirmation" class="form-control-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="alert alert-success mt-4">
                {{ __('Password has been updated successfully!') }}
            </div>
        @endif
    </form>
@endsection
