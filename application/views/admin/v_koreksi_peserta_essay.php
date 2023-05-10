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
                                        <a href="<?php echo base_url('koreksi_essay') . '?id_siswa=' . $row->id_siswa . '&nama_mapel=' . $row->nama_mapel_essay; ?>" class="btn btn-primary">Lihat Jawaban <?php echo $row->nama_mapel_essay; ?></a>
                                    </td>

                                    <td>

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
    $(document).ready(function() {
        $('.btn-koreksi').click(function(e) {
            var id_siswa = $(this).data('id');
            var button = $(this);

            $.ajax({
                url: '<?php echo base_url('koreksi_essay/koreksi_siswa'); ?>',
                type: 'post',
                data: {
                    id_siswa: id_siswa
                },
                success: function(response) {
                    if (response == 'success') {
                        button.parent().html('Sudah Dikoreksi');
                    } else {
                        alert('Terjadi kesalahan saat melakukan koreksi');
                    }
                }
            });
        });
    });
</script>
<script>
    function updateStatus(id_siswa, status) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('koreksi_essay'); ?>',
            data: {
                id_siswa: id_siswa,
                status: status
            },
            success: function(response) {
                if (response == 'success') {
                    // Update status koreksi di data peserta
                    var btn = $('button[data-id="' + id_siswa + '"]');
                    var row = btn.closest('tr');
                    var status_td = row.find('td:last-child');
                    if (status == 2) {
                        btn.removeClass('btn-belum').addClass('btn-sudah').text('Sudah Dikoreksi');
                        status_td.text('Sudah Dikoreksi');
                    } else {
                        btn.removeClass('btn-sudah').addClass('btn-belum').text('Belum Dikoreksi');
                        status_td.text('Belum Dikoreksi');
                    }
                }
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