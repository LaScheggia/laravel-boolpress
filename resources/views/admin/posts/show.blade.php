@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <h4>
        @if ($post->category) {{ $post->category->name }}
        @else
        -
        @endif
    </h4>

    <p>{{ $post->content }}</p>
    <div>
        <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
    </div>
    <div>
        <a class="btn btn-info" href="{{ route('admin.posts.index') }}">BACK</a>
    </div>

</div>
@endsection
