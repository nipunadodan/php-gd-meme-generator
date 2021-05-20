<?php

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

/*
 * =================
 * GD Image creation
 * =================
 * */

$im = imagecreatetruecolor(1600, 1200);
$backColour = hexToRgb('#00203F');
$backgroundColor = imagecolorallocate($im, $backColour[0], $backColour[1], $backColour[2]);
imagefill($im, 0, 0, $backgroundColor);

/*$box = new Box($im);
$box->setFontFace(DOC_ROOT.'/fonts/lineawesome/la-regular-400.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(130);
$box->setFontColor(hexToColor(isset($_POST['title-colour']) && $_POST['title-colour'] !== '' ? $_POST['title-colour'] : '#ffff8c')); //#ff4b8c - new Color(255, 75, 140)
//$box->setFontColor(new Color(255, 255, 255));
$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(120, 120, 1200, 460);
$box->setTextAlign('left', 'top');*/
//$box->draw('&#xf0eb;');

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-Black.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(90);
$box->setFontColor(hexToColor(isset($_POST['title-colour']) && $_POST['title-colour'] !== '' ? $_POST['title-colour'] : '#adefd1')); //#adefd1 - new Color(255, 75, 140)
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
$box->setFontColor(hexToColor(isset($_POST['title-colour']) && $_POST['title-colour'] !== '' ? $_POST['title-colour'] : '#d1d1d1'));
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(50);
$box->setBox(150, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
//$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw(isset($_POST['tag']) && $_POST['tag'] !== '' ? $_POST['tag'] : '');

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
ob_start();
imagepng($im);
$imagestring = ob_get_contents();
ob_end_clean();

echo 'data:image/png;base64, '.base64_encode($imagestring);
imagedestroy($im);
