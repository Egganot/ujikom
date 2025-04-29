<div class="d-flex justify-content-center align-items-center gap-2">
    <button class="btn btn-info btn-edit" data-bs-toggle="modal"
        data-bs-target="#detailModal{{ $data->id }}">
        <i class="fas fa-info-circle fa-2x"></i>
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">Detail Transaksi {{ $data->Jenis }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Nama:</strong> {{ $data->Nama }}</p>
          <p><strong>Tanggal Transaksi:</strong> {{ $data->TglNota }}</p>
          <p><strong>Diskon:</strong> {{ $data->Diskon ?? 0 }}%</p>

          <hr>

          <h6>Detail Barang:</h6>
          <ul>
              @php
                  if ($data->Jenis === 'Pembelian') {
                      $detail = \App\Models\PembelianDetail::where('Nota', $data->id)->with('obat')->get();
                  } else {
                      $detail = \App\Models\PenjualanDetail::where('Nota', $data->id)->with('obat')->get();
                  }
              @endphp

              @foreach($detail as $item)
                  <li>{{ $item->obat->NmObat }} - Jumlah: {{ $item->Jumlah }}</li>
              @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
