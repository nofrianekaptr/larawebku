@extends('layouts.admin')
@section('content')
<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Setting Profile &mdash; {{ Auth::user()->name }}</h4>
            </div>
            <div class="card-body">

                <div class="text-center mb-3">
                    @if (Auth::user()->profile == 0)
                    <img src="{{ asset('default.png') }}" alt="" height="150">
                    @else
                    <img src="{{ Auth::user()->take_image }}" alt="" height="150">
                    @endif
                </div>

                <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="" class="form-label">Foto Profile</label>
                        <input type="file" class="form-control" name="profile">
                        @error('profile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-capitalize">email</label>
                        <input readonly disabled type="text" class="form-control" value="{{ Auth::user()->email }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Quote</label>
                        <textarea type="text" class="form-control" name="quote">{{ Auth::user()->quote }}</textarea>
                        @error('quote')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jobs</label>
                        <input type="text" class="form-control" name="job" value="{{ Auth::user()->job }}">
                        @error('job')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
