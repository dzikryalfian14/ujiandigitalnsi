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

    <div class="callout callout-success">
        <h4>Selamat Datang, <?php echo $this->session->userdata('nama'); ?> </h4>

    </div>

    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Petunjuk Penggunaan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dt></dt>
                <dd>
                    <ol><br>
                        <li><b>Kelola Soal Ujian</b></li>
                        Terdapat beberapa tab yang digunakan untuk mengelola beberapa peserta ujian serta soal ujian. silahkan download <b>Work Intruction</b> pada link berikut
                        <a href="nama-file.pdf" download style="text-align: right;">Download PDF</a>
                        <li><b>Penguji dan Peserta</b></li>
                        di TAB Penguji dan Peserta, anda dapat mengelola soal sesuai dengan data yang di daftarkan untuk berganti session silahkan login dengan username dan password yang sudah dibuat.
                        <br>
                        <li><b>Hasil Ujian</b></li>
                        Hasil Ujian dapat dicetak dalam bentuk pdf. untuk beberapa fungsi soal uraian dan soal lainnya masih dalam perbaikan <alert>beberapa fungsi masih dalam perbaikan</alert>
                        <li><b>Perhatian</b></li>
                        Aplikasi ini masih pada tahap perkembangan untuk memaksimalkan penggunaan silahkan baca Work Intruction yang disediakan developer. Jika ada masalah dalam beberapa fungsi Silahkan menghubungi developer.<br>
                        <br>
                        <br>

                        <a href="nama-file.pdf" download style="text-align: right;">Download PDF Work Instruction</a>

                    </ol>
                </dd>
            </dl>

            <div>

            </div>

        </div>

</section><!-- /.content -->

<?php
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
    $(function() {
        $('#data-tables').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>


<?php
$this->load->view('admin/foot');
?>