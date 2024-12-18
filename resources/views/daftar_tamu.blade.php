@extends('template.template')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Daftar Tamu</h4>
                <div class="dropdown">
                </div>
              </div>
            <div class="card-body card-data-tamu">
                <button onclick="show_data('add')" type="button" class="btn btn-success mb-2"><i class="fa fa-plus"></i>Tambah Data Kamar</button>
                <table class="table table-bordered table-data-tamu">
                    <thead>
                        <th>No.</th>
                        <th>Nama Tamu</th>
                        <th>Nomor Kontak</th>
                        <th>Tgl Check In</th>
                        <th>Tgl Check Out</th>
                        <th>Durasi Menginap</th>
                        <th>
                            Aksi
                        </th>
                    </thead>
                    <tbody class="data-tamu">
                        <tr hidden>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body card-add-tamu" hidden>
                <form action="" id="form-data-tamu" method="post">
                    <div class="form-group">
                        <label for="">Nama Tamu</label>
                        <input type="text" name="nama_tamu" id="nama_tamu" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_nama_tamu"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Kontak</label>
                        <input type="text" name="nomor_kontak" id="nomor_kontak" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_nomor_kontak"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kamar</label>
                        <select name="id_kamar" onchange="get_data_kamar_spesifik()" id="id_kamar" class="form-control"></select>
                        <small id="helpId" class="text-muted e_id_kamar"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Check In</label>
                        <input type="date" onchange="count_durasi()" name="tgl_in" id="tgl_in" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_tgl_in"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Checkout</label>
                        <input type="date" onchange="count_durasi()" name="tgl_out" id="tgl_out" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_tgl_out"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Durasi Menginap</label>
                        <input type="text" disabled name="durasi" id="durasi" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_durasi"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga</label>
                        <input type="text" readonly disabled name="total_harga" id="total_harga" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted e_total_harga"></small>
                    </div>

                    <button type="button" onclick="save_data()" class="btn btn-success mt-2"><i class="fa fa-save"></i> Simpan Data</button>
                    <button type="button" onclick="show_data('show')" class="btn btn-info mt-2"><i class="fa fa-reply"></i> Kembali</button>
                </form>
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
            type: "GET",
            url: url+"/api/kamar/"+id_kamar,
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
            type: "GET",
            url: url+"/api/kamar",
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
            type: "GET",
            url: url+"/api/tamu",
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
                url: url+"/api/tamu",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    Notiflix.Loading.remove();
                    if (response.status == 'success') {
                        Notiflix.Report.success('Data Tamu', response.message, 'OK', function() {
                            show_data('show');
                        });
                    } else {
                        $.each(response.errors, function (indexInArray, valueOfElement) { 
                             $(".e-"+indexInArray).text(valueOfElement);
                        });
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
            type: "GET",
            url: url+"/api/tamu/"+id_tamu,
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
                    $("#durasi").val(response.transaksi.lama_menginap);
                    $("#total_harga").val(response.transaksi.total_harga);
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
                    type: "GET",
                    url: url+"/api/tamu-delete/"+id_tamu,
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