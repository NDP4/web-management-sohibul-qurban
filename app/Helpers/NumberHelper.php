<?php

if (!function_exists('terbilang')) {
    function terbilang($number)
    {
        $number = abs($number);
        $angka = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        );
        $temp = "";

        if ($number < 12) {
            $temp = " " . $angka[$number];
        } else if ($number < 20) {
            $temp = terbilang($number - 10) . " belas";
        } else if ($number < 100) {
            $temp = terbilang($number / 10) . " puluh" . terbilang($number % 10);
        } else if ($number < 200) {
            $temp = " seratus" . terbilang($number - 100);
        } else if ($number < 1000) {
            $temp = terbilang($number / 100) . " ratus" . terbilang($number % 100);
        } else if ($number < 2000) {
            $temp = " seribu" . terbilang($number - 1000);
        } else if ($number < 1000000) {
            $temp = terbilang($number / 1000) . " ribu" . terbilang($number % 1000);
        } else if ($number < 1000000000) {
            $temp = terbilang($number / 1000000) . " juta" . terbilang($number % 1000000);
        } else if ($number < 1000000000000) {
            $temp = terbilang($number / 1000000000) . " milyar" . terbilang(fmod($number, 1000000000));
        }

        return $temp;
    }
}
