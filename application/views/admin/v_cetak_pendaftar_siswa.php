<!DOCTYPE html>
<html>

<head>
    <title>Cetak Hasil Ujian </title>
    <link rel="shortcut icon" href="image/logo nsi.jpg">
</head>

<body>
    <div class="container">
        <div class="content-wrapper">
            <img src="image/logo nsi.png" style="width: 65px; height: auto; position: absolute;">
            <link rel="shortcut icon" href="image/logo nsi.jpg">

            <table style="width: 100%;">
                <tr>
                    <td align="center">
                        <span> <b> PT. NIHON SEIKI INDONESIA </b> <br><br> Jl. Angsana Raya No.2, Sukaresmi, Cikarang Selatan, Kabupaten Bekasi, Jawa Barat 17550</span>
                        <hr>
                    </td>
                </tr>
            </table>
            <section class="content-header">
                <h3 align="center">Peserta Ujian PT. Nihon Seiki Indonesia</h3>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <table border="1" cellpadding="5px" cellspacing="0px" style="font-size:11;" width="100%">
                            <thead align="center" style="background-color:#D3D3D3">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>NIK</th>
                                    <th>Nama Peserta</th>
                                    <th>Ruangan</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:9;">x
                                <?php
                                $no = 1;
                                foreach ($cetak_siswa as $d) {
                                ?>
                                    <tr align="center">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d->nis; ?></td>
                                        <td><?php echo $d->nama_siswa; ?></td>
                                        <td><?php echo $d->id_kelas; ?></td>
                                        <td><?php echo $d->username; ?></td>
                                        <td><?php echo $d->password; ?></td>
                                    </tr>
                                <?php }    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section><br><br><br>
            <div align="center">
                <?php
                $date = Date("d/M/Y");
                $jam = Date("H:i:s");
                echo "<span>Laporan  peserta ujian dicetak pada tanggal $date Jam $jam</span>";
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>