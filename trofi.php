<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Trofi - Real Madrid</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: linear-gradient(to bottom right, #fff, #f9f9f9); }
  </style>
</head>
<body class="text-gray-900 font-sans">

  <div class="max-w-6xl mx-auto p-8">
    <h1 class="text-4xl font-bold mb-6 text-center text-yellow-600">🏆 Trofi Pemain Real Madrid</h1>

    <div class="overflow-x-auto shadow-2xl rounded-xl border border-yellow-400">
      <table class="min-w-full text-sm text-center bg-white border border-gray-200">
        <thead class="bg-yellow-200 text-yellow-900 uppercase tracking-widest">
          <tr>
            <th class="py-3 px-4">#</th>
            <th class="py-3 px-4">Nama Pemain</th>
            <th class="py-3 px-4">Trofi</th>
            <th class="py-3 px-4">Musim</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $pdo->query("
            SELECT 
              t.id,
              p.nama AS nama_pemain,
              t.nama_trofi,
              t.musim
            FROM trofi t
            INNER JOIN pemain p ON t.pemain_id = p.id
            ORDER BY t.musim DESC, p.nama ASC
          ");

          foreach ($query as $i => $row): ?>
            <tr class="border-b hover:bg-yellow-50">
              <td class="py-3 px-4"><?= $i + 1 ?></td>
              <td class="py-3 px-4 font-semibold"><?= htmlspecialchars($row['nama_pemain']) ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($row['nama_trofi']) ?></td>
              <td class="py-3 px-4"><?= $row['musim'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
