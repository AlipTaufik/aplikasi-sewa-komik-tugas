@extends("layouts.default")
@section("content")
<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Master Data</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">

            <li class="breadcrumb-item active" aria-current="page">Tampil Data</li>
            </ol>
        </nav>
    </div>

</div>
<!--end breadcrumb-->
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0">Data Komik</h5>
            <form class="ms-auto position-relative">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <ion-icon name="search-sharp"></ion-icon>
                </div>
                <input class="form-control ps-5" type="text" placeholder="search">
            </form>
        </div>
        @if ($message = Session::get("success"))
            <div id="alert" class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            <script>
                // Timeout function to hide the alert after 3 seconds
                setTimeout(function() {
                    document.getElementById('alert').style.display = 'none';
                }, 2000);
            </script>
        @endif
        <div class="table-responsive mt-3">
            <a class="btn btn-sm btn-success px-2" style="margin-bottom:10px"
            href="{{route('komik.create')}}"><ion-icon name="add"></ion-icon> Tambah Data</a>
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>kode_komik</th>
                        <th>nama_komik</th>
                        <th>harga per sewa</th>
                        <th>genre</th>
                        <th>image</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($komik as $komik)
                    <tr>
                        <td>{{ $komik->id }}</td>
                        <td>{{ $komik->kode_komik }}</td>
                        <td>{{ $komik->nama_komik }}</td>
                        <td>{{ number_format($komik->harga, 2, '.', ',') }}</td>
                        <td>{{ $komik->genre }}</td>
                        <td>
                            @if ($komik->image)
                                <img src="{{ asset('storage/komik/'.$komik->image)}}" alt=""
                                width="250px" class="img-thumbnail">
                                @else
                                <span class="badge badge-danger">No image</span>

                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('komik.edit',$komik->id)}}">
                                <ion-icon name="pencil-sharp"></ion-icon> Edit</a>
                            <a class="btn btn-danger" href="{{route('komik.show', $komik->id)}}">
                                <ion-icon name="trash-outline"></ion-icon> Delete</a>
                            <a class="btn btn-secondary" href="{{route('penyewaan.create')}}">
                                <ion-icon name="bag-check-outline"></ion-icon> Sewa</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="btn-group" style="margin-top:10px; float:right">
                @php
                    for($i=1;$i<=$totalpages;$i++){
                        echo("<a href='/barang?page=$i' class='btn btn-sm btn-outline-primary'>$i</a>");
                    }
                @endphp
            </div>
        </div>
    </div>
</div>
@endsection
