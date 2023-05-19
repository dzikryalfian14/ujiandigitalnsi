<?php
$this->load->view('ujian/head');
?>

<!--tambahkan custom css disini-->
<style>
    #timer_place {
        margin: 0 auto;
        text-align: center;
    }

    #counter {
        border-radius: 7px;
        border: 2px solid gray;
        padding: 7px;
        font-size: 2em;
        font-weight: bolder;
    }
</style>

<?php
$this->load->view('ujian/topbar');
?>

<?php

if (isset($_SESSION["waktu_start"])) {
    $lewat = time() - $_SESSION["waktu_start"];
} else {
    $_SESSION["waktu_start"] = time();
    $lewat = 0;
}

?>
<!-- Content Header (Page header) -->
<section class="content">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> PERHATIAN!</h4>
        BAGI PESERTA UJIAN <b> NIHON SEIKI INDONESIA </b> YANG TERBUKTI MELAKUKAN KECURANGAN PADA SAAT MELAKUKAN TEST AKAN DIKENAKAN DISKUALIFIKASI DAN OTOMATIS TIDAK DAPAT LULUS KE TAHAP SELANJUTNYA!
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success box-solid" style="border-radius: 5px; box-shadow: 0px 0px 5px #888;">
                    <div class="box-header text-center" style="background-color: #20B2AA; color: #fff; padding: 10px;">
                        <h4 class="box-title">Waktu Anda</h4>
                    </div>
                    <div class="box-body" id="timer_place" style="text-align: center;">
                        <span id="counter" style="font-size: 50px;"></span>
                    </div>
                    <div class="box-footer" style="background-color: #20B2AA ; height: 20px;"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <center>
                            <h3 class="box-title">Soal Ujian Essay</h3>
                        </center>
                    </div><!-- /.box-header -->
                    <div class="box-body" style="overflow-y: scroll;height: 525px;">
                        <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian_essay/jawab_aksi" method="post" onsubmit="return confirm('Anda Yakin ?')">
                            <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian_essay/jawab_aksi" method="post" onsubmit="return confirmSweetAlert()">

                                <input type="hidden" name="id_peserta_essay" value="<?php echo $id['id_peserta_essay']; ?>">
                                <input type="hidden" name="jumlah_soal" value="<?php echo $total_soal; ?>">

                                <?php $no = 0;
                                foreach ($soal_essay as $s) {
                                    $no++ ?>
                                    <div class="form-group">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td width="1%"><?php echo $no; ?>.</td>
                                                    <td>
                                                        <?php echo $s->pertanyaan; ?>
                                                        <?php if (!empty($s->gambar)) : ?>
                                                            <br>
                                                            <img src="<?php echo base_url($s->gambar); ?>" width="200">
                                                            <br>
                                                        <?php endif; ?>
                                                        <input type='hidden' name='soal[]' value='<?php echo $s->id_soal_essay; ?>' />
                                                        <br>
                                                        <textarea rows="5" style="width: 95%; resize: none; overflow: auto;" type="text" name="jawaban[<?php echo $s->id_soal_essay; ?>]" required placeholder="Masukkan jawaban anda!"></textarea>
                                                        <br> Bobot soal = <?php echo $s->jawaban; ?>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                            </form>
                            <div class="box-footer">

                            </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>


    </section><!-- /.content -->

    <?php
    $this->load->view('ujian/js');
    ?>

    <!--tambahkan custom js disini-->

    <script type="text/javascript">
        // var countDownDate = new Date("").getTime();
        // var x = setInterval(function() {
        //     var now = new Date().getTime();
        //     var distance = countDownDate - now;
        //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //     hours = hours < 10 ? "0" + hours : hours;
        //     minutes = minutes < 10 ? "0" + minutes : minutes;
        //     seconds = seconds < 10 ? "0" + seconds : seconds;
        //     document.getElementById("counter").innerHTML = hours + ":" + minutes + ":" + seconds;
        //     if (distance < 0) {
        //         document.getElementById("counter").innerHTML = "WAKTU UJIAN HABIS";
        //         document.getElementById("formSoal").submit();
        //     }
        // }, 1000);
        function waktuHabis() {
            alert('Waktu Anda telah habis, Jawaban anda akan disimpan secara otomatis.');
            var formSoal = document.getElementById("formSoal");
            formSoal.submit();
        }

        function hampirHabis(periods) {
            if ($.countdown.periodsToSeconds(periods) == 60) {
                $(this).css({
                    color: "red"
                });
            }
        }
        $(function() {
            var waktu = '<?= $max_time; ?>';
            var sisa_waktu = waktu - <?php echo $lewat ?>;
            var longWayOff = sisa_waktu;
            $("#counter").countdown({
                until: longWayOff,
                compact: true,
                onExpiry: waktuHabis,
                onTick: hampirHabis
            });
        });

        //sweetconfirm
        function confirmSweetAlert() {
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Anda tidak dapat mengembalikan aksi ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika user menekan tombol OK
                        return true;
                    } else {
                        // Jika user menekan tombol Batal
                        return false;
                    }
                });
        }


        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button";
        window.onhashchange = function() {
            window.location.hash = "no-back-button";
        }
    </script>


    <?php
    $this->load->view('ujian/foot');
    ?>