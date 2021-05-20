<?php
require '../config.php';

use GDText\Box;
use GDText\Color;

$im = imagecreatetruecolor(1600, 1200);
$backgroundColor = imagecolorallocate($im, 0, 18, 64);
imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/lineawesome/la-regular-400.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(130);
$box->setFontColor(new Color(255, 75, 140));
//$box->setFontColor(new Color(255, 255, 255));
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(120, 120, 1200, 460);
$box->setTextAlign('left', 'top');
//$box->draw('&#xf0eb;');

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-Black.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(90);
$box->setFontColor(new Color(255, 75, 140));
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(150, 300, 1200, 460);
$box->setTextAlign('left', 'top');
$box->draw(isset($_POST['title']) && $_POST['title'] !== '' ? $_POST['title'] : '');

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf'); // http://www.dafont.com/pacifico.font
$box->setFontSize(40);
$box->setFontColor(new Color(255, 255, 255));
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(150, 550, 1100, 1060);
$box->setTextAlign('left', 'top');
$box->draw(isset($_POST['body']) && $_POST['body'] !== '' ? $_POST['body'] : '');

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf'); // http://www.dafont.com/franchise.font
$box->setFontColor(new Color(210, 210, 210));
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(50);
$box->setBox(150, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
//$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw("#dodanperks");

/*$box = new Box($im);
$box->setFontFace(DOC_ROOT.'/fonts/Abhaya_Libre/AbhayaLibre-Bold.ttf'); // http://www.dafont.com/franchise.font
$box->setFontColor(new Color(230, 230, 230));
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(60);
$box->setBox(530, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw("#හදවතින්මලාංකිකයි");*/

header("Content-type: image/png");
imagepng($im);
