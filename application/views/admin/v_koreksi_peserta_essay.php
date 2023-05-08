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

            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">

                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Peserta</th>
                                <th>Nama Ujian</th>
                                <th>Koreksi Ujian</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($peserta as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row->nama_siswa; ?></td>
                                    <td><?php echo $row->nama_mapel_essay; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default-<?php echo $row->id_siswa; ?>">Koreksi Jawaban <?php echo $row->nama_mapel_essay; ?></button>

                                        <!-- /. modal  -->
                                        <div class="modal fade" id="modal-default-<?php echo $row->id_siswa; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <center>
                                                            <h4 class="modal-title">Koreksi Jawaban </h4>
                                                        </center>
                                                    </div>
                                                    <!-- /.form dengan modal -->s
                                                    <form method="post" action="<?php echo base_url() . 'koreksi_peserta_essay/nilai_aksi'; ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Jawaban Peserta</label>
                                                                <textarea class="form-control" name="jawaban_peserta" placeholder="Masukkan jawaban peserta" required=""></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Nilai Jawaban</label>
                                                                <input type="text" class="form-control" name="nilai_jawaban" placeholder="Masukkan nilai jawaban" required="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_peserta" value="<?php echo $row->id_siswa; ?>">
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