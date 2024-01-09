<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stock</title>
    <style>
        /* Styling untuk header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 200px; /* Sesuaikan ukuran gambar */
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .header .address {
            font-size: 14px;
        }

        /* Styling untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo"> <!-- Ganti path_to_your_logo.png dengan path gambar logo Anda -->
        <h1>Luisoft Store</h1>
        <p>JJl. Gajah Mada, Kepuharjo, Kec. Lumajang, Kabupaten Lumajang, Jawa Timur 67316, Indonesia</p>
        <p class="address">Email: info@luisoft.com | Telp: 033-429-0315</p>
        <!-- Informasi alamat dan kontak lainnya -->
    </div>

    <!-- Tabel data -->
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Product</th>
                <th>Harga</th>
                <th>Stok awal</th>
                <th>Stok saat ini</th>
                <th>Stok terjual</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $product->name }}</td>
                    <td>@rupiah($product->price)</td>
                    <td>{{$product->quantity + $product->total_sold}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->total_sold}}</td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr class="border">
                <td class="font-weight-bold" colspan="3">Total Stock</td>
                <td class="font-weight-bold">{{ $products->sum('quantity') + $products->sum('total_sold') }}</td>
                <td class="font-weight-bold">{{ $products->sum('quantity') }}</td>
                <td class="font-weight-bold">{{ $products->sum('total_sold') }}</td>
            </tr>
          </tfoot>
    </table>

    <div class="footer">
        <!-- Tambahkan footer jika diperlukan -->
    </div>
</body>
</html>
