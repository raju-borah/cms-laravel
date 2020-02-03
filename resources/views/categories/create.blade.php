@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($category)?'Edit Category':'Create Categories'}}
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
            <form action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}" method="post">
                @csrf
                @if(isset($category))
                    @method('PATCH')
                    @endif
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" value="{{isset($category)?$category->name:''}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{isset($category)?'Update':'Create Category'}}</button>
                </div>
            </form>
        </div>
    </div>
@stop
