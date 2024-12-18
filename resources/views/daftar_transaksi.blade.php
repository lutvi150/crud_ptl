@extends('template.template')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Daftar Transaksi</h4>
                <div class="dropdown">
                </div>
              </div>
            <div class="card-body card-data-tamu">
              <table class="table table-bordered table-data-transaksi">
                <thead>
                    <th>No.</th>
                    <th>Nama Tamu</th>
                    <th>Nomor Kontak</th>
                    <th>Tgl Check In</th>
                    <th>Tgl Check Out</th>
                    <th>Jenis Kamar</th>
                    <th>Harga Sewa</th>
                    <th>Durasi Menginap</th>
                    <th>Total Biaya</th>
                </thead>
                <tbody class="data-transaksi">
                    <tr hidden>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                        </td>
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
  
  get_data_transaksi();
});
get_data_transaksi = () => {
  Notiflix.Block.arrows('.table-data-transaksi', 'Loading...');
  $.ajax({
      type: "GET",
      url: url+"/api/transaksi",
      dataType: "JSON",
      success: function(response) {
          let data = response.data;
          if (response.status == 'success') {
              let html = '';
              data.forEach((item, index) => {
                  html += `<tr>
                      <td>${index+1}</td>
                      <td>${item.nama_tamu}</td>
                      <td>${item.nomor_kontak}</td>
                      <td>${item.tgl_in}</td>
                      <td>${item.tgl_out}</td>
                      <td>${item.nama_kamar}</td>
                      <td>${counrencyFormat(item.harga_kamar)}/ Malam</td>
                      <td>${item.lama_menginap} Hari</td>
                      <td>${counrencyFormat(item.total_harga)}</td>
                  </tr>`;
              });
              $('.data-transaksi').html(html);
              Notiflix.Block.remove('.table-data-transaksi');
          } else {
              Notiflix.Report.failure('Data Transaksi', response.message, 'OK');
          }
      },
      error: function(xhr, ajaxOptions, thrownError) {
          Notiflix.Report.Failure('Server Error', 'We cannot connect to the server.', 'OK');
      }
  })
};
counrencyFormat = (num) => {
  return "Rp " + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection