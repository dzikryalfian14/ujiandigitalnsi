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
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <center>
                        <h4 class="box-title">Daftar Soal Ujian</h4>
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
                                        <option value="<?= $a->id_mapel_essay; ?>"><?= $a->kode_mapel_essay; ?> | <?= $a->nama_mapel_essay; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url(uri_string()); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
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
            <?= $this->session->flashdata('message'); ?>
            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <h3 class="box-title"></h3>

                    <a href="<?= base_url('essay') ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Tambah Soal</button></a>

                    <a href="<?php echo base_url('mapel_essay'); ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#"><span></span>Tambah Nama Ujian Essay</button></a>
                </div>

                <table id="data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="10%">Kode Ujian </th>
                            <th width="20%">Nama Ujian</th>
                            <th>Pertanyaan</th>
                            <th>Soal Gambar</th>
                            <th width="13%">Bobot Soal</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($essay_ujian as $d) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d->kode_mapel_essay; ?></td>
                                <td><?php echo $d->nama_mapel_essay; ?></td>
                                <td>
                                    <?php
                                    echo $d->pertanyaan;
                                    preg_match_all('/data:image\/([a-zA-Z]+);base64,([^\s"]+)/i', $d->pertanyaan, $matches);
                                    foreach ($matches[0] as $key => $match) {
                                        $image_data = base64_decode($matches[2][$key]);
                                        $image_type = $matches[1][$key];
                                        $image_src = 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);
                                        echo '<br><img src="' . $image_src . '" width="200">';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $d->gambar; ?>
                                </td>
                                <td>
                                    <?php echo $d->jawaban; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url() . 'essay_ujian/edit/' . $d->id_soal_essay; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-edit" title="Ubah"></span></a> |
                                    <a href="<?= base_url() . 'essay_ujian/hapus/' . $d->id_soal_essay; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" onclick="return confirm('Apakah yakin data soal ini akan di hapus?')" title="Hapus"></span></a>
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
    });
    $('.select2').select2();
    $('.alert-message').alert().delay(3000).slideUp('slow');
    $('.alert-dismissible').alert().delay(3000).slideUp('slow');

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