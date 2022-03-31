@extends('layouts.master')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <img src="" class="w-100" alt="">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data</h1>


    </div>

    <div class="row">

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <form action="/arsip/edit/{{ $arsip->id }}" method="post" class="m-3" enctype="multipart/form-data"
                    class="m-3">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Nama</label>
                        <input required name="nama" value="{{ $arsip->nama }}" class="form-control" type="text"
                            placeholder="Nama. . .">
                    </div>
                    <div class="form-group">
                        <label>Dokumen Letter C</label>
                        <input name="dokumen" class="form-control" type="file" accept="image/*" capture="camera">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
