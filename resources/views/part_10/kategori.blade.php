@extends('part_10.layout.template')
@section('content')

<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Daftar Kategori</h6>
            </div>
            <div class="card-body p-3 card-data">
                <button onclick="show_data('add')" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah
                    Kategori</button>
                    <a href="{{ url('part-10/report-category') }}" target="_blank" class="btn btn-warning btn-sm mb-3"><i class="fa fa-print"></i> Cetak Laporan</a>
                <table class="table table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody class="body-data">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body card-add" hidden>
                <form action="" id="form-data" method="post">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error e_name"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" cols="30"
                            rows="10"></textarea>
                        <small id="helpId" class="text-error e_description"></small>
                    </div>
                    <button class="btn btn-success btn-sm" type="button" onclick="save_data()"><i
                            class="fa fa-save"></i> Simpan</button>
                    <button class="btn btn-primary btn-sm" type="button" onclick="show_data('show')"><i
                            class="fa fa-reply"></i> Kembali</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        get_data();
    });

    show_data = (action) => {
        if (action == 'add') {
            sessionStorage.setItem('action', 'add');
            $('.card-data').attr('hidden', true);
            $('.card-add').removeAttr('hidden');
            $('#form-data')[0].reset();
            $(".text-capitalize").text("Tambah Kategori Baru");
            sessionStorage.setItem('id_produk', null);
        } else {
            sessionStorage.setItem('action', 'show');
            $('.card-data').removeAttr('hidden');
            $('.card-add').attr('hidden', true);
            $(".text-capitalize").text("Daftar Kategori");
            get_data();
        }
    }
    save_data = () => {
        $(".text-error").text("");
        let name = $('#name').val();
        let description = $('#description').val();
        let action = sessionStorage.getItem('action');
        let id = sessionStorage.getItem('id');
        Notiflix.Block.hourglass('.card-add', 'Data Sedang Diproses...');
        let data = {
            name: name,
            description: description,
            action: action,
            id: id
        }
        $.ajax({
            type: "POST",
            url: url + "/api/category",
            data: data,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-add');
                if (response.status == 'success') {
                    Notiflix.Report.success('Data Category', response.message, 'OK', function () {
                        show_data('show');
                    });
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".e_" + indexInArray).text(valueOfElement);
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Block.remove('.card-add');
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });

    }
    get_data = () => {
        Notiflix.Block.hourglass('.card-data', 'Data Sedang Diproses...');
        $.ajax({
            type: "GET",
            url: url + "/api/category",
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-data');
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.description}</td>
                            <td> <button onclick="edit_data(${item.id})" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                <button onclick="delete_data(${item.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                        </tr>`;
                    });
                    $('.body-data').html(html);
                } else {
                    Notiflix.Report.failure('Data Produk', response.message, 'OK');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Block.remove('.card-data');
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    delete_data = (id) => {
        Notiflix.Confirm.show(
            'Konfirmasi Hapus',
            'Apakah kamu yakin ingin menghapus data ini?',
            'Ya',
            'Tidak',
            function okCb() {
                Notiflix.Loading.dots('Loading...');
                $.ajax({
                    type: "GET",
                    url: url + "/api/category-delete/" + id,
                    dataType: "JSON",
                    success: function (response) {
                        Notiflix.Loading.remove();
                        if (response.status == 'success') {
                            Notiflix.Report.success('Berhasil', response.message);
                            get_data();
                        } else {
                            Notiflix.Report.failure('Gagal', response.message);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Notiflix.Loading.remove();
                        Notiflix.Report.failure('Server Error', 'We cannot connect to the server.',
                            'OK');
                    }
                });
            },
            function cancelCb() {}, {},
        );
    }
    edit_data = (id) => {
        $(".text-error").text('');
        Notiflix.Loading.dots('Loading...');
        sessionStorage.setItem('id', id);
        sessionStorage.setItem('action', 'edit');
        $.ajax({
            type: "GET",
            url: url + "/api/category/" + id,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Loading.remove();
                if (response.status == 'success') {
                    sessionStorage.setItem('category_id', response.data.category_id);
                    let data = response.data;
                    $("#name").val(data.name);
                    $("#description").val(data.description);
                    $('.card-data').attr('hidden', true);
                    $('.card-add').removeAttr('hidden');
                    $(".text-capitalize").text("Edit Kategori");
                } else {
                    Notiflix.Report.failure('Gagal', response.message);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Loading.remove();
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        })
    }
</script>
@endsection