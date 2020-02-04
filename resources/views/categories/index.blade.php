@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success ">Add Category</a>

    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count()>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td> {{$category->id}}</td>
                            <td> {{$category->name}}</td>
                            <td> {{$category->posts->count()}}</td>
                            <td ><a class="btn btn-secondary float-right " href="{{route('categories.edit',$category->id)}}">Edit</a></td>
                            <td class="pr-0">
                                <button class="btn btn-danger" onclick="handleDelete({{$category->id}})">Delete</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Categories Yet</h3>
            @endif
            <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="post" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        function handleDelete($id){
            $('#deleteModal').modal('show');
            var form=document.getElementById('deleteCategoryForm');
            console.log(form);
            form.action='/categories/'+$id
        }

    </script>

@stop
