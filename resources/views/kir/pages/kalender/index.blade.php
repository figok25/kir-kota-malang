@extends('kir.layouts.master')
@section("title","Kalender ~ BALAI UJI KIR MALANG KOTA")")")")
@section("title_breadcumb","Kalender")
@section('css')

@endsection
@section('breadcumb','Kalender')

@section("content")
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <a href="{{ route('kir.kalender.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            <a href="#" class="btn btn-success btn-filter"><i class="fa fa-filter"></i> Fiter</a>
                            <a href="{{route('kir.kalender.index')}}" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <th style="width:5%">No</th>
                                        <th style="width:15%">Judul</th>
                                        <th style="width:20%">Tanggal Mulai</th>
                                        <th style="width:20%">Tanggal Selesai</th>
                                        <th style="width:20%">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($table as $index => $row)
                                        <tr>
                                            <td>{{ $table->firstItem() + $index }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{date('d-m-Y',strtotime($row->start))}}</td>
                                            <td>{{date('d-m-Y',strtotime($row->end))}}</td>
                                            <td>
                                                <div class="d-flex mb-1">
                                                    <a href="{{route('kir.kalender.show',$row->id)}}" class="btn btn-success btn-sm mr-1"><i class="fa fa-address-card"></i> Detail</a>
                                                    <a href="{{ route('kir.kalender.edit',$row->id) }}" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm mr-1 btn-delete" data-id="{{$row->id}}"><i class="fa fa-trash"></i> Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {!!$table->links()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("kir.pages.kalender.modal.index")

    <form id="frmDelete" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id"/>
    </form>

    @endsection

    @section("script")
    <script>
        $(function(){
            $(document).on("click",".btn-filter",function(e){
                e.preventDefault();

                $("#modalFilter").modal("show");
            });

            $(document).on("click",".btn-delete",function(){
                let id = $(this).data("id");
                if(confirm("Apakah anda yakin ingin menghapus data ini ?")){
                    $("#frmDelete").attr("action", "{{ route('kir.kalender.destroy', '_id_') }}".replace("_id_", id));
                    $("#frmDelete").find('input[name="id"]').val(id);
                    $("#frmDelete").submit();
                }
            })
        })
    </script>

    @endsection
