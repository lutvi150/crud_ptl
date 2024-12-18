@extends('template.template')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4 class="card-title mb-0">Daftar Kamar</h4>
              <div class="dropdown">
              </div>
            </div>
            <div class="card-body card-data-kamar">
              <div class="table-responsive">
                <button onclick="show_data('add')" type="button" class="btn btn-success mb-2"><i class="fa fa-plus"></i>Tambah Data Kamar</button>
                <table class="table table-bordered table-data-kamar">
                  <thead>
                      <th>No.</th>
                      <th>Nama Kamar</th>
                      <th>Harga Kamar</th>
                      <th>Fasilitas</th>
                      <th>
                          Aksi
                      </th>
                  </thead>
                  <tbody class="data-kamar">
                      <tr hidden>
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
        </div>
        <div class="card-body card-add-kamar" hidden>
          <form action="" id="form-data-kamar" method="post">
              <div class="form-group">
                  <label for="">Nama Kamar</label>
                  <input type="text" name="nama_kamar" id="nama_kamar" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted e_nama_kamar"></small>
              </div>
              <div class="form-group">
                  <label for="">Harga Kamar</label>
                  <input type="text" name="harga_kamar" id="harga_kamar" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted e_harga_kamar"></small>
              </div>
              <div class="form-group">
                  <label for="">Fasilitas Kamar</label>
                  <input type="text" name="fasilitas" id="fasilitas" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted e_fasilitas"></small>
              </div>
              <button type="button" onclick="save_data_kamar()" class="btn btn-success mt-2"><i class="fa fa-save"></i> Simpan Data</button>
              <button type="button" onclick="show_data('show')" class="btn btn-info mt-2"><i class="fa fa-reply"></i> Kembali</button>
          </form>
      </div>
      </div>
    </div>
    <!-- / Content -->

</div>
@endsection
@section('script')
<script>
   $(document).ready(function() {
        sessionStorage.setItem('id_kamar', null);
        get_data_kamar();
    });
    get_data_kamar = () => {
        $(".text-muted").text("");
        Notiflix.Block.arrows('.table-data-kamar', 'Loading...');
        $.ajax({
            type: "GET",
            url: url+"/api/kamar",
            dataType: "JSON",
            success: function(response) {
                Notiflix.Block.remove('.table-data-kamar');
                if (response.status == 'success') {
                    let html = "";
                    $.each(response.data, function(i, v) {
                        html += `<tr>
                            <td>${i+1}</td>
                            <td>${v.nama_kamar}</td>
                            <td>${counrencyFormat(v.harga_kamar)}</td>
                            <td>${v.fasilitas}</td>
                            <td>
                                <button type="button" onclick="edit_data_kamar(${v.id_kamar})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                <button type="button" onclick="delete_kamar(${v.id_kamar})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
                    });
                    $(".data-kamar").html(html);
                }else{
                    $.each(response.error, function (indexInArray, valueOfElement) { 
                         $(".e_"+indexInArray).text(valueOfElement);
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    counrencyFormat = (num) => {
        return "Rp " + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    delete_kamar = (id) => {
        Notiflix.Confirm.show(
            'Konfirmasi Hapus',
            'Apakah kamu yakin ingin menghapus data ini?',
            'Ya',
            'Tidak',
            function okCb() {
                Notiflix.Loading.dots('Loading...');
                $.ajax({
                    type: "GET",
                    url: url+"/api/kamar-delete/"+id,
                    dataType: "JSON",
                    success: function(response) {
                        Notiflix.Loading.remove();
                        if (response.status == 'success') {
                            Notiflix.Report.success('Berhasil', response.message);
                            get_data_kamar();
                        } else {
                            Notiflix.Report.failure('Gagal', response.message);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Notiflix.Loading.remove();
                        Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
                    }
                });
            },
            function cancelCb() {}, {},
        );
    }
    show_data = (comand) => {
        if (comand == "add") {
            sessionStorage.setItem('comand', 'add');
            $(".head-title").text("Tambah Data Kamar");
            $(".card-title").text("Tambah Data Kamar");
            $(".card-data-kamar").attr('hidden', true);
            $(".card-add-kamar").removeAttr('hidden');
            $("#form-data-kamar").trigger('reset');
        } else {
            sessionStorage.setItem('comand', 'show');
            $(".head-title").text("Data Kamar");
            $(".card-title").text("Data Kamar");
            $(".card-add-kamar").attr('hidden', true);
            $(".card-data-kamar").removeAttr('hidden');
            get_data_kamar();
        }
    }
    save_data_kamar = () => {
        let nama_kamar = $("#nama_kamar").val();
        let harga_kamar = $("#harga_kamar").val();
        let fasilitas = $("#fasilitas").val();
        if (nama_kamar == "" || harga_kamar == "" || fasilitas == "") {
            Notiflix.Notify.failure('Form tidak boleh kosong');
        } else {
            Notiflix.Loading.dots('Processing...');
            $.ajax({
                type: "POST",
                url: url+"/api/kamar",
                data: {
                    id_kamar: sessionStorage.getItem('id_kamar'),
                    type: sessionStorage.getItem('comand'),
                    nama_kamar: nama_kamar,
                    harga_kamar: harga_kamar,
                    fasilitas: fasilitas
                },
                dataType: "JSON",
                success: function(response) {

                    Notiflix.Loading.remove();
                    if (response.status == 'success') {
                        $("#form-data-kamar").trigger('reset');
                        Notiflix.Report.success('Berhasil', response.message);
                        show_data('show');
                    } else {
                        Notiflix.Report.failure('Gagal', response.message);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Notiflix.Loading.remove();
                    Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
                }
            })
        }
    }
    edit_data_kamar = (id) => {
        Notiflix.Loading.dots('Loading...');
        sessionStorage.setItem('id_kamar', id);
        sessionStorage.setItem('comand', 'edit');
        $(".head-title").text("Edit Data Kamar");
        $(".card-title").text("Edit Data Kamar");
        $(".card-data-kamar").attr('hidden', true);
        $(".card-add-kamar").removeAttr('hidden');
        $.ajax({
            type: "GET",
            url: url+"/api/kamar/"+id,
            dataType: "JSON",
            success: function(response) {
                Notiflix.Loading.remove();
                if (response.status == 'success') {
                    let data = response.data;
                    $("#nama_kamar").val(data.nama_kamar);
                    $("#harga_kamar").val(data.harga_kamar);
                    $("#fasilitas").val(data.fasilitas);
                    $(".card-data-kamar").attr('hidden', true);
                    $(".card-add-kamar").removeAttr('hidden');
                } else {
                    Notiflix.Report.failure('Gagal', response.message);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Notiflix.Loading.remove();
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        })
    }
</script>
@endsection