@extends('layouts.app')

@section('content')
<div class="container">
    <h1>I miei Post</h1>
    @if (session('deleted'))
        <span class="alert alert-success">
            <strong>{{ session('deleted') }}</strong>
            eliminato correttamente!
        </span>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td> {{-- category --}}
                        @if ($post->category)
                            {{ $post->category->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td> {{-- tags --}}
                        @forelse ($post->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                        @empty
                            -
                        @endforelse
                    </td>
                    <td> {{-- show --}}
                        <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                    </td>
                    <td> {{-- edit --}}
                        <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                    </td>
                    <td> {{-- form x delete --}}
                        <form action="{{ route('admin.posts.destroy',$post) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
