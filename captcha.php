<?php
/**
*@author Heiter Developer <dev@heiterdeveloper.com>
*@link https://github.com/HeiterDeveloper/captcha-php
*@copyright 2018 Heiter Developer
*@license GPL
*@license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
*/

session_start();
$txt = substr(md5(time()), 0, 6);

//recupere este campo na página de tratamento
$_SESSION['cpt'] = $txt;

$fonte = __DIR__."/LinLibertine/LinLibertine_RB.ttf";

$img = imagecreatetruecolor(120, 35);

$cor['fundo'] =  imagecolorallocate($img, 255,255,255);
$cor['letras']['black'] = imagecolorallocate($img, 0, 0, 0);
$cor['letras']['black2'] = imagecolorallocate($img, 70, 70, 70);
$cor['cinza'] = imagecolorallocate($img, 100, 100, 100);

imagefill($img, 0,0, $cor['fundo']);

$cl = imagecolorallocate($img, 0,0,0);

for($x = 0;$x < strlen($txt); $x++){
  $corp = array_rand($cor['letras'], 1);
  imagefttext($img, rand(15,25), rand(-45, 45), ($x*18)+10, rand(25, 30), $cor['letras'][$corp], $fonte, substr($txt, $x, 1));
}
imagearc($img, 60, 17.5, 120, 30, 0, 360, $cor['cinza']);
imagearc($img, 60, 17.5, 96, 24, 0, 360, $cor['cinza']);
imagearc($img, 60, 17.5, 76.8, 19.2, 0, 360, $cor['cinza']);
imagearc($img, 60, 17.5, 61.44, 15.36, 0, 360, $cor['cinza']);

header("Content-Type: image/png");
imagepng($img);

imagedestroy($img);
?>
