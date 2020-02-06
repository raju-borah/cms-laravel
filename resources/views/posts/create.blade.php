@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($post)?'Edit Post':'Create Post'}}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PATCH')
                @endif
                <div class="form-group">
                    <label for="title" >Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{isset($post)?$post->title:''}}" >
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{isset($post)?$post->description:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="contents">Contents</label>
                    <input id="contents" type="hidden" name="contents" value="{{isset($post)?$post->contents:''}}">
                    <trix-editor input="contents"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at" >Published At</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{isset($post)?$post->published_at:''}}">
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/'.$post->image)}}" width="100%" alt="">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image" >Image</label>
                    <input type="file" name="image" id="image" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="category" >Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(isset($post))
                                    @if($category->id == $post->category->id)
                                    selected
                                @endif
                                @endif

                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">Tags</label>

                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                        @if(isset($post))
                                            @if($post->hasTags($tag->id))
                                            selected
                                            @endif
                                        @endif
                                >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>

                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{isset($post)?'Update':'Create Post'}}</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at',{
            enableTime:true
        });

        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
