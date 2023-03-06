@extends('admin.master.index')
@section('content')
<div class="card">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $tm }} <span class="float-right"><i class="bx bx-cart"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Transaksi</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $users }} <span class="float-right"><i class="bx bx-user"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total User</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">@currency($pendapatan)<span class="float-right"><i class="fa fa-eye"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Pendapatan</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">5630 <span class="float-right"><i class="fa fa-envira"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Messages <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
        </div>
    </div>
 </div>  
	  
	    <div class="card">
		 <div class="card-header">Pendapatan perbulan tahun ini

		   <div class="card-action">
			 <div class="dropdown">
			 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
			  <i class="icon-options"></i>
			 </a>
				<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="javascript:void();">Action</a>
				<a class="dropdown-item" href="javascript:void();">Another action</a>
				<a class="dropdown-item" href="javascript:void();">Something else here</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void();">Separated link</a>
			   </div>
			  </div>
		   </div>
		 </div>
     <div class="p-2">
       <canvas id="myChart"></canvas>
     </div>
		</div>
      <!--End Dashboard Content-->
	  
	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  const ctx = document.getElementById('myChart');
  var jan = {{ Js::from($jan) }}
  var feb = {{ Js::from($feb) }}
  var mar = {{ Js::from($mar) }}
  var apr = {{ Js::from($apr) }}
  var may = {{ Js::from($may) }}
  var june = {{ Js::from($june) }}
  var july = {{ Js::from($july) }}
  var aug = {{ Js::from($aug) }}
  var sept = {{ Js::from($sept) }}
  var oct = {{ Js::from($oct) }}
  var nov = {{ Js::from($nov) }}
  var dec = {{ Js::from($dec) }}
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['jan','feb','mar','apr','may','june','july','aug','sept','oct','nov','dec'],
      datasets: [{
        label: 'Total Uang masuk Tahun Ini',
        data: [jan,feb,mar,apr,may,june,july,aug,sept,oct,nov,dec],
        backgroundColor: '#4B49AC',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endpush