@extends('template.template')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
          <div class="card">
            <div class="d-flex align-items-start row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary mb-3">Selamat Datang! 🎉</h5>
                  <p class="mb-6">
                    Selamat datang datang di sistem reservasi hotel. Silahkan pilih menu yang tersedia di samping untuk melakukan reservasi.
                  </p>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-6">
                  <img
                    src="{{asset('theme/1/assets/img/illustrations/man-with-laptop.png')}}"
                    height="175"
                    class="scaleX-n1-rtl"
                    alt="View Badge User" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->

</div>
   

@endsection