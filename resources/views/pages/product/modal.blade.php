<!-- Add Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Tambah Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPraductForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_product_id" name="product_id">
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis Obat</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Salep">Salep</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" id="satuan" name="satuan" required>
                            <option value="">Pilih Satuan Obat</option>
                            <option value="Strip">Strip</option>
                            <option value="Botol">Botol</option>
                            <option value="Box">Box</option>
                            <option value="Tube">Tube</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                    </div>
                    <input type="hidden" class="form-control" id="stok" name="stok" value="0">
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier<span class="text-danger"> *</span></label>
                        <select class="form-control" id="supplier" name="supplier" required>
                            <option value="">Pilih Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->NmSupplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" action="/product/{id}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nama_obat" class="form-label">Nama Obat<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_obat" name="nama_obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jenis" class="form-label">Jenis</label>
                        <select class="form-control" id="edit_jenis" name="jenis" required>
                            <option value="">Pilih Jenis Obat</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Salep">Salep</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_satuan" class="form-label">Satuan</label>
                        <select class="form-control" id="edit_satuan" name="satuan" required>
                            <option value="">Pilih Satuan Obat</option>
                            <option value="Strip">Strip</option>
                            <option value="Botol">Botol</option>
                            <option value="Box">Box</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" id="edit_harga_beli" name="harga_beli">
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" id="edit_harga_jual" name="harga_jual">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit_stok" class="form-label">Stok</label>
                        <input type="text" class="form-control" id="edit_stok" name="stok">
                    </div> --}}
                    <div class="mb-3">
                        <label for="edit_supplier" class="form-label">Supplier<span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="edit_supplier" name="supplier" required>
                            <option value="" disabled selected>-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->NmSupplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
