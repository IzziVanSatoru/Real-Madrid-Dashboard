<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama   = $_POST['nama'];
  $posisi = $_POST['posisi'];
  $negara = $_POST['negara'];
  $musim  = $_POST['musim'];

  $stmt = $pdo->prepare("INSERT INTO pemain (nama, posisi, negara, musim) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nama, $posisi, $negara, $musim]);

  echo "<script>
    Swal.fire('Sukses!', 'Data pemain berhasil ditambahkan!', 'success')
      .then(() => window.location.href = 'pemain.php');
  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Pemain</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
  <div class="max-w-xl mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">➕ Tambah Pemain</h1>
    <form method="POST" class="space-y-4 bg-white p-6 shadow-xl rounded-xl border border-yellow-300">
      <input type="text" name="nama" placeholder="Nama Pemain" required class="w-full p-2 border rounded">
      <input type="text" name="posisi" placeholder="Posisi" required class="w-full p-2 border rounded">
      <input type="text" name="negara" placeholder="Negara" required class="w-full p-2 border rounded">
      <input type="text" name="musim" placeholder="Musim (contoh: 2024/2025)" required class="w-full p-2 border rounded">
      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Simpan</button>
    </form>
    <a href="pemain.php" class="inline-block mt-4 text-blue-600 hover:underline">← Kembali</a>
  </div>
</body>
</html>
