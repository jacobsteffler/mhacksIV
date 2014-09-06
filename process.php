<!doctype html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Ziggeo.php');
$ziggeo = new Ziggeo('3ed818d9203c4a5b815fb691d8d0a311', 'e4669e432a755c096b4c8dca52b9d105', 'ecc4b8c297b93d82b1417a070f64eb22');

$name = $_GET["t"];
file_put_contents("received/" . $name . ".mp4", $ziggeo->streams()->download_video($_GET["t"], $_GET["vt"]));
$ziggeo->videos()->delete($_GET["t"]);

exec("mkdir received/" . $name);
exec("ffmpeg -i received/" . $name . ".mp4 -r 30 -f image2 received/" . $name . "/%0d.png");
exec("rm received/" . $name . ".mp4");
exec("mogrify -resize 700x700! received/" . $name . "/*");
chdir("received/" . $name);
exec("convert 1.png thumbnail.jpg");

$side = 175;
for($i = 1; $i <= 15; $i++) {
    exec("mkdir " . $i);
    for($j=1;file_exists($j . ".png"); $j++){
        $row = ceil($i / 4.0);
        $col = ($i - 1) % 4 + 1;
        
        $xoffset = $side * ($col - 1);
        $yoffset = $side * ($row - 1);
        
        exec("convert " . $j . ".png -crop " . $side . "x" . $side . "+" . $xoffset . "+" . $yoffset . " +repage " . $i . "/" . $j . ".png");
    }
    
    chdir($i);
    exec("ls > .files");
    exec("sort -n .files > .files2");
    exec("convert $(cat .files2) ../" . $i . ".gif");
    exec("rm -rf ../" . $i);
    chdir("..");
}

exec("rm *.png");
chdir("..");
exec("mv " . $name . " ../puzzles");
?>

<html>
    <body>
        <script type="text/javascript">
            window.location.href = "/";
        </script>
    </body>
</html>