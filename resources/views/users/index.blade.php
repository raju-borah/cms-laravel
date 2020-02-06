@extends('layouts.app')
@section('content')

    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @if($users->count()>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>User</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{Gravatar::src($user->email)}}" height="50px" width="50px" style="border-radius: 50%;" alt=""></td>
                            <td> {{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            @if(!$user->isAdmin())
                                <td>  <form action="{{route('users.make-admin',$user->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-primary" >Make Admin</button>
                                    </form>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">NO USERS YET</h3>
            @endif
        </div>
    </div>
@endsection
