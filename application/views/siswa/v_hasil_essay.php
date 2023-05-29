<?php
$this->load->view('siswa/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('siswa/topbar');
$this->load->view('siswa/sidebar');
?>

<!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">


            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box box-header">
                    <center>
                        <h3 class="box-title">Hasil Ujian Essay</h3>
                    </center>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Peserta</th>
                                <th>NIK</th>
                                <th>Tanggal Ujian</th>
                                <th>Jam Ujian</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($hasil_essay as $d) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->nama_siswa; ?></td>
                                    <td><?php echo $d->nis; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($d->tanggal_ujian)); ?></td>
                                    <td><?php echo date('H:i:s', strtotime($d->jam_ujian)); ?></td>
                                    <td>
                                        <?php if ($d->status_ujian_ujian == 2) { ?>

                                            <!-- <?php echo $d->nilai_essay; ?> -->
                                            <?php
                                            $total_nilai = $this->db->select_sum('nilai')->where('id_peserta_essay', $d->id_peserta_essay)->get('tb_jawaban_essay')->row()->nilai;
                                            echo $total_nilai;
                                            ?>

                                        <?php } else { ?>
                                            <span class='btn btn-xs btn-default'>Belum Ujian</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($d->status_ujian_ujian == 2) { ?>
                                            <?php if ($d->nilai_essay >= 0 && $total_nilai >= 70) { ?>
                                                <span class='btn btn-xs btn-success'>Lulus</span>
                                            <?php } else { ?>
                                                <span class='btn btn-xs btn-danger'>Tidak Lulus</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span class='btn btn-xs btn-default'>Belum Ujian</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
</section><!-- /.content -->

<?php
$this->load->view('siswa/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
    $(function() {
        $('#data').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('siswa/foot');
?>