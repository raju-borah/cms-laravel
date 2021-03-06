@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($tag)?'Edit tags':'Create tags'}}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="post">
                @csrf
                @if(isset($tag))
                    @method('PATCH')
                @endif
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" value="{{isset($tag)?$tag->name:''}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{isset($tag)?'Update':'Create tag'}}</button>
                </div>
            </form>
        </div>
    </div>
@stop
