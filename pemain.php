<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Pemain - Real Madrid</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: linear-gradient(to bottom right, #fff, #f1f1f1); }
  </style>
</head>
<body class="text-gray-900 font-sans">

  <div class="max-w-6xl mx-auto p-8">
    <h1 class="text-4xl font-bold mb-6 text-center text-yellow-600">👑 Real Madrid Squad 2024/2025</h1>

    <div class="overflow-x-auto shadow-2xl rounded-xl border border-yellow-400">
      <table class="min-w-full text-sm text-center bg-white border border-gray-200">
        <thead class="bg-yellow-200 text-yellow-900 uppercase tracking-widest">
          <tr>
            <th class="py-3 px-4">#</th>
            <th class="py-3 px-4">Nama</th>
            <th class="py-3 px-4">Posisi</th>
            <th class="py-3 px-4">Negara</th>
            <th class="py-3 px-4">Musim</th>
            <th class="py-3 px-4">Trofi</th>
            <th class="py-3 px-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $pdo->query("
            SELECT 
              p.id, p.nama, p.posisi, p.negara, p.musim,
              COUNT(t.id) AS total_trofi
            FROM pemain p
            LEFT JOIN trofi t ON p.id = t.pemain_id
            WHERE p.musim = '2024/2025'
            GROUP BY p.id
            ORDER BY total_trofi DESC
          ");

          foreach ($query as $i => $row): ?>
            <tr class="border-b hover:bg-yellow-50">
              <td class="py-3 px-4"><?= $i + 1 ?></td>
              <td class="py-3 px-4 font-semibold"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="py-3 px-4"><?= $row['posisi'] ?></td>
              <td class="py-3 px-4"><?= $row['negara'] ?></td>
              <td class="py-3 px-4"><?= $row['musim'] ?></td>
              <td class="py-3 px-4 text-yellow-700 font-bold"><?= $row['total_trofi'] ?></td>
              <td class="py-3 px-4">
                <a href="detail.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:underline">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
