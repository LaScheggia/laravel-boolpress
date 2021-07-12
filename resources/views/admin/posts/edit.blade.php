@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica:
        <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a> </h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <form action="{{ route('admin.posts.update',$post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="label-control" for="title">Titolo</label>
                <input type="text" id="title" name="title"
                value="{{ old('title', $post->title) }}"
                class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="label-control" for="content">Content</label>
                <textarea type="text" id="content" name="content"
                class="form-control @error('content') is-invalid @enderror" rows="5" >{{ old('content',$post->content) }}</textarea>
                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="label-control" for="category_id">Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror"
                name="category_id" id="category_id">
                    <option value=""> - selezionare una categoria - </option>
                    @foreach($categories as $category)
                        <option


                        @if(old('category_id', $post->category_id) == $category->id)  selected @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <h5>Tag</h5>
                @foreach($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            id="tag{{ $loop->iteration }}"
                            name="tags[]"
                            value="{{ $tag->id }}"

                            @if ($errors->any() && in_array($tag->id, old('tags',[])))
                                checked
                            @elseif (!$errors->any() && $post->tags->contains($tag->id))
                                checked
                            @endif

                        >
                        <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                @endforeach
                @error('tags')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <div>
                    <label class="label-control" for="cover">Immagine</label>
                </div>

                @if ($post->cover)
                    <img width="150" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->cover_original_name }}">
                @endif
                <input type="file" id="cover" name="cover"
                onchange="previewFile()"
                class="form-control @error('cover') is-invalid @enderror">
                {{-- @error ==> controlla se fra gli errori esiste quello che ti passo come parametro e passa in $message l'errore --}}
                @error('cover')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Invio</button>
            </div>

        </form>
    </div>


</div>

<script>
function previewFile() {
  var preview = document.querySelector('img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();
  reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
</script>
@endsection
