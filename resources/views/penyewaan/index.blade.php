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
            <h5 class="mb-0">Data penyewaan</h5>
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
            href="{{ route("penyewaan.create") }}"><ion-icon name="add"></ion-icon> Tambah Data</a>
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>nomor_sewa</th>
                        <th>customer</th>
                        <th align="center">total_penyewaan</th>
                        <th align="center">status_penyewaan</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($penyewaan as $penyewaan)

                    <tr>
                        <td>{{ $penyewaan->id }}</td>
                        <td>{{ $penyewaan->nomor_sewa }}</td>
                        <td>{{ $penyewaan->customer }}</td>
                        <td align="right">{{ number_format($penyewaan->total_penyewaan) }}</td>
                        <td align="center">{{ $penyewaan->status_penyewaan }}</td>
                        <td>
                        <a class="btn btn-info" href="{{ route('penyewaandetail.list', ['id' => $penyewaan->id]) }}">
                        <ion-icon name="bag-handle-sharp"></ion-icon> Detail</a>
                            @if($penyewaan->total_pembelian==0)
                            <a class="btn btn-primary" href="{{ route('penyewaan.edit',$penyewaan->id) }}">
                                <ion-icon name="pencil-sharp"></ion-icon> Edit</a>
                            <a class="btn btn-danger" href="{{ route('penyewaan.show',$penyewaan->id) }}">
                                <ion-icon name="trash-outline"></ion-icon> Delete</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="btn-group" style="margin-top:10px; float:right">
                @php
                    for($i=1;$i<=$totalpages;$i++){
                        echo("<a href='/penyewaan?page=$i' class='btn btn-sm btn-outline-primary'>$i</a>");
                    }
                @endphp
            </div>
        </div>
    </div>
</div>
@endsection
