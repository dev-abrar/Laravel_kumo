@extends('frontend.master')

@section('content')
<div class="row my-5">
    <div class="col-lg-4 m-auto">
        <div class="card">
            <div class="card-header">
                <h2>Password Reset Request</h2>
            </div>
            <div class="card-body">
                @if (session('invalid'))
                <div class="alert alert-danger">{{session('invalid')}}</div>
                @endif
                @if (session('res_req'))
                <div class="alert alert-success">{{session('res_req')}}</div>
                @endif
                <form action="{{route('password.reset.req')}}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="">Enter Your Email</label>
                            <input name="email" type="email" class="form-control">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection