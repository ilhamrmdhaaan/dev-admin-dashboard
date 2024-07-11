<?php

use Carbon\Carbon;




function tanggalSekarang()
{
    return date('Y-m-d');
}


function activeClass(string $route)
{
    return request()->routeIs($route) ? 'active current-page' : '';
}


function getInitialUser(string $nama)
{

    $arr = explode(' ', $nama);
    $singkatan = '';
    foreach ($arr as $kata) {
        $singkatan .= substr($kata, 0, 1);
    }
    return $singkatan;
}


function tanggal($tanggal)
{
    if ($tanggal == null) {
        return false;
    }
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}