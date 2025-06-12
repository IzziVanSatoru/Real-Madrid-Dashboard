<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID tidak ditemukan.');

$stmt = $pdo->prepare("SELECT * FROM pemain WHERE id = ?");
$stmt->execute([$id]);
$pemain = $stmt->fetch();

if (!$pemain) exit('Data tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama   = $_POST['nama'];
  $posisi = $_POST['posisi'];
  $negara = $_POST['negara'];
  $musim  = $_POST['musim'];

  $update = $pdo->prepare("UPDATE pemain SET nama=?, posisi=?, negara=?, musim=? WHERE id=?");
  $update->execute([$nama, $posisi, $negara, $musim, $id]);

  echo "<script>
    Swal.fire('Berhasil', 'Data pemain diperbarui', 'success')
      .then(() => window.location.href = 'pemain.php');
  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Pemain</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
  <div class="max-w-xl mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">✏️ Edit Pemain</h1>
    <form method="POST" class="space-y-4 bg-white p-6 shadow-xl rounded-xl border border-yellow-300">
      <input type="text" name="nama" value="<?= $pemain['nama'] ?>" required class="w-full p-2 border rounded">
      <input type="text" name="posisi" value="<?= $pemain['posisi'] ?>" required class="w-full p-2 border rounded">
      <input type="text" name="negara" value="<?= $pemain['negara'] ?>" required class="w-full p-2 border rounded">
      <input type="text" name="musim" value="<?= $pemain['musim'] ?>" required class="w-full p-2 border rounded">
      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Update</button>
    </form>
    <a href="pemain.php" class="inline-block mt-4 text-blue-600 hover:underline">← Kembali</a>
  </div>
</body>
</html>
