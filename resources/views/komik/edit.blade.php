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
            <h6 class="mb-0">Edit Komik</h6>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('komik.update', $komik->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Kode Komik:</label>
                        <input type="text" name="kode_komik" class="form-control" value="{{ $komik->kode_komik }}" placeholder="Kode Komik">
                        @error('kode_komik')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Komik:</label>
                        <input type="text" name="nama_komik" class="form-control" value="{{ $komik->nama_komik }}" placeholder="Nama Komik">
                        @error('nama_komik')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga:</label>
                        <input type="text" name="harga" class="form-control" value="{{ $komik->harga }}" placeholder="Harga">
                        @error('harga')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre:</label>
                        <input type="text" name="genre" class="form-control" value="{{ $komik->genre }}" placeholder="Genre">
                        @error('genre')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto:</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary ml-3">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
