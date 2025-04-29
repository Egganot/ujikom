@extends('components.app')
@section('title', 'Pembelian Page')
@section('konten')
    <!-- Content-header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pembelian</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('landing.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
                </ol>
            </div>
        </div>
    </div>


    <!-- Main content -->

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Form Pilihan Supplier dan Pelanggan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label>Supplier</label>
                        <select id="supplier" class="form-control">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->NmSupplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Customer</label>
                        <select id="customer" class="form-control">
                            <option value="">-- Pilih Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->NmPelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Search Obat -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <label>Nama Obat</label>
                        <input type="text" id="search-obat" class="form-control" placeholder="Ketik nama obat...">
                        <div id="autocomplete-obat" class="list-group" style="position: absolute; z-index: 1000;"></div>
                    </div>
                </div>

                <!-- Tabel Sementara -->
                <table id="tabel-sementara" class="table table-striped table-hover table-bordered align-middle fw-semibold fs-5">
                    <thead class="thead">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris akan diisi lewat JS -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td id="total-harga">Rp 0</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <label>Diskon (%)</label>
                        <input type="number" id="diskon" class="form-control" value="0" min="0"
                            max="100">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button id="simpan-transaksi" class="btn btn-success">Cetak Transaksi</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let daftarObat = []; // list semua obat (dari database)
        let keranjang = []; // list sementara obat yang dipilih

        // Disable supplier/customer
        $('#supplier').change(function() {
            if ($(this).val() !== '') {
                $('#customer').prop('disabled', true);
            } else {
                $('#customer').prop('disabled', false);
            }
        });

        $('#customer').change(function() {
            if ($(this).val() !== '') {
                $('#supplier').prop('disabled', true);
            } else {
                $('#supplier').prop('disabled', false);
            }
        });

        // Search autocomplete obat
        $('#search-obat').on('input', function() {
            let keyword = $(this).val();
            if (keyword.length >= 1) {
                $.ajax({
                    url: '/search-obat',
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(res) {
                        $('#autocomplete-obat').empty();
                        res.forEach(function(obat) {
                            $('#autocomplete-obat').append(
                                `<a href="#" class="list-group-item list-group-item-action" data-id="${obat.id}" data-nama="${obat.NmObat}" data-harga="${obat.HargaJual}">${obat.NmObat}</a>`
                            );
                        });
                    }
                });
            } else {
                $('#autocomplete-obat').empty();
            }
        });

        // Klik autocomplete obat
        $(document).on('click', '#autocomplete-obat a', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let harga = $(this).data('harga');

            let jumlah = 1; // default 1 pcs
            keranjang.push({
                id,
                nama,
                harga,
                jumlah
            });

            updateTabel();
            $('#search-obat').val('');
            $('#autocomplete-obat').empty();
        });

        // Update tabel
        function updateTabel() {
            let tbody = '';
            let total = 0;
            keranjang.forEach(function(item, index) {
                let subtotal = item.harga * item.jumlah;
                total += subtotal;
                tbody += `
            <tr>
                <td>${item.nama}</td>
                <td><input type="number" class="form-control jumlah" data-index="${index}" value="${item.jumlah}"></td>
                <td>Rp ${item.harga.toLocaleString()}</td>
                <td>Rp ${(subtotal).toLocaleString()}</td>
                <td><button class="btn btn-danger btn-sm hapus-item" data-index="${index}">Hapus</button></td>
            </tr>
        `;
            });
            $('#tabel-sementara tbody').html(tbody);
            $('#total-harga').text('Rp ' + total.toLocaleString());
        }

        $('#diskon').on('input', function() {
            updateTabel();
        });

        // Update jumlah item
        $(document).on('input', '.jumlah', function() {
            let index = $(this).data('index');
            keranjang[index].jumlah = parseInt($(this).val());
            updateTabel();
        });

        // Hapus item
        $(document).on('click', '.hapus-item', function() {
            let index = $(this).data('index');
            keranjang.splice(index, 1);
            updateTabel();
        });

        function updateTabel() {
            let tbody = '';
            let total = 0;
            keranjang.forEach(function(item, index) {
                let subtotal = item.harga * item.jumlah;
                total += subtotal;
                tbody += `
        <tr>
            <td>${item.nama}</td>
            <td><input type="number" class="form-control jumlah" data-index="${index}" value="${item.jumlah}"></td>
            <td>Rp ${item.harga.toLocaleString()}</td>
            <td>Rp ${(subtotal).toLocaleString()}</td>
            <td><button class="btn btn-danger btn-sm hapus-item" data-index="${index}">Hapus</button></td>
        </tr>`;
            });

            let diskonPersen = parseFloat($('#diskon').val()) || 0;
            let diskon = total * (diskonPersen / 100);
            let totalSetelahDiskon = total - diskon;

            $('#tabel-sementara tbody').html(tbody);
            $('#total-harga').html(`
        Rp ${total.toLocaleString()}<br>
        <small>Diskon: ${diskonPersen}% (-Rp ${diskon.toLocaleString()})</small><br>
        <strong>Grand Total: Rp ${totalSetelahDiskon.toLocaleString()}</strong>
    `);
        }

        // Simpan transaksi
        $('#simpan-transaksi').click(function() {
            if (keranjang.length == 0) {
                alert('Keranjang kosong!');
                return;
            }

            let data = {
                supplier_id: $('#supplier').val(),
                customer_id: $('#customer').val(),
                barang: keranjang,
                diskon: $('#diskon').val()
            };

            $.ajax({
                url: '/simpan-transaksi',
                method: 'POST',
                data: data,
                success: function(res) {
                    Swal.fire('Sukses', 'Transaksi berhasil disimpan!', 'success');
                    keranjang = [];
                    updateTabel();
                    $('#supplier').val('').prop('disabled', false);
                    $('#customer').val('').prop('disabled', false);
                    $('#diskon').val('0');
                },
                error: function(err) {
                    console.log(err);
                    Swal.fire('Error', 'Gagal menyimpan transaksi.', 'error');
                }
            });
        });
    </script>
@endpush
