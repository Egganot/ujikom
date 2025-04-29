<!-- Add Modal -->
<div class="modal fade" id="addApotekerModal" tabindex="-1" role="dialog" aria-labelledby="addApotekerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addApotekerModalLabel">Tambah Apoteker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addApotekerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_apoteker_id" name="apoteker_id">
                    <div class="mb-3">
                        <label for="nama_apoteker" class="form-label">Nama Apoteker<span
                                class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="nama_apoteker" name="nama_apoteker" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota">
                    </div>
                    <div class="mb-3">
                        <label for="telpon" class="form-label">Telpon</label>
                        <input type="text" class="form-control" id="telpon" name="telpon">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Apoteker -->
<div class="modal fade" id="editApotekerModal" tabindex="-1" aria-labelledby="editApotekerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editApotekerModalLabel">Edit Apoteker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editApotekerForm" action="/apoteker/{id}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nama_apoteker" class="form-label">Nama Apoteker</label>
                        <input type="text" class="form-control" id="edit_nama_apoteker" name="nama_apoteker" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password" placeholder="isi jika ingin mengganti password">
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="edit_kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="edit_kota" name="kota">
                    </div>
                    <div class="mb-3">
                        <label for="edit_telpon" class="form-label">Telpon</label>
                        <input type="text" class="form-control" id="edit_telpon" name="telpon">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
