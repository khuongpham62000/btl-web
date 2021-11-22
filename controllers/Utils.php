<?php

function resizeImage($src)
{
    $src_image = imagecreatefrompng($src);

    // calculating the part of the image to use for thumbnail
    list($width, $height) = getimagesize($src); // 1366 * 768
    if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2; // 299
        $smallestSide = $height; // 768
    } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
    }

    $thumbSize = 300;
    $dest_image = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($dest_image, $src_image, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

    // The second parameter should be the path of your destination
    imagepng($dest_image, $src);

    imagedestroy($dest_image);
    imagedestroy($src_image);
}
