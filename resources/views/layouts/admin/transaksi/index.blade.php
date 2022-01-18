@extends('layouts.admin.index')
@section('content')
<div class="content-wrapper">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Data Penjualan Oleh-Oleh Khas Makassar</h2>
                <hr>
                <button class="btn btn-success" data-toggle="modal" data-target="#transaksi" data-whatever="@mdo">Tambah
                    Data Penjualan ⭢</button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $dataTable->scripts() !!}
</div>

<div class="modal fade" id="transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('transaksi.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama </label>
            <input type="text" class="form-control" id="recipient-name"  name="nama" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Deskripsi</label>
                <input type="text" class="form-control" id="recipient-name" name="deskripsi" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Gambar</label>
                <input type="file" class="form-control" id="recipient-name" name="gambar" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Harga</label>
                <input type="number" class="form-control" id="recipient-name"  name="harga" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Stock</label>
                <input type="number" class="form-control" id="recipient-name"  name="stock" required>
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

<div id="result"></div>
<script>
    function actiontransaksi(action, id){
        $.ajax({
        url:"transaksi/"+action+"/"+id,
        method:"GET",
            success:function(data){
                $('#result').html(data.html);
            },
            error:function() {
               alert("gagal");
            }
        });
    }
</script>
@endsection
