@extends('layout')

@section('content')

<div class="container-sm pt-5 p-5 mt-5">
  <div class="card">
    <div class="card-header text-center">
      <h1><b>Sign</b>Up</h1>
    </div>
    <div class="card-body mt-5">
      @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
          <p>{{ $message }}</p>
        </div>
      @endif
      @if (session()->has('loginError'))
        <div class="alert alert-danger mt-2">
          <p>{{ session('loginError') }}</p>
        </div>
      @endif

      <form action="{{ route('register.store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required>
          <span class="input-group-text"><span class="fas fa-user"></span></span>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required>
          <span class="input-group-text"><span class="fas fa-lock"></span></span>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <div class="row mt-3">
          <div class="col-12 text-center">
            <a href="{{ route('login') }}">Already Have Account?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
