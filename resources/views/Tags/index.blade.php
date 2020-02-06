@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success ">Add Tags</a>

    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count()>0)
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
                    @foreach($tags as $tag)
                        <tr>
                            <td> {{$tag->id}}</td>
                            <td> {{$tag->name}}</td>
                            <td> {{$tag->posts->count()}}</td>
                            <td ><a class="btn btn-secondary float-right " href="{{route('tags.edit',$tag->id)}}">Edit</a></td>
                            <td class="pr-0">
                                <button class="btn btn-danger" onclick="handleDelete({{$tag->id}})">Delete</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Tags Yet</h3>
            @endif
            <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="post" id="deleteTagsForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete tags</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this tags?</p>
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
            var form=document.getElementById('deleteTagsForm');
            console.log(form);
            form.action='/tags/'+$id
        }

    </script>

@stop

