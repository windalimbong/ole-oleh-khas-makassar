<!-- Modal -->
<div class="modal fade show" id="modal-editransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('transaksi.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nama </label>
                    <input type="text" class="form-control" id="recipient-name"  name="nama" value="{{$data->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="recipient-name" name="deskripsi" value="{{$data->deskripsi}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gambar</label>
                        <input type="file" class="form-control" id="recipient-name" name="gambar" value="{{$data->gambar}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Harga</label>
                        <input type="number" class="form-control" id="recipient-name"  name="harga" value="{{$data->harga}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Stock</label>
                        <input type="number" class="form-control" id="recipient-name"  name="stock" value="{{$data->stock}}">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>

    </div>
    </div>
</div>
<script>
    $("#modal-editransaksi").modal('show');
        $.fn.modal.Constructor.prototype._enforceFocus = function() {
            $(document).off('focusin.bs.modal').on('focusin.bs.modal');
        };
</script>
