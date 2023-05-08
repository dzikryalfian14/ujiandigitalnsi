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
            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <center>
                        <h3 class="box-title">Data Nama Ujian Essay</h3>
                    </center>
                    <p>
                        <a href="<?= base_url('essay_ujian') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Tambah</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kode</th>
                                <th>Nama Ujian</th>
                                <th width="12%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($mapel_essay as $m) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $m->kode_mapel_essay; ?></td>
                                    <td><?php echo $m->nama_mapel_essay; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-flat btn-xs">Action</button>
                                            <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url() . 'mapel_essay/edit/' . $m->id_mapel_essay; ?>">Edit Data</a></li>
                                                <li><a href="<?= base_url() . 'mapel_essay/hapus/' . $m->id_mapel_essay; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')">Hapus Data</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                    <h4 class="modal-title">Tambah Data Ujian</h4>
                </center>
            </div>
            <!-- /.form dengan modal -->
            <form method="post" action="<?php echo base_url() . 'mapel_essay/mapel_aksi'; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Kode Ujian </label>
                        <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Nama Ujian Essay" required="">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Ujian</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Ujian Essay" required="">
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
    $(document).ready(function() {
        $('#data').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>