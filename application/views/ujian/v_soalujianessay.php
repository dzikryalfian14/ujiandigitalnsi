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

    body {
        -webkit-user-select: none;
        /* Untuk browser berbasis WebKit seperti Chrome dan Safari */
        -moz-user-select: none;
        /* Untuk browser berbasis Gecko seperti Firefox */
        -ms-user-select: none;
        /* Untuk Internet Explorer */
        user-select: none;
        /* Atribut standar */
    }

    #captureWarning {
        display: none;
        color: black;
        font-weight: bold;
        padding: 10px;
        text-align: center;
        height: auto;

    }

    #canvasElement {
        display: none;
        width: 200px;
        height: 100px;
        align-items: center;
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
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="fa fa-exclamation-triangle"></i> PERHATIAN!</h4>
        BAGI PESERTA UJIAN <b> NIHON SEIKI INDONESIA </b> YANG TERBUKTI MELAKUKAN KECURANGAN PADA SAAT MELAKUKAN TEST AKAN DIKENAKAN DISKUALIFIKASI DAN OTOMATIS TIDAK DAPAT LULUS KE TAHAP SELANJUTNYA!
    </div>

    <!-- Tambahkan elemen peringatan -->
    <div class="alert alert-danger alert-dismissible" id="captureWarning">
        <h4><i class="icon fa fa-ban"></i> Tindakan ini tidak diizinkan. Mohon jangan meng-capture halaman ujian ini!</h4>

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
                        <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian_essay/jawab_aksi" method="post" onsubmit="return confirm('Apakah Anda Yakin Ingin Mengakhiri Ujian?')">
                            <input type="hidden" name="id_peserta_essay" value="<?php echo $id['id_peserta_essay']; ?>">
                            <input type="hidden" name="jumlah_soal" value="<?php echo $total_soal; ?>">

                            <div id="soalContainer">
                                <?php $no = 0;
                                foreach ($soal_essay as $s) {
                                    $no++;
                                    $jawaban = ""; // Menyimpan jawaban yang telah diisi sebelumnya
                                    if (isset($_POST['jawaban'][$s->id_soal_essay])) {
                                        $jawaban = $_POST['jawaban'][$s->id_soal_essay];
                                    }
                                ?>
                                    <div class="form-group soalItem" data-soal="<?php echo $no; ?>">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td width="1%"><?php echo $no; ?>.</td>
                                                    <td>
                                                        <?php echo $s->pertanyaan; ?>
                                                        <?php if (!empty($s->gambar)) : ?>
                                                            <br>
                                                            <img src="<?php echo base_url($s->gambar); ?>" width="400">
                                                            <br>
                                                        <?php endif; ?>
                                                        <input type="hidden" name="soal[]" value="<?php echo $s->id_soal_essay; ?>" />
                                                        <br>
                                                        <textarea rows="8" style="width: 95%; resize: none; overflow: auto;" type="text" name="jawaban[<?php echo $s->id_soal_essay; ?>]" required placeholder="Masukkan jawaban anda!"><?php echo $jawaban; ?></textarea>
                                                        <!-- <br> Bobot soal = <?php echo $s->jawaban; ?> -->
                                                        <br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <div style="display: flex; justify-content: center;">
                                        <button type="button" class="btn btn-primary btn-flat" id="previousButton" onclick="previousSoal()" style="margin-right: 20px;">Soal Sebelumnya</button>
                                        <button type="button" class="btn btn-primary btn-flat" id="nextButton" onclick="nextSoal()">Soal Berikutnya</button>
                                    </div>
                                    <div class="text-right">
                                        <?php if ($total_soal > 0) { ?>
                                            <button type="submit" class="btn btn-primary btn-flat" id="selesaiButton">Akhiri Ujian</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
        var currentSoal = 0;
        var totalSoal = <?php echo count($soal_essay); ?>;

        function showSoal(soalIndex) {
            var soalItems = document.getElementsByClassName('soalItem');
            for (var i = 0; i < soalItems.length; i++) {
                soalItems[i].style.display = 'none';
            }
            soalItems[soalIndex].style.display = 'block';

            var previousButton = document.getElementById('previousButton');
            var nextButton = document.getElementById('nextButton');
            var selesaiButton = document.getElementById('selesaiButton');

            previousButton.disabled = (soalIndex === 0);
            nextButton.disabled = (soalIndex === totalSoal - 1);

            if (soalIndex === totalSoal - 1) {
                nextButton.style.display = 'none';
                selesaiButton.style.display = 'inline-block';
            } else {
                nextButton.style.display = 'inline-block';
                selesaiButton.style.display = 'none';
            }
        }

        function previousSoal() {
            currentSoal--;
            if (currentSoal < 0) {
                currentSoal = 0;
            }
            showSoal(currentSoal);
        }

        function nextSoal() {
            currentSoal++;
            if (currentSoal >= totalSoal) {
                currentSoal = totalSoal - 1;
            }
            showSoal(currentSoal);
        }

        function submitForm() {
            var formSoal = document.getElementById('formSoal');
            if (formSoal) {
                formSoal.submit();
            }
        }

        showSoal(currentSoal);
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

        // Mencegah pengguna meng-capture halaman dengan mengubah tampilan dan menampilkan peringatan
        window.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('keydown', function(event) {
                if (event.ctrlKey && (event.key === 'c' || event.key === 'C')) {
                    event.preventDefault();
                    showCaptureWarning();
                }
            });
            document.addEventListener('contextmenu', function(event) {
                event.preventDefault();
                showCaptureWarning();
            });
        });

        function showCaptureWarning() {
            var warningElement = document.getElementById('captureWarning');
            warningElement.style.display = 'block';
            setTimeout(function() {
                warningElement.style.display = 'none';
            }, 3000); // Menghilangkan peringatan setelah 3 detik
        }

        // Memeriksa dukungan WebRTC pada browser
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Menggunakan navigator.mediaDevices.getUserMedia untuk meminta akses kamera
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    // Akses kamera berhasil, dapatkan elemen video dan tampilkan stream video
                    var videoElement = document.getElementById('videoElement');
                    videoElement.srcObject = stream;
                })
                .catch(function(error) {
                    // Kesalahan dalam meminta akses kamera, tampilkan pesan kesalahan
                    console.error('Gagal mendapatkan akses kamera: ', error);
                });
        } else {
            // Browser tidak mendukung WebRTC
            console.error('Browser tidak mendukung WebRTC.');
        }
    </script>


    <?php
    $this->load->view('ujian/foot');
    ?>