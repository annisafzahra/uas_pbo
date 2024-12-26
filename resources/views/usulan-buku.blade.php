<!DOCTYPE html>
<html>
<head>
    <title>Usulan Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Form Usulan Buku</h1>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <label for="judul">Judul Buku:</label><br>
        <input type="text" name="judul" placeholder="Judul Buku" required><br><br>
        
        <label for="isbn">ISBN:</label><br>
        <input type="text" name="isbn" placeholder="ISBN Buku" required><br><br>
        
        <label for="penulis">Penulis:</label><br>
        <input type="text" name="penulis" placeholder="Penulis" required><br><br>
        
        <label for="penerbit">Penerbit:</label><br>
        <input type="text" name="penerbit" placeholder="Penerbit" required><br><br>
        
        <label for="tahun_terbit">Tahun Terbit:</label><br>
        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required><br><br>
        
        <label for="kategori">Kategori:</label><br>
        <input type="text" name="kategori" placeholder="Kategori Buku" required><br><br>
        
        <label for="pengusul_email">Email Pengusul:</label><br>
        <input type="email" name="pengusul_email" placeholder="Email Anda" required><br><br>
        
        <button type="submit">Kirim Usulan</button>
    </form>

    <h2>Daftar Usulan Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>ISBN</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Email Pengusul</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh Data -->
            <tr>
                <td>1</td>
                <td>Contoh Judul</td>
                <td>978-3-16-148410-0</td>
                <td>John Doe</td>
                <td>Contoh Penerbit</td>
                <td>2023</td>
                <td>Fiksi</td>
                <td>contoh.email@gmail.com</td>
            </tr>
            <!-- Data Usulan akan di-render di sini -->
            @foreach($usulanBuku as $index => $usulan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $usulan->judul }}</td>
                <td>{{ $usulan->isbn }}</td>
                <td>{{ $usulan->penulis }}</td>
                <td>{{ $usulan->penerbit }}</td>
                <td>{{ $usulan->tahun_terbit }}</td>
                <td>{{ $usulan->kategori }}</td>
                <td>{{ $usulan->pengusul_email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
