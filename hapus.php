<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('ID tidak valid.');

$stmt = $pdo->prepare("DELETE FROM pemain WHERE id = ?");
$stmt->execute([$id]);

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
  Swal.fire('Dihapus!', 'Data pemain berhasil dihapus.', 'success')
    .then(() => window.location.href = 'pemain.php');
</script>";
