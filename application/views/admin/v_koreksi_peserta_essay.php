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
            <div class="box-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-mid">
                            <h3 class="box-title">Koreksi Ujian</h3>
                        </div>
                    </div>
                </div>
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
                                <th>Koreksi Ujian</th>
                                <th>Status Koreksi</th>
                                <th>Action</th>
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
                                        <a href="<?php echo base_url('koreksi_essay') ?>" class="btn btn-primary">Lihat Jawaban <?php echo $row->nama_mapel_essay; ?></a>
                                    </td>
                                    <td>
                                        <?php if ($row->status_koreksi == 0) {
                                            echo "<span> Belum Dikoreksi </span>";
                                        } else if ($row->status_koreksi == 1) {
                                            echo "<span> Sudah Dikoreksi </span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo base_url('koreksi_peserta_essay/ubah_status_koreksi'); ?>">
                                            <input type="hidden" name="id_peserta_essay" value="<?php echo $row->id_peserta_essay; ?>">
                                            <select name="status_koreksi" onchange="this.form.submit()">
                                                <option value="0" <?php if ($row->status_koreksi == 0) echo "selected"; ?>>Belum Dikoreksi</option>
                                                <option value="1" <?php if ($row->status_koreksi == 1) echo "selected"; ?>>Sudah Dikoreksi</option>
                                            </select>
                                        </form>
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
<script>
    function updateStatus(id_siswa, nama_mapel) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('koreksi_peserta_essay/update_status_ujian'); ?>',
            data: {
                id_siswa: id_siswa,
                nama_mapel: nama_mapel
            },
            success: function(response) {
                // tampilkan pesan sukses atau perbarui status ujian pada tampilan
            },
            error: function(xhr, status, error) {
                // tampilkan pesan error jika terjadi kesalahan
            }
        });
    }
</script>







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