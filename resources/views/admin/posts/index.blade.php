@extends('layouts.admin')
@section('content')


<div class="mb-3">
    <a href="{{ route('post.create') }}" class="btn btn-primary border-0 shdow-sm">Create Post</a>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                DataTable My Posts
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
@endsection

@push('cs')
<link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>

@endpush
