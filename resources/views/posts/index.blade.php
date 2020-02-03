@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success ">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
         @if($posts->count()>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="storage/{{$post->image}}" height="50px" alt=""></td>
                            <td> {{$post->title}}</td>
                            @if(!$post->trashed())
                                <td ><a class="btn btn-secondary float-right btn-sm" href="{{route('posts.edit',$post->id)}}">Edit</a></td>
                            @endif
                            <td class="pr-0">
                                <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        {{$post->trashed()?'Delete':'Trash'}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">NO POSTS YET</h3>
            @endif
        </div>
    </div>
@endsection
