<?php
session_start();

// buat string random (huruf besar kecil)
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$captcha = substr(str_shuffle($chars), 0, 4);

// simpan ke session
$_SESSION['captcha'] = $captcha;

// buat gambar
$width = 120;
$height = 40;
$image = imagecreate($width, $height);

// warna
$bg = imagecolorallocate($image, 240, 240, 240);
$text_color = imagecolorallocate($image, 0, 0, 0);
$noise_color = imagecolorallocate($image, 100, 120, 180);

// tambah noise (titik)
for ($i = 0; $i < 100; $i++) {
    imagesetpixel($image, rand(0,$width), rand(0,$height), $noise_color);
}

// tambah garis noise
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $noise_color);
}

// tulis captcha
$font_size = 5;
$x = 30;
$y = 10;

imagestring($image, $font_size, $x, $y, $captcha, $text_color);

// output gambar
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>