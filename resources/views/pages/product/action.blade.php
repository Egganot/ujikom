<div class="d-flex justify-content-center align-items-center gap-2">
    @auth
        @if (in_array(Auth::user()->role, ['admin', 'superAdmin']))
            <button onclick="editProduct({{ $data->id }})" class="btn btn-warning btn-edit">
                <i class="fas fa-pen"></i>
            </button>
            &nbsp;
            <button onclick="deleteProduct({{ $data->id }})" class="btn btn-danger btn-delete">
                <i class="fas fa-trash"></i>
            </button>
            &nbsp;
        @endif
        @if (in_array(Auth::user()->role, ['user']))
            <a href="{{ route('produk.detail', $data->id) }}" class="btn btn-primary btn-detail">
                <i class="fas fa-eye"></i>
            </a>
        @endif
    @endauth
</div>
