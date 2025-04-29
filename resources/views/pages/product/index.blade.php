@extends('components.app')
@section('title', 'Customer Page')
@section('konten')
    <!-- Content-header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">List Obat</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('landing.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Obat</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Main content -->

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex gap-1 mb-3">
                    <button class="btn btn-info" style="background: #009990" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">
                        <i class="fas fa-plus fs-3 me-2"></i>
                        <span class="ms-2 fs-5">Tambah</span>
                    </button>
                </div>

                <!-- Modal -->
                @include('pages.product.modal')

                <!-- DataTable -->
                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-striped table-hover table-bordered align-middle fw-semibold fs-5']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        // Create
        $('#addPraductForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('product.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#addProductModal').modal('hide');
                    $('#product-table').DataTable().ajax.reload();
                    Swal.fire('Sukses!', res.success, 'success');
                },
                error: function(err) {
                    console.log(err.responseJSON);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan data.', 'error');
                }
            });
        });

        // Show data in Edit Modal
        function editProduct(id) {
            $.get(`/product/${id}`, function(data) {
                $('#editProductModal').modal('show');
                $('#editProductForm').attr('action', `/product/${id}`);
                $('#edit_nama_obat').val(data.NmObat);
                $('#edit_jenis').val(data.Jenis);
                $('#edit_satuan').val(data.Satuan);
                $('#edit_harga_beli').val(data.HargaBeli);
                $('#edit_harga_jual').val(data.HargaJual);
                $('#edit_stok').val(data.Stok);
                $('#edit_supplier').val(data.supplier.id);
            }).fail(function() {
                Swal.fire('Gagal!', 'Data tidak ditemukan.', 'error');
            });
        }

        // Update
        $('#editProductForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let actionUrl = $(this).attr('action');
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function(res) {
                    $('#editProductModal').modal('hide');
                    $('#product-table').DataTable().ajax.reload();
                    Swal.fire('Berhasil!', res.success, 'success');
                },
                error: function(err) {
                    console.log(err.responseJSON);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
                }
            });
        });

        // Delete
        function deleteProduct(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data Obat akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/product/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            $('#product-table').DataTable().ajax.reload();
                            Swal.fire('Berhasil!', res.success, 'success');
                        },
                        error: function(err) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
