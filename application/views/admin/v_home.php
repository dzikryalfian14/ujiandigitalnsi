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
                        <a href="<?= base_url('assets/excel/Work Intruction Ujian Digital NSI.xlsx') ?>" download style="text-align: right;">Download Work Intruction</a>
                        <li><b>Penguji dan Peserta</b></li>
                        di TAB Penguji dan Peserta, anda dapat mengelola soal sesuai dengan data yang di daftarkan untuk berganti session silahkan login dengan username dan password yang sudah dibuat.
                        <br>
                        <li><b>Hasil Ujian</b></li>
                        Hasil Ujian dapat dicetak dalam bentuk pdf. untuk beberapa fungsi soal URAIAN dan soal PILIHAN GANDA masih dalam perbaikan.
                        <li><b>Penting</b></li>
                        Aplikasi ini masih dalam tahap perkembangan untuk memaksimalkan penggunaan silahkan baca Work Intruction yang disediakan developer. Beberapa fungsi masih belum berjalan normal, Jika ada masalah dalam beberapa fungsi Silahkan menghubungi Developer<br>
                        <li><b>Perhatian</b></li>
                        <b>DILARANG KERAS MENGGANTI PASSWORD ADMIN</b> password digunakan untuk kepentingan beberapa bug aplikasi kedepan terima kasih.<br>
                        <br>

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