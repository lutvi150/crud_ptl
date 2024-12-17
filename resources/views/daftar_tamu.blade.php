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
                    src="{{asset('theme/assets/img/illustrations/man-with-laptop.png')}}"
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
@section('script')
<script>
 $(document).ready(function() {
        sessionStorage.setItem('id_tamu', null);
        get_data_tamu();
        get_data_kamar();
    });
    show_data = (action) => {
        if (action == 'add') {
            sessionStorage.setItem('action', 'add');
            $('.card-data-tamu').attr('hidden', true);
            $('.card-add-tamu').removeAttr('hidden');
            $('#form-data-tamu')[0].reset();
            $('#total_harga').val(0);
            $('#durasi').val(0);
            $(".head-title").text("Tambah Data Tamu");
            $(".card-title").text("Tambah Data Tamu");
            sessionStorage.setItem('id_tamu', null);
        } else {
            sessionStorage.setItem('action', 'show');
            $('.card-data-tamu').removeAttr('hidden');
            $('.card-add-tamu').attr('hidden', true);
            $(".head-title").text("Daftar Tamu");
            $(".card-title").text("Data Tamu");
            get_data_tamu();
        }
    }
    get_data_kamar_spesifik = () => {
        let id_kamar = $('#id_kamar').children("option:selected").val();
        $.ajax({
            type: "POST",
            url: "function/kamar.php",
            data: {
                action: "edit_kamar",
                id_kamar: id_kamar
            },
            dataType: "JSON",
            success: function(response) {
                let data = response.data;
                if (response.status == 'success') {
                    sessionStorage.setItem('harga_kamar', data.harga_kamar);
                    count_durasi();
                } else {
                    Notiflix.Report.Failure('Data Kamar', response.message, 'OK');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Report.Failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    get_data_kamar = () => {
        $.ajax({
            type: "POST",
            url: url+"api/kamar",
            dataType: "JSON",
            success: function(response) {
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `<option value="${item.id_kamar}">${item.nama_kamar} - ${item.harga_kamar}</option>`;
                    });
                    $('#id_kamar').html(html);
                } else {
                    Notiflix.Report.failure('Data Kamar', response.message, 'OK');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    get_data_tamu = () => {
        Notiflix.Block.arrows('.table-data-tamu', 'Loading...');
        $.ajax({
            type: "POST",
            url: url+"api/tamu",
            dataType: "JSON",
            success: function(response) {
                Notiflix.Block.remove('.table-data-tamu');
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
                            <td>${item.lama_menginap} Hari</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" onclick="edit_data('${item.id_tamu}')"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="delete_data('${item.id_tamu}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
                    });
                    $('.data-tamu').html(html);
                } else {
                    Notiflix.Report.failure('Data Tamu', response.message, 'OK');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    save_data = () => {
        let nama_tamu = $('#nama_tamu').val();
        let nomor_kontak = $('#nomor_kontak').val();
        let id_kamar = $('#id_kamar').children("option:selected").val();
        let tgl_in = $('#tgl_in').val();
        let tgl_out = $('#tgl_out').val();
        let durasi = $('#durasi').val();
        let total_harga = $('#total_harga').val();
        if (nama_tamu == '' || nomor_kontak == '' || id_kamar == '' || tgl_in == '' || tgl_out == '' || durasi == '' || total_harga == '') {
            Notiflix.Report.failure('Data Tamu', 'Data tidak boleh kosong', 'OK');
            return false;
        } else {
            Notiflix.Loading.dots('Processing...');
            let data = {
                action: "save_data_tamu",
                type: sessionStorage.getItem('action'),
                id_tamu: sessionStorage.getItem('id_tamu'),
                nama_tamu: nama_tamu,
                nomor_kontak: nomor_kontak,
                id_kamar: id_kamar,
                tgl_in: tgl_in,
                tgl_out: tgl_out,
                durasi: durasi,
                total_harga: total_harga
            };
            $.ajax({
                type: "POST",
                url: "function/tamu.php",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    Notiflix.Loading.remove();
                    if (response.status == 'success') {
                        Notiflix.Report.success('Data Tamu', response.message, 'OK', function() {
                            show_data('show');
                        });
                    } else {
                        Notiflix.Report.failure('Data Tamu', response.message, 'OK');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Notiflix.Loading.remove();
                    Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
                }
            });
        }
    }
    edit_data = (id_tamu) => {
        Notiflix.Loading.dots('Loading...');
        sessionStorage.setItem('action', 'edit');
        sessionStorage.setItem('id_tamu', id_tamu);
        $(".head-title").text("Edit Data Tamu");
        $(".card-title").text("Edit Data Tamu");
        $(".card-data-tamu").attr("hidden", true);
        $(".card-add-tamu").removeAttr("hidden");
        $.ajax({
            type: "POST",
            url: "function/tamu.php",
            data: {
                action: "edit_data_tamu",
                id_tamu: id_tamu
            },
            dataType: "JSON",
            success: function(response) {
                Notiflix.Loading.remove();
                let data = response.data;
                if (response.status == 'success') {
                    $('#nama_tamu').val(data.nama_tamu);
                    $('#nomor_kontak').val(data.nomor_kontak);
                    $('#id_kamar').val(data.id_kamar);
                    $('#tgl_in').val(data.tgl_in);
                    $('#tgl_out').val(data.tgl_out);
                    count_durasi();
                } else {
                    Notiflix.Report.failure('Data Tamu', response.message, 'OK');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Loading.remove();
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    delete_data = (id_tamu) => {
        Notiflix.Confirm.show(
            'Hapus Data Tamu',
            'Apakah anda yakin ingin menghapus data ini?',
            'Yes',
            'No',
            function() {
                Notiflix.Loading.dots('Processing...');
                $.ajax({
                    type: "POST",
                    url: "function/tamu.php",
                    data: {
                        action: "delete_data_tamu",
                        id_tamu: id_tamu
                    },
                    dataType: "JSON",
                    success: function(response) {
                        Notiflix.Loading.remove();
                        if (response.status == 'success') {
                            Notiflix.Report.success('Data Tamu', response.message, 'OK', function() {
                                get_data_tamu();
                            });
                        } else {
                            Notiflix.Report.failure('Data Tamu', response.message, 'OK');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Notiflix.Loading.remove();
                        Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
                    }
                });
            })
    }
    count_durasi = () => {
        let tgl_in = $('#tgl_in').val();
        let tgl_out = $('#tgl_out').val();
        let durasi = calculate_durasi(tgl_in, tgl_out);
        $('#durasi').val(durasi);
        let harga_kamar = parseInt(sessionStorage.getItem('harga_kamar'));
        let total_harga = harga_kamar * durasi;
        $('#total_harga').val(total_harga);
    }
    calculate_durasi = (tgl_in, tgl_out) => {
        let date1 = new Date(tgl_in);
        let date2 = new Date(tgl_out);
        let timeDiff = Math.abs(date2.getTime() - date1.getTime());
        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        return diffDays;
    }
</script>
@endsection