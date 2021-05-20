<?php
require '../config.php';

use GDText\Box;
use GDText\Color;

function hexToRgb($hex){
    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    foreach ($color_parts as $color) {
        $rgb[] = hexdec($color); // Convert to decimal
    }
    return $rgb;
}

function hexToColor($hex = '#ff4b8c'){
    $color = hexToRgb($hex);
    return (new Color($color[0],$color[1],$color[2]));
}

/* ========
 * SETTINGS
 * ======== */

$width = 1702;
$height = 630;

$textColour = hexToColor('#f2aa4c');
$backColour = hexToRgb('#101820');

$text = '#dodanperks';

$fontSize = 140;

$im = imagecreatetruecolor($width,$height);
$backgroundColor = imagecolorallocate($im, $backColour[0], $backColour[1], $backColour[2]);
imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize($fontSize);
$box->setFontColor($textColour);
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(0, 0, $width,$height);
$box->setTextAlign('center', 'center');
$box->draw($text);

header("Content-type: image/png");
imagepng($im);
