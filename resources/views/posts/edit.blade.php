@extends('layout.app')

@section('content')
    <div class="col-12">
        <h1 class="p-3 border text-center my-3"> Edit post Info</h1>
    </div>
    <div class="col-8 mx-auto">
    <form action="{{ url('posts/' .$post->id) }}" method="POST" class="form">
        @method('PUT')
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger p-1">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        
        @endif
        <div class="mb-3">
            <label for="">Post Title</label>
            <input type="text" value="{{ $post->title }}" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label for="">Post Description</label>
            <textarea class="form-control" name="description" rows="7">{{ $post->description }}</textarea>
            {{ $post->title }}
        </div>
        <div class="mb-3">
            <label for="">Writer</label>
            <select name="user_id" class="form-control">
                <option value="1">Ahmed</option>
                <option value="2">Mohamed</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="Save">
        </div>
    </form>
</div>

@endsection