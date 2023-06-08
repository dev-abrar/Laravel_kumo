@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Users List <span class="float-right">Total:{{$total - 1}}</span></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $sl=>$user)
                        
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        {{-- <td>{{$user->created_at->format('d-m-y h:i:o')}}</td> --}}
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>
                            @if ($user->photo == null)
								<img src="{{ Avatar::create($user->name)->toBase64() }}" />
								@else
								<img src="{{ asset('uploads/users') }}/{{$user->photo}}" />
								@endif
                        </td>
                        <td>
                            <button class="btn btn-danger d_btn" data-id='{{route('user.delete', $user->id)}}'>Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
<script>
    $('.d_btn').click(function(){
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
             if (result.isConfirmed) {
                 link = $(this).attr('data-id');
                 window.location.href = link;
             }
             })
       });
 
 </script>
    @if (session('success'))
         <script>
             Swal.fire(
                 'Deleted!',
                 'Your user has been deleted.',
                 'success'
                 )
         </script>
     
    @endif
@endsection