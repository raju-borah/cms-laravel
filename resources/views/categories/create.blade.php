@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            Create Categories
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
            <form action="{{route('categories.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@stop
