<?php
$this->load->view('admin/head');
?>
<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?= $this->session->flashdata('message'); ?>

            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">


                    <!-- /. modal  -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <center>
                                        <h4 class="modal-title">Tambah Jenis Ujian</h4>
                                    </center>
                                </div>
                                <!-- /.form dengan modal -->
                                <form method="post" action="<?php echo base_url() . 'mapel_essay/mapel_aksi'; ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Jenis Ujian </label>
                                            <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Mata Pelajaran" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Ujian</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Mata Pelajaran" required="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
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


                    <center>
                        <div class="box-title">Tambah Soal Essay</div>
                    </center>

                </div><!-- /.box-header -->
                <form action="<?= base_url('essay/insert'); ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="form-horizontal">


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Ujian</label>
                                <div class="col-sm-10">
                                    <select class="select2 form-control" name="nama_mapel_essay" required="">
                                        <option selected="selected" disabled="" value="">- Pilih Nama Ujian -</option>
                                        <?php foreach ($essay as $a) { ?>
                                            <option value="<?= $a->id_mapel_essay ?>"><?= $a->kode_mapel_essay; ?> | <?= $a->nama_mapel_essay; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- masukkan pertanyaan -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" rows="20" style="width: 100%" name="soal"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar"><b>Format Gambar harus .png dan .jpg!</b>
                                </div>
                            </div>

                            <!-- masukkan bobot soal -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bobot Soal</label>
                                <div class="col-sm-10">
                                    <textarea rows="1" style="width: 10%" name="kunci" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <a href="<?= base_url('essay_ujian') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-flat" title="Tambah Data Soal Essay"><span class="fa fa-save"></span> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->


<?php
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
    $(function() {
        $('#data-tables').dataTable();
    });

    $('.select2').select2();

    $('.alert-message').alert().delay(3000).slideUp('slow');

    //sumernote
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

<!-- summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.css" rel="stylesheet">

<!-- summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.js"></script>


<?php
$this->load->view('admin/foot');
?>