@extends('layouts.admin')
@section('content')


@if (Session::has('success'))
<div class="alert alert-primary">
    <p>{{ Session::get('success') }}</p>
</div>
@endif


<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('shorturl.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="link" class="form-control" placeholder="Enter URL"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Generate Shorten Link</button>
                    </div>
                </div>
                <div class="mt-2">
                    @error('link')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</section>



<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                DataTable Short Url
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th>Copy Link</th>
                            <th>Short Link</th>
                            <th>Link</th>
                            <th>Hits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($su as $row)
                        <tr>
                            <td>
                                <button class="btn btn-primary btn-sm ms-1 rounded-3"
                                    onclick="copyToClipboard('{{ route('shorturl.getcode', $row->code) }}')">
                                    <i data-feather="copy"></i>
                                </button>
                            </td>
                            <td><a href="{{ route('shorturl.getcode', $row->code) }}"
                                    target="_blank">{{ route('shorturl.getcode', $row->code) }}</a>

                            </td>
                            <td>{{ $row->link }}</td>
                            <td>{{ number_format($row->hits) }}</td>
                            <td>
                                <form action="{{ route('shorturl.destroy', $row->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        onclick="return confirm('Yakin Hapus Data Secara Permanent?');"
                                        class="btn btn-danger btn-sm">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
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
<script>
    function copyToClipboard(text) {
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link copied to clipboard!");
    }

</script>
@endpush
