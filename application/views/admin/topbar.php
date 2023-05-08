</head>

<body class="skin-green sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <span class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>N</b><b>S</b><b>I</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ujian Nihon Seiki</b></span>
      </span>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>


        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('image/logo nsi.jpg') ?>" class="user-image" alt="User Image">
                <span class="hidden-xs">Hai, <?php echo $this->session->userdata('nama'); ?></span>
              </a>

              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= base_url('image/logo nsi.jpg') ?>" class="img-circle" alt="User Image">
                  <p>
                    <span class="hidden-xs">Hai, <?php echo $this->session->userdata('nama'); ?></span>
                    <small>Terakhir Online <?= date('M, Y') ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('/avatar.png') ?>" class="btn btn-block bg-gradient-secondary">
                    </a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout'); ?>" id="logout" class="btn btn-danger btn-flat">Logout</a>
                  </div>
                </li>
              </ul>

            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>