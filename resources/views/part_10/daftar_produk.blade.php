@extends('part_10.layout.template')
@section('content')

<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Daftar Produk</h6>
            </div>
            <div class="card-body p-3 card-data-produk">
                <button onclick="show_data('add')" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah
                    Produk Baru</button>
                    <a href="{{ url('part-10/report-produk') }}" target="_blank" class="btn btn-warning btn-sm mb-3"><i class="fa fa-plus"></i> Cetak Laporan</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody class="body-produk">
                        <tr hidden>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button onclick="edit_data()" class="btn btn-warning btn-sm"><i
                                        class="fa fa-edit"></i></button>
                                <button onclick="delete_data()" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body card-add-produk" hidden>
                <form action="" id="form-produk" method="post">
                    <div class="form-group">
                        <label for="">Nama Produk</label>
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
                    <div class="form-group">
                        <label for="">Harga Produk</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error e_price"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Produk</label>
                        <select name="category" id="category" class="form-control">
                        </select>
                        <small id="helpId" class="text-error e_category"></small>
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
        get_produk();
        get_category();
    });
    get_category = () => {
        $.ajax({
            type: "GET",
            url: url + "/api/category",
            dataType: "JSON",
            success: function (response) {
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    let category_id = sessionStorage.getItem('category_id');
                    data.forEach((item, index) => {
                        html +=
                            `<option ${category_id==item.id?'selected':''} value="${item.id}">${item.name}</option>`;
                    });
                    $('#category').html(html);
                } else {
                    Notiflix.Report.failure('Data Kamar', response.message, 'OK');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    show_data = (action) => {
        if (action == 'add') {
            sessionStorage.removeItem('category_id');
            sessionStorage.setItem('action', 'add');
            $('.card-data-produk').attr('hidden', true);
            $('.card-add-produk').removeAttr('hidden');
            $('#form-produk')[0].reset();
            $(".text-capitalize").text("Tambah Produk Baru");
            sessionStorage.setItem('id_produk', null);
        } else {
            sessionStorage.setItem('action', 'show');
            $('.card-data-produk').removeAttr('hidden');
            $('.card-add-produk').attr('hidden', true);
            $(".text-capitalize").text("Daftar Produk");
            get_produk();
        }
    }
    save_data = () => {
        $(".text-error").text("");
        let name = $('#name').val();
        let description = $('#description').val();
        let price = $('#price').val();
        let category = $('#category').children("option:selected").val();
        let id = sessionStorage.getItem('id_produk');
        let action = sessionStorage.getItem('action');
        Notiflix.Block.hourglass('.card-add-produk', 'Data Sedang Diproses...');
        let data = {
            name: name,
            description: description,
            price: price,
            category: category,
            id: id,
            action: action
        }
        $.ajax({
            type: "POST",
            url: url + "/api/produk",
            data: data,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-add-produk');
                if (response.status == 'success') {
                    Notiflix.Report.success('Data Produk', response.message, 'OK', function () {
                        show_data('show');
                    });
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".e_" + indexInArray).text(valueOfElement);
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Block.remove('.card-add-produk');
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });

    }
    get_produk = () => {
        Notiflix.Block.hourglass('.card-data-produk', 'Data Sedang Diproses...');
        $.ajax({
            type: "GET",
            url: url + "/api/produk",
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-data-produk');
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.description}</td>
                            <td>${counrencyFormat(item.price)}</td>
                            <td>${item.category.name}</td>
                            <td> <button onclick="edit_data(${item.id})" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                <button onclick="delete_data(${item.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                        </tr>`;
                    });
                    $('.body-produk').html(html);
                } else {
                    Notiflix.Report.failure('Data Produk', response.message, 'OK');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Block.remove('.card-data-produk');
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    counrencyFormat = (num) => {
        return "Rp " + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
                    url: url + "/api/produk-delete/" + id,
                    dataType: "JSON",
                    success: function (response) {
                        Notiflix.Loading.remove();
                        if (response.status == 'success') {
                            Notiflix.Report.success('Berhasil', response.message);
                            get_produk();
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
        sessionStorage.setItem('id_produk', id);
        sessionStorage.setItem('action', 'edit');
        $.ajax({
            type: "GET",
            url: url + "/api/produk/" + id,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Loading.remove();
                if (response.status == 'success') {
                    sessionStorage.setItem('category_id', response.data.category_id);
                    get_category();
                    let data = response.data;
                    $("#name").val(data.name);
                    $("#description").val(data.description);
                    $("#price").val(data.price);
                    $('.card-data-produk').attr('hidden', true);
                    $('.card-add-produk').removeAttr('hidden');
                    $(".text-capitalize").text("Edit Produk");
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