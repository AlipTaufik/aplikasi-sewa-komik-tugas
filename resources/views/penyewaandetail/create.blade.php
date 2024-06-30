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
            <h6 class="mb-0">Add penyewaanndetail</h6>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
                <script>
                    // Timeout function to hide the alert after 3 seconds
                    setTimeout(function() {
                        document.getElementById('alert').style.display = 'none';
                    }, 2000);
                </script>
            @endif
            <form action="{{ route('penyewaandetail.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                    <div class="mb-3">
                        <label class="form-label">penyewaan_id:&nbsp;{{ $id }}</label>
                        <input type="hidden" name="penyewaan_id" class="form-control" placeholder="penyewaan_id" value="{{ $id }}">
                        @error('penyewaan_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="search">Search:</label>
                        <input type="text" id="search" name="search" class="form-control" autocomplete="off">
                        <div id="suggestions" class="autocomplete-suggestions"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">kode_komik:</label>
                        <input type="text" name="kode_komik" id="kode_komik" class="form-control" autocomplete="off">
                        @error('kode_komik')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nama_komik:</label>
                        <input type="text" name="nama_komik" id="nama_komik" class="form-control" autocomplete="off">

                    </div>
                    <div class="mb-3">
                        <label class="form-label">tanggal_sewa:</label>
                        <input type="date" name="tanggal_sewa" id="nama_komik" class="form-control" autocomplete="off">

                    </div>
                    <div class="mb-3">
                        <label class="form-label">tanggal_dikembalikan:</label>
                        <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan" class="form-control" autocomplete="off">

                    </div>
                    <div class="mb-3">
                        <label class="form-label">harga:</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="harga" value="0">
                        @error('harga')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity:</label>
                        <div class="col-1">
                            <input type="text" name="qty" id="qty" class="form-control" placeholder="qty" value="1" required min="1" onchange="calculateSubtotal()">
                        </div>
                        @error('qty')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">subtotal:</label>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="subtotal">
                        @error('subtotal')
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
    function calculateSubtotal() {
        // Get the value of harga and qty
        let harga = parseFloat(document.getElementById('harga').value);
        let qty = parseInt(document.getElementById('qty').value);
        let subtotal = harga * qty;

        // Display subtotal in the subtotal input field
        document.getElementById('subtotal').value = subtotal.toFixed(2); // Using toFixed to format to 2 decimal places
    }
    $(document).ready(function() {

        $('#search').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '{{ route('search.komik') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        var      suggestions = '';

                        data.forEach(function(brg) {
                            suggestions += '<div class="autocomplete-suggestion" ' +
                                        'data-kode_komik="' + brg.kode_komik + '" ' +
                                        'data-harga="' + brg.harga + '" ' +
                                        'data-nama_komik="' + brg.nama_komik + '">' +
                                        brg.kode_komik + ' - ' + brg.nama_komik + ' - ' + brg.harga
                                        '</div>';
                        });
                        $('#suggestions').html(suggestions);
                    }
                });
            } else {
                $('#suggestions').html('');
            }
        });

        $(document).on('click', '.autocomplete-suggestion', function() {
            var kode_komik = $(this).data('kode_komik');
            var nama_komik = $(this).data('nama_komik');
            var harga = $(this).data('harga');


            // Now nim and nama contain the respective values
            console.log('Kode komik: ' + kode_komik);
            console.log('Nama komik: ' + nama_komik);
            console.log('Harga komik: ' + harga);

            // If you want to put the combined text in the input field
            $('#kode_komik').val(kode_komik);
            $('#nama_komik').val(nama_komik);
            $('#harga').val(harga);
            $('#subtotal').val(harga);

            // Clear the search field and suggestions
            $('#search').val('');
            $('#suggestions').html('');
        });
    });
</script>
@endpush
