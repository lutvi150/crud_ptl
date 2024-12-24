@extends('part_10.layout.template')
@section('content')

<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Daftar Transaksi</h6>
            </div>
            <div class="card-body p-3 card-data">
                <button onclick="show_data('add')" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah
                    Transaksi</button>
                <table id="data-table" class="table table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Nama Produk</th>
                        <th>Deskripi Produk</th>
                        <th>Total Harga</th>
                        <th>Tanggal Transaksi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody class="body-data">
                        <tr>
                            <td></td>
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
                        <label for="">Pilih Customer</label>
                        <select name="customer_id" class="form-control" id="customer_id"></select>
                        <small id="helpId" class="text-error e_customer_id"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Produk</label>
                        <select name="product_id" class="form-control" onchange="get_spesifik_product()" id="product_id"></select>
                        <small id="helpId" class="text-error e_product_id"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga</label>
                        <input type="text" name="total_price" readonly id="total_price" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error e_total_price"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="transaction_date" id="transaction_date">
                        <small id="helpId" class="text-error e_address"></small>
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
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    $('#data-table').DataTable( {
    responsive: true
} );
    $(document).ready(function () {
        get_data();
    });
    get_customer = () => {
        $.ajax({
            type: "GET",
            url: url + "/api/customer",
            dataType: "JSON",
            success: function (response) {
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    let customer_id = sessionStorage.getItem('customer_id');
                    data.forEach((item, index) => {
                        html +=`<option ${customer_id==item.id?'selected':''} value="${item.id}">${item.name}</option>`;
                    });
                    $('#customer_id').html(html);
                } else {
                    Notiflix.Report.failure('Data Customer', response.message, 'OK');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    get_product = () => {
        $.ajax({
            type: "GET",
            url: url + "/api/produk",
            dataType: "JSON",
            success: function (response) {
                let data = response.data;
                if (response.status == 'success') {
                    let html = ''; 
                    let product_id = sessionStorage.getItem('product_id');
                    data.forEach((item, index) => {
                        html +=`<option ${product_id==item.id?'selected':''} value="${item.id}">${item.name}</option>`;
                    });
                    $('#product_id').html(html);
                } else {
                    Notiflix.Report.failure('Data Produk', response.message, 'OK');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Notiflix.Report.failure('Server Error', 'We cannot connect to the server.', 'OK');
            }
        });
    }
    get_spesifik_product=()=>{
        let id=$("#product_id").children("option:selected").val();
        $.ajax({
            type: "GET",
            url: url + "/api/produk/" + id,
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'success') {
                    $("#total_price").val(response.data.price);
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
    show_data = (action) => {
        if (action == 'add') {
            get_customer();
            get_product();
            sessionStorage.setItem('action', 'add');
            sessionStorage.removeItem('customer_id');
            sessionStorage.removeItem('product_id');
            $('.card-data').attr('hidden', true);
            $('.card-add').removeAttr('hidden');
            $('#form-data')[0].reset();
            $(".text-capitalize").text("Tambah Transaksi");
            sessionStorage.setItem('id', null);
            
        } else {
            sessionStorage.setItem('action', 'show');
            $('.card-data').removeAttr('hidden');
            $('.card-add').attr('hidden', true);
            $(".text-capitalize").text("Daftar Transaksi");
            get_data();
        }
    }
    save_data = () => {
        $(".text-error").text("");
        Notiflix.Block.hourglass('.card-add', 'Data Sedang Diproses...');
        let data = {
            customer_id: $("#customer_id").children("option:selected").val(),
            product_id: $("#product_id").children("option:selected").val(),
            total_price: $("#total_price").val(),
            transaction_date: $("#transaction_date").val(),
            action: sessionStorage.getItem('action'),
            id: sessionStorage.getItem('id'),
        }
        $.ajax({
            type: "POST",
            url: url + "/api/transaksi-mobil",
            data: data,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-add');
                if (response.status == 'success') {
                    Notiflix.Report.success('Data Transaksi', response.message, 'OK', function () {
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
            url: url + "/api/transaksi-mobil",
            dataType: "JSON",
            success: function (response) {
                Notiflix.Block.remove('.card-data');
                let data = response.data;
                if (response.status == 'success') {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.customer.name} </br>${item.customer.email} </br> ${item.customer.phone}</td>
                            <td>${item.customer.address}</td>
                            <td>${item.product.name}</td>
                            <td>${item.product.description}</td>
                            <td>${item.total_price}</td>
                            <td>${item.transaction_date}</td>
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
                    url: url + "/api/transaksi-mobil-delete/" + id,
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
            url: url + "/api/transaksi-mobil/" + id,
            dataType: "JSON",
            success: function (response) {
                Notiflix.Loading.remove();
                if (response.status == 'success') {
                    sessionStorage.setItem('id', response.data.id);
                    sessionStorage.setItem('customer_id', response.data.customer_id);
                    sessionStorage.setItem('product_id', response.data.product_id);
                    let data = response.data;
                    get_product();
                    get_customer();
                    $("#name").val(data.name);
                    $("#description").val(data.description);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                    $("#address").val(data.address);
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