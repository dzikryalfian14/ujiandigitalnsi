<!DOCTYPE html>
<html>

<head>
    <title>Cetak Hasil Ujian </title>
    <link rel="shortcut icon" href="image/logo nsi.jpg">
</head>

<body>
    <div class="container">
        <div class="content-wrapper">
            <img src="assets/logo_nsi.jpg" style="width: 65px; height: auto; position: absolute;">
            <link rel="shortcut icon" href="assets/logo_nsi.jpg">
            

            <table style="width: 100%;">
                <tr>
                    <td align="center">
                        <span> <b> PT. NIHON SEIKI INDONESIA </b> <br><br> Jl. Angsana Raya No.2, Sukaresmi, Cikarang Selatan, Kabupaten Bekasi, Jawa Barat 17550</span>
                        <hr>
                    </td>
                </tr>
            </table>
            <section class="content-header">
                <h3 align="center">Laporan Hasil Ujian Masuk Berbasis Essay</h3>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <table border="1" cellpadding="5px" cellspacing="0px" style="font-size:11;" width="100%">
                            <thead align="center" style="background-color:#D3D3D3">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama Peserta</th>
                                    <th>NIK</th>
                                    <th>Nama Ujian</th>
                                    <th width="20%">Tanggal Ujian</th>
                                    <th width="20%">Waktu Ujian</th>
                                    <th>Jenis Ujian</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:9;">x
                                <?php
                                $no = 1;
                                foreach ($cetak_essay as $d) {
                                ?>
                                    <tr align="center">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d->nama_siswa; ?></td>
                                        <td><?php echo $d->nis; ?></td>
                                        <td><?php echo $d->nama_mapel_essay; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($d->tanggal_ujian)); ?></td>
                                        <td><?php echo date('H:i:s', strtotime($d->jam_ujian)); ?></td>
                                        <td><?php echo $d->jenis_ujian_essay; ?></td>
                                        <td>
                                            <?php if ($d->status_ujian_ujian == 2) { ?>

                                                <!-- <?php echo $d->nilai_essay; ?> -->
                                                <?php
                                                $total_nilai = $this->db->select_sum('nilai')->where('id_peserta_essay', $d->id_peserta_essay)->get('tb_jawaban_essay')->row()->nilai;
                                                echo $total_nilai;
                                                ?>

                                            <?php } else { ?>
                                                <span class='btn btn-xs btn-default'>Belum di Nilai</span>
                                            <?php } ?>

                                        <td>
                                            <?php if ($d->status_ujian_ujian == 2) { ?>
                                                <?php if ($d->nilai_essay >= 70 && $total_nilai >= 70) { ?>
                                                    <span class='btn btn-xs btn-success'>Lulus</span>
                                                <?php } else { ?>
                                                    <span class='btn btn-xs btn-danger'>Tidak Lulus</span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span class='btn btn-xs btn-default'>Belum Ujian</span>
                                            <?php } ?>
                                        </td>
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
                echo "Laporan dicetak pada tanggal $date Jam $jam";
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>