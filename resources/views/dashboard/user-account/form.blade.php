@extends('dashboard.layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit your profile</h4>
      </div>
      <div class="card-body">
        <div class="card-wrapper border rounded-3">
            <form class="row g-3 floating-wrapper" method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingInput23" type="text" name="name" placeholder="name" value="{{ Auth::user()->name }}" required>
                        <label for="floatingInput23">Name</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingInput22" type="email" name="email" placeholder="name@example.com" value="{{ Auth::user()->email }}" required>
                        <label for="floatingInput22">Email address</label>
                    </div>
                </div>
                <label for="">Leave Password Blank if you don't want to change</label>
                <div class="col-12">
                    <div class="form-floating">
                        <input class="form-control" id="floatingPassword" type="password" name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input class="form-control" id="floatingPasswordConfirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                        <label for="floatingPasswordConfirmation">Confirm Password</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>


@endsection
