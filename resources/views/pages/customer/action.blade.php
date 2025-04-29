<div class="d-flex justify-content-center align-items-center gap-2">
    <button onclick="editCustomer({{ $data->id }})" class="btn btn-warning btn-edit">
        <i class="fas fa-pen"></i>
    </button>
    &nbsp;
    <button onclick="deleteCustomer({{ $data->id }})" class="btn btn-danger btn-delete">
        <i class="fas fa-trash"></i>
    </button>
</div>
