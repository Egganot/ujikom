@extends('components.app')
@section('title', 'Apoteker Page')
@section('konten')
    <!-- Content-header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">List Apoteker</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('landing.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Apoteker</li>
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
                        data-bs-target="#addApotekerModal">
                        <i class="fas fa-plus fs-3 me-2"></i>
                        <span class="ms-2 fs-5">Tambah</span>
                    </button>
                </div>

                <!-- Modal -->
                @include('pages.apoteker.modal')

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
        $('#addApotekerForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('apoteker.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#addApotekerModal').modal('hide');
                    $('#apoteker-table').DataTable().ajax.reload();
                    Swal.fire('Sukses!', res.success, 'success');
                },
                error: function(err) {
                    console.log(err.responseJSON);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan data.', 'error');
                }
            });
        });

        // Show data in Edit Modal
        function editApoteker(id) {
            $.get(`/apoteker/${id}`, function(data) {
                $('#editApotekerModal').modal('show');
                $('#editApotekerForm').attr('action', `/apoteker/${id}`);
                $('#edit_nama_apoteker').val(data.NmApoteker);
                $('#edit_alamat').val(data.Alamat);
                $('#edit_kota').val(data.Kota);
                $('#edit_telpon').val(data.Telpon);
                $('#edit_email').val(data.user.email);
                $('#edit_password').val('');
            }).fail(function() {
                Swal.fire('Gagal!', 'Data tidak ditemukan.', 'error');
            });
        }

        // Update
        $('#editApotekerForm').on('submit', function(e) {
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
                    $('#editApotekerModal').modal('hide');
                    $('#apoteker-table').DataTable().ajax.reload();
                    Swal.fire('Berhasil!', res.success, 'success');
                },
                error: function(err) {
                    console.log(err.responseJSON);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
                }
            });
        });

        // Delete
        function deleteApoteker(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data Apoteker akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/apoteker/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            $('#apoteker-table').DataTable().ajax.reload();
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
