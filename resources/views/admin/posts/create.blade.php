@extends('layouts.admin')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Page Create Data My Posts
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                    @error('title')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
</section>
@endsection
