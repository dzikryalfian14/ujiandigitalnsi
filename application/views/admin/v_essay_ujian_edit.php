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
            <!-- Tampilan untuk alert -->
            <?php foreach ($essay as $s) { ?>
                <!-- TUTUP Tampilan untuk alert -->
                <div class="box box-success" style="overflow-x: scroll;">
                    <form action="<?= base_url('essay_ujian/update'); ?>" method="post">
                        <div class="box-header">
                            <center>
                                <h4 class="box-title">Edit Data</h4>
                            </center>
                            <p>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Ujian</label>
                                    <input type="hidden" name="id" value="<?= $s->id_soal_essay ?>">
                                    <div class="col-sm-10">
                                        <select class="select2 form-control" name="nama_mapel_essay" required="">
                                            <option selected="selected" disabled="">- Pilih Nama Ujian -</option>
                                            <?php foreach ($kelas as $a) { ?>
                                                <option value="<?= $a->id_mapel_essay ?>" <?php if ($s->nama_mapel_essay == $a->nama_mapel_essay) {
                                                                                                echo "selected='selected'";
                                                                                            } ?>><?= $a->kode_mapel_essay; ?> | <?= $a->nama_mapel_essay; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                                    <div class="col-sm-10">
                                        <textarea name="pertanyaan" class="summernote" rows="10" style="width: 100%" required><?= $s->pertanyaan; ?></textarea>
                                    </div>
                                </div>
                                <!-- masukkan jawaban -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Bobot Soal</label>
                                    <div class="col-sm-10">
                                        <textarea rows="1" style="width: 10%" name="jawaban" required><?= $s->jawaban; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-default btn-flat" onclick="return history.go(-1)" title="Kembali ke halaman sebelumnya"><span class="fa fa-arrow-left"></span> Kembali</button>
                                        <button type="submit" class="btn btn-primary btn-flat" title="Tambah Data Soal Essay"><span class="fa fa-save"></span> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                        <div class="box-footer">

                        </div>
                    </form>
                </div>
            <?php } ?>


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
        $('#data-tables').dataTable();
    });
    $('.select2').select2();
    $('.alert-message').alert().delay(3000).slideUp('slow');

    //sumernote
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.css" rel="stylesheet">

<!-- summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.js"></script>


<?php
$this->load->view('admin/foot');
?>