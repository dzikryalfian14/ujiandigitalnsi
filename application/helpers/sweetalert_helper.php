<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function sweetalert($config) {
    $alert = '
        <script src="' . base_url('assets/SweetAlert.js') . '"></script>
        <link rel="stylesheet" href="' . base_url('assets/sweetalert2.scss') . '">';

    $alert .= '<script>';
    $alert .= 'Swal.fire(' . json_encode($config) . ')';
    $alert .= '</script>';

    return $alert;
}
