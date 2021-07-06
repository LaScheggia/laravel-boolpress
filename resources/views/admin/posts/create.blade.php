@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuovo post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <ul>
                <li>{{$error}}</li>
            </ul>
            @endforeach
        </div>
    @endif

    <div>
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label class="label-control" for="title">Titolo</label>
                <input type="text" id="title" name="title"  class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
				<p class="text-danger"> {{$message}} </p>
			    @enderror
            </div>

            <div class="mb-3">
                <label class="label-control" for="content">Content</label>
                <textarea type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content') }}</textarea>
                @error('content')
				<p class="text-danger"> {{$message}} </p>
			    @enderror
            </div>

            <div class="mb-3"> {{-- category --}}
                <label class="label-control" for="category_id">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror"
                name="category_id" id="category_id">
                    <option value=""> - select a category - </option>
                    @foreach($categories as $category)
                        <option
                        @if(old('category_id') == $category->id)  selected @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3"> {{-- tags --}}
                <h5>Tag</h5>
                @foreach($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            id="tag{{ $loop->iteration }}"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            @if(in_array($tag->id, old('tags',[])))  checked  @endif
                        >
                        <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                @endforeach
                @error('tags')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Invio</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>

        </form>
    </div>


</div>
@endsection
