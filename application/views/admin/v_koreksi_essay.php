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
                        <h4 class="box-title">Koreksi Ujian Essay</h4>
                    </center>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Ujian</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id" required="">
                                    <option selected="selected" disabled="">- Pilih Nama Ujian -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_mapel_essay ?>"><?= $a->kode_mapel_essay; ?> | <?= $a->nama_mapel_essay; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('koreksi_essay'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
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

                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Peserta</th>
                                <th>Nama Ujian</th>
                                <th>Soal Essay</th>
                                <th>Jawaban Peserta</th>
                                <th>Koreksi Ujian</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($peserta as $p) { ?>
                                <?php foreach ($jawaban as $j) { ?>
                                    <?php if ($j->id_siswa == $p->id_siswa) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $p->nama_siswa; ?></td>
                                            <td>
                                                <?php echo $p->nama_mapel_essay; ?>
                                            </td>
                                            <td>
                                                <?php foreach ($soal as $s) { ?>
                                                    <?php if ($s->id_mapel_essay == $p->id_mapel_essay) { ?>
                                                        <?php echo $s->pertanyaan; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $j->jawaban; ?></td>
                                            <td> <a href="koreksi-ujian.php?id=" class="btn btn-primary">Koreksi</a></td>

                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
</section><!-- /.content -->

<!-- /. modal  -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center>
                    <h4 class="modal-title">Masukkkan Nilai Akhir Peserta</h4>
                </center>
            </div>
            <!-- /.form dengan modal -->
            <form method="post" action="<?php echo base_url() . 'koreksi_essay/nilai_aksi'; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nilai Akhir Peserta</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nilai Akhir Peserta" required="">
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <!-- /.tutup form dengan modal  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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