<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Posisi Pemain</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

  <div class="max-w-4xl mx-auto p-8">
    <h1 class="text-3xl font-bold text-center mb-6 text-yellow-600">🛡️ Posisi Pemain Real Madrid</h1>

    <table class="w-full border shadow-xl rounded-xl overflow-hidden bg-white">
      <thead class="bg-yellow-200 text-yellow-900 text-sm uppercase tracking-widest">
        <tr>
          <th class="py-3 px-4 text-left">Posisi</th>
          <th class="py-3 px-4">Jumlah Pemain</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = $pdo->query("SELECT posisi, COUNT(*) as jumlah FROM pemain GROUP BY posisi");
        foreach ($query as $row): ?>
          <tr class="border-b hover:bg-yellow-50">
            <td class="py-3 px-4"><?= $row['posisi'] ?></td>
            <td class="py-3 px-4 font-semibold text-yellow-800"><?= $row['jumlah'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
