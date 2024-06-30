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
    <div class="card-header">
        <h6 class="mb-0">penyewaan</h6>
    </div>
    <div class="card-body">

        <div class="card-header py-2">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <div class="">
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">penyewaan ID</strong><br>
                            <strong class="text-inverse">Nomor Sewa</strong><br>
                            <strong class="text-inverse">Customer</strong><br>
                            <strong class="text-inverse">Jenis Pembayaran</strong><br>
                            <strong class="text-inverse">Total Pembelian</strong><br>
                            <strong class="text-inverse">Status Pembayaran</strong><br>
                        </address>
                    </div>
                </div>
                <div class="col">
                    <div class="">
                        <address class="m-t-5 m-b-5">
                        @if ($penyewaan->isNotEmpty())
                            @php
                                $detail = $penyewaan->first();
                                $total = number_format($detail->total_penyewaan,2);
                                $lunas = $detail->status_penyewaan;
                            @endphp
                            {{ $detail->id }}<br>
                            {{ $detail->nomor_sewa }}<br>
                            {{ $detail->customer }}<br>
                            {{ $detail->jenis_penyewaan }}<br>
                            {{ $total }}<br>
                            {{ $lunas }}<br>

                        @endif
                        </address>
                    </div>
                </div>
                <div class="col">
                @if($lunas=='LUNAS')
                    <img <img src="{{ asset('images/lunas1.png') }}" class="logo-icon" alt="Lunas Image">
                @endif
                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center" style="display: flex; justify-content: space-between;">
            <h5 class="mb-0" id="Title" style="float: left;">Data penyewaan Detail</h5>
            <div id="display" style="float: right;">
                <div id="nilai"><h1>{{ $total }}</h1></div>
            </div>
        </div>
        @if ($message = Session::get("success"))
            <div id="alert" class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            <script>
                // Timeout function to hide the alert after 2 seconds
                setTimeout(function() {
                    document.getElementById('alert').style.display = 'none';
                }, 2000); // 2000 milliseconds = 2 seconds
            </script>
        @endif
        <div class="table-responsive mt-3">
        @if($lunas!='LUNAS')
            <a class="btn btn-sm btn-success px-2" style="margin-bottom:10px"
            href="{{ route('penyewaandetail.create',['id' => $id]) }}">
            <ion-icon name="add"></ion-icon> Tambah Data</a>
        @endif

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>kode_komik</th>
                        <th>nama_komik</th>
                        <th>tanggal_sewa</th>
                        <th>tanggal_dikembalikan</th>
                        <th>qty</th>
                        <th>harga</th>
                        <th>subtotal</th>
                        @if($lunas!='LUNAS')
                        <th width="280px">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($penyewaandetail as $penyewaandetail)
                    <tr>
                        <td>{{ $penyewaandetail->id }}</td>
                        <td>{{ $penyewaandetail->kode_komik }}</td>
                        <td>{{ $penyewaandetail->komik->nama_komik }}</td>
                        <td>{{ $penyewaandetail->tanggal_sewa }}</td>
                        <td>{{ $penyewaandetail->tanggal_dikembalikan }}</td>
                        <td>{{ $penyewaandetail->qty }}</td>
                        <td>{{ number_format($penyewaandetail->harga) }}</td>
                        <td>{{ number_format($penyewaandetail->subtotal) }}</td>
                        @if($lunas!='LUNAS')
                        <td>
                            <div class="d-flex align-items-center">

                                <form method="POST" action="{{ route('penyewaandetail.destroy', ['detail_id' => $penyewaandetail->id, 'penyewaan_id' => $penyewaandetail->penyewaan_id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <ion-icon name="trash-outline"></ion-icon> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach


                </tbody>
            </table>
            @if($lunas!='DIKEMBALIKAN' && $total<>0)
            <div class="d-flex align-items-center" style="display: flex; justify-content: flex-end;">
                <a class="btn btn-sm btn-primary px-2" style="margin-top: 10px;" href="{{ route('penyewaandetail.lunas',['id' => $id]) }}">
                <ion-icon name="bag-check-sharp"></ion-icon> Set Lunas</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
