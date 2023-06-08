@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Personal Info</h6>
                <form class="forms-sample" action="{{route('user.update')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Edit Password</h6>
            </div>
            @if (session('success'))
            <strong class="alert alert-success">{{session('success')}}</strong>
            @endif
            <div class="card-body">
                <form class="forms-sample" action="{{route('update.password')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                        @error('old_password')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('old_pass'))
                        <strong class="text-danger">{{session('old_pass')}}</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="New Password">
                        @error('password')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm Password">
                        @error('password_confirmation')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Edit Profile Photo</h6>
            </div>
            @if (session('img_success'))
                <strong class="alert alert-success">{{session('img_success')}}</strong>
            @endif
            <div class="card-body">
                <form class="forms-sample" action="{{route('update.photo')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('photo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="my-2">
                        <img width="100" src="" id="blah" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
