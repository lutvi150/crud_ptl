<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class Report extends Controller
{
    function template($head, $body)
    {
        $config = [
            'orientation' => 'L',
        ];
        $mpdf = new \Mpdf\Mpdf($config);
        $html = '   <html>
<head>
    <style>
        body { font-family: sans-serif; }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Produk</h1>
    <table>
        <thead>
            <tr>
                ' . $head . '
            </tr>
        </thead>
        <tbody>' . $body . '
        </tbody>
    </table>
</body>
</html>';
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    function report_produk()
    {
        $config = [
            'orientation' => 'L',
        ];
        $data = Product::with('category')->get();
        $head = '
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Kategori</th>';
        $html = '';
        foreach ($data as $key => $row) {
            $html .= '<tr>
                <td>' . $key + 1 . '</td>
                <td>' . $row->name . '</td>
                <td>' . $row->description . '</td>
                <td>Rp. ' . number_format($row->price) . '</td>
                <td>' . $row->category->name . '</td>
            </tr>';
        }
        $this->template($head, $html);
    }
    function report_customer()
    {

        $data = Customer::all();
        $head = '
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>';
        $html = '';
        foreach ($data as $key => $row) {
            $html .= '<tr>
                <td>' . $key + 1 . '</td>
                <td>' . $row->name . '</td>
                <td>' . $row->email . '</td>
                <td>Rp. ' . $row->phone . '</td>
                <td>' . $row->address . '</td>
            </tr>';
        }
        $this->template($head, $html);
    }
    function report_transaksi()
    {
        $data = Transaction::with(['customer', 'product'])->get();
        $head = '
        <th>No.</th>
        <th>Name</th>
        <th>Address</th>
        <th>Nama Produk</th>
        <th>Deskripi Produk</th>
        <th>Total Harga</th>
        <th>Tanggal Transaksi</th>
        ';
        $html = '';
        foreach ($data as $key => $row) {
            $html .= '<tr>
                <td>' . $key + 1 . '</td>
                <td>' . $row->customer->name . '<br>' . $row->customer->email . '<br>' . $row->customer->phone . '</td>
                <td>' . $row->customer->address . '</td>
                <td>' . $row->product->name . '</td>
                <td>' . $row->product->description . '</td>
                <td>' . $row->total_price . '</td>
                <td>' . $row->transaction_date . '</td>
            </tr>';
        };
        $this->template($head, $html);
    }
    function report_category()
    {
        $data = Category::all();
        $head = '
        <th>No.</th>
        <th>Kategori</th>
        <th>Deskripsi</th>';
        $html = '';
        foreach ($data as $key => $row) {
            $html .= '<tr>
                <td>' . $key + 1 . '</td>
                <td>' . $row->name . '</td>
                <td>' . $row->description . '</td>
            </tr>';
        };
        $this->template($head, $html);
    }
}
