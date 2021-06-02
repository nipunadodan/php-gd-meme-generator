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
 *  POST variables =======================
 */
$title = isset($_POST['title_']) && $_POST['title_'] !== '' ? $_POST['title_'] : '';
$titleColour = isset($_POST['title-colour']) && $_POST['title-colour'] !== '' ? hexToColor($_POST['title-colour']) : hexToColor('#d1d1d1');

$body = isset($_POST['body_']) && $_POST['body_'] !== '' ? $_POST['body_'] : '';
$bodyColour = isset($_POST['body-colour']) && $_POST['body-colour'] !== '' ? hexToColor($_POST['body-colour']) : hexToColor('#d1d1d1');

$tag = isset($_POST['tag']) && $_POST['tag'] !== '' ? $_POST['tag'] : '';
$tagColour = isset($_POST['tag-colour']) && $_POST['tag-colour'] !== '' ? hexToColor($_POST['tag-colour']) : hexToColor('#d1d1d1');

$width = isset($_POST['width']) && $_POST['width'] !== '' ? intval($_POST['width']) : 1600;
$height = isset($_POST['height']) && $_POST['height'] !== '' ? intval($_POST['height']) : 1200;
$backColour = isset($_POST['background-colour']) && $_POST['background-colour'] !== '' ? hexToRgb($_POST['background-colour']) : hexToRgb('#00203F');
$lang = isset($_POST['lang']) && $_POST['lang'] !== '' ? $_POST['lang'] : 'en';


/*
 * =================
 * GD Image creation
 * =================
 * */

$im = imagecreatetruecolor($width, $height);
$backgroundColor = imagecolorallocate($im, $backColour[0], $backColour[1], $backColour[2]);
//$backgroundColor = imagecolorallocate($im, 55, 55, 55);
imagefill($im, 0, 0, $backgroundColor);

/*$box = new Box($im);
$box->setFontFace(DOC_ROOT.'/fonts/lineawesome/la-regular-400.ttf'); // http://www.dafont.com/prisma.font
$box->setFontSize(130);
$box->setFontColor(hexToColor(isset($_POST['title-colour']) && $_POST['title-colour'] !== '' ? $_POST['title-colour'] : '#ffff8c')); //#ff4b8c - new Color(255, 75, 140)
//$box->setFontColor(new Color(255, 255, 255));
//$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(120, 120, 1200, 460);
$box->setTextAlign('left', 'top');*/
//$box->draw('&#xf0eb;');

$box = new Box($im);
if($lang == 'en') {
//$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-Black.ttf');
    $box->setFontFace(DOC_ROOT . '/fonts/Oswald/Oswald-Bold.ttf');
}else{
    $box->setFontFace(DOC_ROOT . '/fonts/Ganganee.ttf');
}
$box->setFontSize(100);
$box->setFontColor($titleColour);
//$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(150, 280, 1200, 460);
$box->setTextAlign('left', 'top');
$box->draw($title);

$box = new Box($im);
if($lang == 'en') {
    $box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-Regular.ttf');
}else{
    $box->setFontFace(DOC_ROOT . '/fonts/Malithi.ttf');
}
$box->setFontSize(45);
$box->setFontColor($bodyColour);
//$box->setTextShadow(new Color(0, 0, 0, 50), 0, -2);
$box->setBox(150, 515, 1100, 1060);
$box->setTextAlign('left', 'top');
$box->draw($body);

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf');

$box->setFontColor($titleColour);
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(50);
$box->setBox(150, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
//$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw('#');

$box = new Box($im);
$box->setFontFace(DOC_ROOT . '/fonts/Inter/Inter-ExtraBold.ttf');
$box->setFontColor($tagColour);
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(50);
$box->setBox(183, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
//$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw($tag);

/*$box = new Box($im);
$box->setFontFace(DOC_ROOT.'/fonts/Abhaya_Libre/AbhayaLibre-Bold.ttf'); // http://www.dafont.com/franchise.font
$box->setFontColor(new Color(230, 230, 230));
//$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(60);
$box->setBox(530, 200, 1200, 800);
$box->setTextAlign('left', 'bottom');
$box->setBackgroundColor(new Color(255, 75, 140));
$box->draw("#හදවතින්මලාංකිකයි");*/

ob_start();
header("Content-type: text/plain");
imagepng($im);
$imagestring = ob_get_contents();
ob_end_clean();
imagepng($im,'image.png');

$return = [
    'status' => 'success',
    'image' => 'data:image/png;base64, '.base64_encode($imagestring),
    'message' => 'Successfully created the image'
];
echo json_encode($return);
imagedestroy($im);
