@extends('kir.layouts.master')
@section("title","Menu ~ DINAS PENDIDIKAN DAN KEBUDAYAAN KOTA MALANG")
@section("title_breadcumb","Menu")
@section("breadcumb","Menu")
@section("breadcumb_child","Show")
@section("content")
<div class="container">
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
             

                <div class="row mb-2">
                    <div class="col-md-3">
                        Judul
                    </div>
                    <div class="col-md-8">
                        : {{$result->title}}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">
                        Konten
                    </div>
                    <div class="col-md-8">
                        <style>
                            img {
                                max-width: 100%;
                                height: auto;
                            }
                        </style>
                        <p>{!! $result->renderTrix("content") !!}</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3">
                        Tanggal Dibuat
                    </div>
                    <div class="col-md-8">
                        : {{ date('d-m-Y H:i:s',strtotime($result->created_at)) }}
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3">
                        Tanggal Diperbarui
                    </div>
                    <div class="col-md-8">
                        : {{ date('d-m-Y H:i:s',strtotime($result->updated_at)) }}
                    </div>
                </div>

                <div class="mt-5">
                    <a href="{{route('kir.menu.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="{{route('kir.menu.edit',$result->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i> Hapus</a>
                </div>

            </div>
        </div>
    </div>
</div>

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
</form>
@endsection

@section("script")
<script>
    $(function(){

        $(document).on("click",".btn-delete",function(){
            if(confirm("Apakah anda yakin ingin menghapus data ini ?")){
                $("#frmDelete").attr("action", "{{ route('kir.menu.destroy', '_id_') }}".replace("_id_", '{{$result->id}}'));
                $("#frmDelete").submit();
            }
        })
    })
</script>
</div>
@endsection