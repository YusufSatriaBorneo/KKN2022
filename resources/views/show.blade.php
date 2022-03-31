@extends('layouts.master')
@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4 p-2">
        <table width="100%" class=" table table-striped table-bordered table-hover" id="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>


</div>

<div class="modal fade" id="lihat" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
             <div id="nama"></div>
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img id="dokumen" class="dokumen w-100 mx-0 d-block" src="" alt="">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Apa Anda Yakin
                    Menghapus Data <div id="nama"></div> ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="mb-2"></div>
                </div>
                <form id="form-delete" action="" method="post">
                    @csrf
                    @method('delete')

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side
            ajax: {
                url: "{{ route('arsip') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ],
            order: [
                [0, 'asc']
            ]
        });
    });

    $('body').on('click', '.tampil-post', function () {
    var data_id = $(this).data('id');
    $.get('arsip/' + data_id + '/show', function (data) {
            $('#lihat').modal('show');

            $('#id').val(data.id);
            $('#dokumen').attr('src',"http://127.0.0.1:8000/dokumen/"+data.dokumen);
            $('#nama').html(data.nama);
        })
    });

    $('body').on('click', '.delete-post', function () {
        var data_id = $(this).data('id');
        $.get('arsip/' + data_id + '/show', function (data) {
        $('#delete').modal('show');

        $('#nama').html(data.nama)
        $('#form-delete').attr('action',"/arsip/delete/"+data.id);
        })
        });








</script>
@endsection
