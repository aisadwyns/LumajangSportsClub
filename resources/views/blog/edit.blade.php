@extends('layouts.mantis')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Blog</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}"
                        required>
                </div>

                {{-- Slug (readonly) --}}
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{ $blog->slug }}" readonly>
                </div>

                {{-- Excerpt --}}
                <div class="mb-3">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" id="editor" class="form-control" rows="6">{{ old('content', $blog->content) }}</textarea>
                </div>

                {{-- Thumbnail --}}
                <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">

                    @if ($blog->thumbnail)
                        <div class="mt-2">
                            <img src="{{ asset('storage/blogs/' . $blog->thumbnail) }}" class="img-thumbnail"
                                width="200">
                        </div>
                    @endif
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Rich Editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => console.error(error));
    </script>
@endsection
