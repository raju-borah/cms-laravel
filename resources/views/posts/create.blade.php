@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($post)?'Edit Post':'Create Post'}}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="div alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                        <li class="list-group-item">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title" >Title</label>
                    <input type="text" name="title" id="title" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="4" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="published_at" >Published at</label>
                    <input type="date" name="published_at" id="published_at" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image" >Image</label>
                    <input type="file" name="image" id="image" class="form-control" >
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{isset($post)?'Update':'Create Post'}}</button>
                </div>

            </form>
        </div>
    </div>
@stop
