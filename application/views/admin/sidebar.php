  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('image/logo nsi.jpg') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <!-- Menu Home -->
        <li <?= $this->uri->segment(1) == 'home' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i>
            <span>Home</span>
          </a>
        </li>


        <!-- Dashboard ADMIN -->
        <?php if ($this->session->userdata('status') == 'admin_login') { ?>


          <li <?= $this->uri->segment(1) == 'guru' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('guru'); ?>"><i class="fa fa-user-circle-o"></i>
              <span> Data Penguji</span>
            </a>
          </li>

          <li <?= $this->uri->segment(1) == 'siswa' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('siswa'); ?>"><i class="fa fa-users"></i>
              <span> Data Peserta</span>
            </a>
          </li>


          <!-- kelola soal pilihan ganda -->

          <li class="treeview <?php echo ($this->uri->segment(1) == 'soal_ujian' || $this->uri->segment(1) == 'peserta' || $this->uri->segment(1) == 'hasil_ujian') ? 'active menu-open' : ''; ?>">
            <a href="#">
              <i class="fa fa-pencil-square-o"></i> <span>Kelola Pilihan Ganda</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="<?php echo ($this->uri->segment(1) == 'soal_ujian' || $this->uri->segment(1) == 'peserta' || $this->uri->segment(1) == 'hasil_ujian') ? 'display: block;' : ''; ?>">
              <li <?= $this->uri->segment(1) == 'soal_ujian' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('soal_ujian'); ?>"><i class="fa fa-list"></i> Kelola Soal Pilihan Ganda</a>
              </li>
              <li <?= $this->uri->segment(1) == 'peserta' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('peserta'); ?>"><i class="fa fa-user-circle-o"></i> Peserta Ujian Pilihan Ganda</a>
              </li>
              <li <?= $this->uri->segment(1) == 'hasil_ujian' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('hasil_ujian'); ?>"><i class="fa fa-check-square-o"></i> Hasil Ujian</a>
              </li>
            </ul>
          </li>


          <!-- kelola soal essay -->
          <li class="treeview <?php echo ($this->uri->segment(1) == 'essay_ujian' || $this->uri->segment(1) == 'peserta_essay' || $this->uri->segment(1) == 'hasil_ujian_essay' || $this->uri->segment(1) == 'koreksi_essay') ? 'active menu-open' : ''; ?>">
            <a href="#">
              <i class="fa fa-pencil-square-o"></i> <span>Kelola Essay</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="<?php echo ($this->uri->segment(1) == 'essay_ujian' || $this->uri->segment(1) == 'peserta_essay') ? 'display: block;' : ''; ?>">
              <li <?= $this->uri->segment(1) == 'essay_ujian' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('essay_ujian'); ?>"><i class="fa fa-pencil-square"></i> Kelola Soal Essay</a>
              </li>
              <li <?= $this->uri->segment(1) == 'peserta_essay' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('peserta_essay'); ?>"><i class="fa fa-user-circle-o"></i> Peserta Ujian Essay</a>
              </li>
              <li <?= $this->uri->segment(1) == 'hasil_ujian_essay' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('hasil_ujian_essay'); ?>"><i class="fa fa-check-square-o"></i>
                  <span>Hasil Ujian</span>
                </a>

              <li <?= $this->uri->segment(1) == 'koreksi_peserta_essay' ? 'class="active"' : '' ?>>
                <a href="<?php echo base_url('koreksi_peserta_essay'); ?>"><i class="fa fa-pencil"></i>
                  <span>Koreksi Essay </span>
                </a>
              </li>
            </ul>
          </li>

          <li <?= $this->uri->segment(1) == 'utilitas' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('utilitas'); ?>"><i class="fa fa-gears"></i>
              <span>Kelola Database</span>
            </a>
          </li>



          <!-- Dashboard Penguji -->
        <?php } else if ($this->session->userdata('status') == 'guru_login') { ?>


          <li class="treeview <?= $this->uri->segment(1) == 'soal' || $this->uri->segment(1) == 'soal_ujian' ? 'active' : '' ?>">

          <li <?= $this->uri->segment(1) == 'soal_ujian' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('soal_ujian'); ?>"><i class="fa fa-pencil-square-o"></i>
              <span>Kelola Soal Ujian</span>
            </a>
          </li>
          <li <?= $this->uri->segment(1) == 'essay_ujian' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('essay_ujian'); ?>"><i class="fa fa-pencil-square"></i>
              <span>Kelola Soal Essay</span>
            </a>
          </li>
          </li>

        <?php } ?>

        <li <?= $this->uri->segment(1) == 'password' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('password'); ?>"><i class="fa fa-lock"></i>
            <span>Ganti Password</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i>
            <span>Keluar Akun</span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">