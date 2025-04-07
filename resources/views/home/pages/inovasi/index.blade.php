@extends('home.layouts.master')

@section("title", "Inovasi | BALAI UJI KIR MALANG KOTA")

@section("css")
<link href="assets/css/inovasi/style.css" rel="stylesheet">
@endsection

@section("content")
<div class="inov-bg">
    {{-- <img src="{{URL::to('/')}}/assets/img/c.png" alt=""> --}}
</div>

<div class="container mt-4" style="margin-top: 80px">
    <h1 class="text-center">Inovasi</h1>
    <div class="gallery">
        <div class="container mt-5">
            <h2 class="text-center">Data Kendaraan Masuk (datarfid)</h2>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Polisi</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rfid as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row->nouji }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->statuspenerbitan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada data kendaraan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <form id="frmTahun" method="get">
    @csrf
    <input type="hidden" name="year"/>
</form> --}}
@endsection

@section("script")
{{-- 
<script>
$(document).ready(function () {
    $('#tahunList li a').on('click', function () {
        var year = ($(this).text());
        $("#frmTahun").attr("action", "{{ route('home.inovasi.index') }}");
        $("#frmTahun").find('input[name="year"]').val(year);
        $("#frmTahun").submit();
    });
});
</script> 
--}}
@endsection
