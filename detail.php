<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  echo "ID tidak ditemukan.";
  exit;
}

// Ambil data pemain & trofinya
$stmt = $pdo->prepare("
  SELECT p.id, p.nama, p.posisi, p.negara, p.musim, 
         t.nama_trofi, t.musim AS musim_trofi
  FROM pemain p
  LEFT JOIN trofi t ON p.id = t.pemain_id
  WHERE p.id = ?
");
$stmt->execute([$id]);
$data = $stmt->fetchAll();

if (empty($data)) {
  echo "Data tidak ditemukan.";
  exit;
}

$pemain = $data[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Pemain - <?= htmlspecialchars($pemain['nama']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-4xl font-bold text-center text-yellow-600 mb-4">👑 Detail Pemain</h1>

    <div class="bg-white shadow-xl rounded-xl p-6 border border-yellow-300">
      <h2 class="text-2xl font-semibold text-yellow-700 mb-4"><?= htmlspecialchars($pemain['nama']) ?></h2>
      <ul class="space-y-2 text-gray-700">
        <li><strong>Posisi:</strong> <?= htmlspecialchars($pemain['posisi']) ?></li>
        <li><strong>Negara:</strong> <?= htmlspecialchars($pemain['negara']) ?></li>
        <li><strong>Musim Bergabung:</strong> <?= htmlspecialchars($pemain['musim']) ?></li>
      </ul>

      <hr class="my-6 border-t-2 border-yellow-300">

      <h3 class="text-xl font-bold text-yellow-600 mb-2">🏆 Trofi yang Dimenangkan</h3>
      <?php if (count($data) > 0 && $pemain['nama_trofi']): ?>
        <ul class="list-disc list-inside space-y-1 text-gray-800">
          <?php foreach ($data as $trofi): ?>
            <?php if ($trofi['nama_trofi']): ?>
              <li><?= htmlspecialchars($trofi['nama_trofi']) ?> (<?= $trofi['musim_trofi'] ?>)</li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-gray-500">Belum ada trofi tercatat untuk pemain ini.</p>
      <?php endif; ?>
    </div>

    <div class="mt-6 text-center">
      <a href="pemain.php" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg shadow-md transition">← Kembali ke Daftar Pemain</a>
    </div>
  </div>

</body>
</html>
