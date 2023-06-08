@extends('frontend.master')

@section('content')
<div class="row my-5">
    <div class="col-lg-4 m-auto">
        <div class="card">
            <div class="card-header">
                <h2>Password Reset</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <form action="{{route('pass.reset.confirm')}}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input name="token" type="hidden" class="form-control" value="{{$token}}">
                            <input name="password" type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection