@extends('admin.master.index')
@section('content')
<div class="col-lg-12 mt-3">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tabel Data Customer</h5>
            <table id="table-admin" class="table table-hover table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Terdaftar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
@push('js')
<script type="text/javascript">
  $(function () {
    let table = $('#table-admin').DataTable({
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
      ajax: "{{ route('superadmin.user-json') }}",
      columns : [
            {data: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'nohp', name: 'nohp'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action'}
        ]
    });
  });
</script>
@endpush
@endpush