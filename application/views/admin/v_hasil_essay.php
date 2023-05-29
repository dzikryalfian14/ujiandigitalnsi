<?php
$this->load->view('admin/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <center>
                        <h4 class="box-title">Hasil Ujian Essay</h4>
                    </center>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Ujian</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id" required="">
                                    <option selected="selected" disabled="">- Pilih Jenis Ujian -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_mapel_essay ?>"><?= $a->kode_mapel_essay; ?> | <?= $a->nama_mapel_essay; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('hasil_ujian_essay'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
                                <button type="submit" class="btn btn-primary btn-flat" title="Filter Data Soal Ujian"><span class="fa fa-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </form>

            </div>

            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <a href="<?= base_url('hasil_ujian_essay/print_all') ?>" class="btn btn-primary btn-flat pull-right" target="_blank"><i class="fa fa-print"></i> Cetak Semua Hasil Ujian</a>

                    <!-- insert nilai -->

                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Peserta</th>
                                <th>NIK</th>
                                <th>Nama Ujian</th>
                                <th>Tanggal Ujian</th>
                                <th>Jam Ujian</th>
                                <th>Jenis Ujian</th>
                                <th>Nilai</th>
                                <th>Cetak</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total_nilai = 0;
                            // $total_nilai = 0;
                            foreach ($hasil_essay as $d) { ?>
                                <tr>
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
                                            <span class='btn btn-xs btn-default'>Belum Ujian</span>
                                        <?php } ?>
                                        <br>
                                        <!-- <a href="#" data-toggle="modal" data-target="#myModal<?php echo $d->id_peserta_essay; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span> Insert Nilai</a> -->

                                        <!-- Modal -->
                                        <div id="myModal<?php echo $d->id_peserta_essay; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Insert Nilai Manual</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo base_url() . 'hasil_ujian_essay/insert_nilai/' . $d->id_peserta_essay; ?>">
                                                            <div class="form-group">
                                                                <label for="nilai">Nilai:</label>
                                                                <input type="text" class="form-control" id="nilai" name="nilai" value="<?php echo $d->nilai_essay; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <?php
                                        if ($d->nilai_essay == '0' && $total_nilai == '0') {
                                            echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                        } else {
                                            echo "<a href='" . 'hasil_ujian_essay/cetak/' . "$d->id_peserta_essay' class='btn btn-xs btn-success' title='Cetak Hasil Ujian' target='_blank'><span class='fa fa-print'></span></a>";;
                                        }
                                        ?>
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
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
    $(function() {
        $('#data').dataTable();
        $('.select2').select2();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>