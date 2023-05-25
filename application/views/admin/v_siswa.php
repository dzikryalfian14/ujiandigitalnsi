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
            <h4 class="box-title">Data Peserta</h4>
          </center>
          <p>
          <h3 class="box-title"></h3>
          <?php echo '<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-data" onclick="$(\'#modal-data-body\').load(\'' . base_url('siswa/create') . '\')"><span class="fa fa-plus"></span> Tambah</button>' ?>

          <?php echo '<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-import" onclick="$(\'#modal-import-body\').load(\'' . base_url('siswa/import') . '\')"><span class="fa fa-download"></span> Import</button>' ?>

          <a href="<?php echo base_url('kelas'); ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#"><span></span>Data Ruangan</button></a>

          <?php echo '<button type="button" class="btn btn-danger btn-flat" onclick="return confirm(\'Apakah yakin semua data peserta ini dihapus?\') && $.get(\'' . base_url('siswa/hapusall') . '\', function(data) { location.reload(); })"><span class="fa fa-trash"></span> Hapus Semua Data</button>' ?>




        </div>
        <!-- /.box-header -->
        <div class="box-header">
          <a href="<?= base_url('cetak_siswa/print_all') ?>" class="btn btn-primary btn-flat pull-right" target="_blank"><i class="fa fa-print"></i> Cetak Pendaftar Ujian</a>

          <!-- insert nilai -->

        </div>

        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>NIK</th>
                <th>Nama Peserta</th>
                <th>Ruangan</th>
                <th>Username</th>
                <th>Password</th>
                <th width="12%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($siswa as $m) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->nis; ?></td>
                  <td><?php echo $m->nama_siswa; ?></td>
                  <td><?php echo $m->nama_kelas; ?></td>
                  <td><?php echo $m->username; ?></td>
                  <td><?php echo $m->password; ?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-warning btn-flat btn-xs">Action</button>
                      <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url('siswa/edit/') . $m->id_siswa; ?>">Edit Data</a></li>
                        <li><a href="<?= base_url('siswa/hapus/') . $m->id_siswa; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')">Hapus Data</a></li>
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

<!-- /. modal tambah data siswa  -->
<div class="modal fade" id="modal-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
          <h4 class="modal-title">Tambah Data Peserta</h4>
        </center>
      </div>
      <!-- /.form dengan modal -->
      <div class="modal-body">
        <div id="modal-data-body">
          <p>Loading...</p>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /. modal Import data siswa  -->
<div class="modal fade" id="modal-import">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
          <h4 class="modal-title">Import Data Peserta</h4>
        </center>
      </div>
      <!-- /.form dengan modal -->
      <div class="modal-body">
        <div id="modal-data-body">
          <!-- /.form dengan modal -->
          <form action="<?= base_url('siswa/import'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <div class="col-sm-12">
                  <a href="<?= base_url('assets/excel/datasiswa.xlsx') ?>" class="pull-right" download><i class="fa fa-download"></i> Download Format Data Import Peserta</a>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">File</label>
                <div class="col-sm-10">
                  <input type="file" name="excel_file" required accept=".xls, .xlsx, .csv">
                  <p class="help-block">File harus bertipe <b>.xls, .xlsx</p>
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Kelas</label>
                <div class="col-sm-10">
                  <select class="select2 form-control" name="kelas" required="">
                    <option selected="selected" disabled="">- Pilih Kelas</option>
                    <?php foreach ($kelas as $a) { ?>
                      <option value="<?= $a->id_kelas ?>"><?= $a->nama_kelas; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success pull-right" title="Import Data siswa">Import</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <!-- /.tutup form dengan modal  -->
        </div>
      </div>
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