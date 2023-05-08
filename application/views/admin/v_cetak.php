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
						<span> <b> PT. NIHON SEIKI INDONESIA </b> <br><br> Jl. Angsana Raya No.2, Sukaresmi, Cikarang Sel., Kabupaten Bekasi, Jawa Barat 17550</span>
						<hr>
					</td>
				</tr>
			</table>
			<section class="content-header">
				<h3 align="center">Laporan Hasil Ujian</h3>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<table border="1" cellpadding="5px" cellspacing="0px" style="font-size:11;" width="100%">
							<thead align="center" style="background-color:#D3D3D3">
								<tr>
									<th width="1%">No</th>
									<th>Nama Peserta</th>
									<th>NIS</th>
									<th>Nama Ujian</th>
									<th width="20%">Waktu Ujian</th>
									<th>Jenis Ujian</th>
									<th>Benar</th>
									<th>Salah</th>
									<th>Nilai</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody style="font-size:9;">
								<?php
								$no = 1;
								foreach ($cetak as $d) {
								?>
									<tr align="center">
										<td><?php echo $no++; ?></td>
										<td><?php echo $d->nama_siswa; ?></td>
										<td><?php echo $d->nis; ?></td>
										<td><?php echo $d->nama_matapelajaran; ?></td>
										<td><?php echo date('d-m-Y', strtotime($d->tanggal_ujian)); ?> | <?php echo date('H:i:s', strtotime($d->jam_ujian)); ?></td>
										<td><?php echo $d->jenis_ujian; ?></td>
										<td>
											<?php
											if ($d->benar == '') {
												echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
											} else {
												echo $d->benar;
											}
											?>
										</td>
										<td>
											<?php
											if ($d->salah == '') {
												echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
											} else {
												echo $d->salah;
											}
											?>
										</td>
										<td>
											<?php
											if ($d->nilai == '') {
												echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
											} else {
												echo $d->nilai;
											}
											?>
										</td>
										<td>
											<div class="keterangan">
												<?php
												if ($d->nilai == '') {
													echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
												} else {
													if ($d->nilai >= 75) {
														echo "<span class='label label-success'>LULUS</span>";
													} else {
														echo "<span class='label label-danger'>TIDAK LULUS</span>";
													}
												}
												?>
											</div>
										</td>
									</tr>
								<?php }	?>
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