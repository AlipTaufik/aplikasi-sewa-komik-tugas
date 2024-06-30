@extends('layouts.default')
@section('content')
<!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Master Data</div>
        <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">

            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>
        </div>

    </div>
    <!--end breadcrumb-->


    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Edit penyewaan</h6>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('penyewaan.update',$penyewaan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="mb-3">
                    <label class="form-label">nomor_sewa:</label>
                    <input type="text" name="nomor_sewa" value="{{ $penyewaan->nomor_sewa }}"
                    class="form-control" placeholder="nomor_sewa">
                    @error('nomor_sewa')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">customer:</label>
                    <input type="text" name="customer" value="{{ $penyewaan->customer }}"
                    class="form-control" placeholder="customer">
                    @error('customer')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">total_penyewaan:</label>
                    <input type="text" name="total_penyewaan" value="{{ $penyewaan->total_penyewaan }}"
                    class="form-control" placeholder="total_penyewaan">
                    @error('total_penyewaan')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">status_penyewaan:</label>
                    <select name="status_penyewaan" class="form-select mb-3" aria-label="Default select example">
                        <option value="{{ $penyewaan->status_penyewaan }}">{{ $penyewaan->status_penyewaan }}</option>
                        <option value="DISEWA">DISEWA</option>
                        <option value="DIKEMBALIKAN">DIKEMBALIKAN</option>

                    </select>
                    @error('status_penyewaan')
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
