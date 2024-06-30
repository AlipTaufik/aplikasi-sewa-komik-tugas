@extends('layouts.default')
@section('content')
<!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Master Data</div>
        <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">

            <li class="breadcrumb-item active" aria-current="page">Entry Data</li>
            </ol>
        </nav>
        </div>

    </div>
    <!--end breadcrumb-->


    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Add penyewaan</h6>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('penyewaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                    <div class="mb-3">
                        <label class="form-label">nomor_sewa:</label>
                        <input type="text" name="nomor_sewa" class="form-control" placeholder="nomor_sewa">
                        @error('nomor_sewa')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">customer:</label>
                        <input type="text" name="customer" class="form-control" placeholder="customer">
                        @error('customer')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary ml-3">Submit</button>
                    </div>

            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.getElementById('jenis_penyewaan').addEventListener('change', function() {
        var uraian = document.getElementById('uraian');
        var noktp = document.getElementById('noktp');
        var total_pembelian = document.getElementById('total_pembelian');
        var uang_muka = document.getElementById('uang_muka');
        var sisa_penyewaan = document.getElementById('sisa_penyewaan');
        var status_penyewaan = document.getElementById('status_penyewaan');
        if (this.value === 'CASH') {
            uraian.style.display = 'none';
            noktp.style.display = 'none';
            total_pembelian.style.display = 'none';
            uang_muka.style.display = 'none';
            sisa_penyewaan.style.display = 'none';
            status_penyewaan.style.display = 'none';
        } else {
            noktp.style.display = 'block';
            uang_muka.style.display = 'block';
        }
    });

    // Trigger the change event on page load to ensure correct initial state
    document.getElementById('jenis_penyewaan').dispatchEvent(new Event('change'));
</script>
@endpush
