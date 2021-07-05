<!DOCTYPE html>
<head>
    <title></title>
</head><body>

    <h3 style="text-align: center">DAFTAR PEMINJAMAN</h3>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nomor Jari</th>
            <th>Ruangan</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
        </tr>

        <?php
        $no = 1;
        foreach($peminjaman as $pinjam): ?>

        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $pinjam->id ?></td>
            <td><?php echo $pinjam->nomor_jari ?></td>
            <td><?php echo $pinjam->ruangan ?></td>
            <td><?php echo $pinjam->waktu_masuk ?></td>
            <td><?php echo $pinjam->waktu_keluar ?></td>
        </tr>

        <?php endforeach; ?>
    </table>
</body></html>