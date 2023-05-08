<!-- views/siswa/import.php -->
<form method="post" action="<?php echo base_url('siswa/import_process'); ?>" enctype="multipart/form-data">
    <input type="file" name="file_siswa">
    <button type="submit" name="import" class="btn btn-primary">Import Siswa</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Siswa</th>
            <th>ID Kelas</th>
            <th>Nama Siswa</th>
            <th>NIS</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $row) : ?>
            <tr>
                <td><?php echo $row->id_siswa; ?></td>
                <td><?php echo $row->id_kelas; ?></td>
                <td><?php echo $row->nama_siswa; ?></td>
                <td><?php echo $row->nis; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->password; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>