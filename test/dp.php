<?php
require '../config.php';

use GDText\Box;
use GDText\Color;

$im = imagecreatetruecolor(1200,1200);
$backgroundColor = imagecolorallocate($im, 0, 18, 64);
imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(390);
$box->setFontColor(new Color(255, 75, 140));
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(0, 0, 1200,1200);
$box->setTextAlign('center', 'center');
$box->draw('#dp');

header("Content-type: image/png");
imagepng($im);
