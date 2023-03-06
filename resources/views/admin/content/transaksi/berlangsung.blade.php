@extends('admin.master.index')
@section('content')
<div class="col-lg-12 mt-3">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Transaksi Berlangsung</h5>
            <table id="table-transaksi" class="table table-hover table-striped" style="width: 100%;">
                <thead>
                    <tr>
                      <th></th>
                        <th scope="col">Pembeli</th>
                        <th scope="col">Total</th>
                        <th scope="col">Kode Transaksi</th>
                        <th scope="col">Tanggal Transaksi</th>
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
      let table = $('#table-transaksi').DataTable({
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
        ajax: "{{ route('superadmin.transaksi-berlangsung.json') }}",
        columns : [
              {data:'DT_RowIndex'},
              {data: 'users', name: 'users'},
              {data: 'total', name: 'total'},
              {data: 'kode_transaksi', name: 'kode_transaksi'},
              {data: 'created_at', name: 'created_at'},
          ]
      });
    });
  </script>
@endpush
@elseif(auth()->user()->role == 'admin')
@push('js')
<script type="text/javascript">
    $(function () {
      let table = $('#table-transaksi').DataTable({
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
        ajax: "{{ route('admin.transaksi.berlangsung.json') }}",
        columns : [
              {data:'DT_RowIndex'},
              {data: 'users', name: 'users'},
              {data: 'total', name: 'total'},
              {data: 'kode_transaksi', name: 'kode_transaksi'},
              {data: 'created_at', name: 'created_at'},
          ]
      });
    });
  </script>
@endpush
@endif
