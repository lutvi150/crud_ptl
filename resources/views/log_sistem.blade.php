@extends('template.template')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Log Database</h4>
                <div class="dropdown">
                </div>
              </div>
            <div class="card-body card-data-tamu">
                <table class="table table-bordered table-data-log">
                  <thead>
                      <th>No.</th>
                      <th>Aktifitas</th>
                      <th>Nama Tabel</th>
                      <th>Data Sebelum</th>
                      <th>Data Sesudah</th>
                  </thead>
                  <tbody class="data-log">
                      <tr hidden>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->

</div>
   

@endsection
@section('script')
<script>
  
  $(document).ready(function() {
        get_data();
    });
    get_data = () => {
        Notiflix.Block.arrows('.table-data-log', 'Loading...');
        $.ajax({
            type: "GET",
            url: url+"/api/log-database",
            dataType: "JSON",
            success: function(response) {
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.aktivitas}</td>
                            <td>${item.nama_tabel}</td>
                            <td>${item.data_sebelum}</td>
                            <td>${item.data_sesudah}</td>
                        </tr>`;
                    });
                    $('.data-log').html(html);
                    Notiflix.Block.remove('.table-data-log');
                } else {
                    Notiflix.Report.failure('Data Log', response.message, 'OK');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Report.Failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        })
    };
</script>
@endsection