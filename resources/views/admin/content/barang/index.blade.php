@extends('admin.master.index')
@section('content')
<div class="col-lg-12 mt-3">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tabel Barang</h5>
            <div class="container my-3">

              @if (auth()->user()->role == 'superadmin')
                <a href="/superadmin/barang/create" class="btn btn-primary"><small>+</small> Tambah Data Barang</a>

              @elseif(auth()->user()->role == 'admin')
              <a href="/admin/barang/create" class="btn btn-primary"><small>+</small> Tambah Data Barang</a>
              @endif

            </div>
            <table id="table-barang" class="table table-hover table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Rarity</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah Stok</th>
                        <th scope="col">Tgl Sunting</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@if (auth()->user()->role == 'superadmin')
@push('js')
<script type="text/javascript">
  $(function () {
    let table = $('#table-barang').DataTable({
      processing: true,
      serverSide: true,
      responsive: {
        details: {
          type: 'column'
        }
      },
      columnDefs: [{
        className: 'dtr-control',
        orderable: false,
        targets:   0
      }],
      ajax: "{{ route('superadmin.barang-json') }}",
      columns : [
            {data: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'kode', name: 'kode'},
            {data: 'rarity', name: 'rarity'},
            {data: 'kategori', name: 'kategori'},
            {data: 'qty', name: 'qty'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action'}
        ]
    });
  });
</script>
@endpush
@elseif(auth()->user()->role == 'admin')
@push('js')
<script type="text/javascript">
  $(function () {
    let table = $('#table-barang').DataTable({
      processing: true,
      serverSide: true,
      responsive: {
        details: {
          type: 'column'
        }
      },
      columnDefs: [{
        className: 'dtr-control',
        orderable: false,
        targets:   0
      }],
      ajax: "{{ route('admin.barang.json') }}",
      columns : [
            {data: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'kode', name: 'kode'},
            {data: 'rarity', name: 'rarity'},
            {data: 'kategori', name: 'kategori'},
            {data: 'qty', name: 'qty'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action'}
        ]
    });
  });
</script>
@endpush
@endif
