<?php


class imgmanager
{
    public static $imgdir = __DIR__ . "/img/";

    public function createIMG($name,$backgroundhex,$colorhex,int $width,int $height,$txt,$txtx,$txty,$txtfont){
        $image = imagecreate($width, $height);

        $bgrgb= explode (",",self::hex2rgb($backgroundhex));
        $txtgb= explode (",",self::hex2rgb($colorhex));

        $background_color = imagecolorallocate($image,  $bgrgb[0], $bgrgb[1], $bgrgb[2]);

        imagefill($image, 0, 0, $background_color);

        $image_color = imagecolorallocate($image, $txtgb[0], $txtgb[1], $txtgb[2]);
        $y = $txty;

        foreach($txt as $tx) {
            imagestring($image, $txtfont, $txtx, $y, $tx, $image_color);
            $y=+($txtfont);
        }
        header('Content-type: image/png');

        imagepng($image, __DIR__ . "/img/" .$name.".png");
        imagedestroy($image);
        return __DIR__ . "/img/" .$name.".png";
    }

    public function createMapIMG($name,$backgroundhex,$colorhex,int $zoom,int $width,int $height,$txt,$txtx,$txty,$txtfont){
        $zoomumrechnet=0;
        if($zoom==1){
            $zoomrechnet = 256;
        }else if($zoom==2){
            $zoomrechnet = 512;
        }else if($zoom==3){
            $zoomrechnet = 1024;
        }else if($zoom==4){
            $zoomrechnet = 2048;
        }else{
            $zoomumrechnet = 128;
        }
        $image = imagecreate($zoomrechnet*$width, $zoomrechnet*$height);

        $bgrgb= explode (",",self::hex2rgb($backgroundhex));
        $txtgb= explode (",",self::hex2rgb($colorhex));

        $background_color = imagecolorallocate($image,  $bgrgb[0], $bgrgb[1], $bgrgb[2]);

        imagefill($image, 0, 0, $background_color);

        $image_color = imagecolorallocate($image, $txtgb[0], $txtgb[1], $txtgb[2]);
        $y = $txty;

        foreach($txt as $tx) {
            imagestring($image, $txtfont, $txtx, $y, $tx, $image_color);
            $y=+($txtfont);
        }
        header('Content-type: image/png');

        imagepng($image, __DIR__ . "/img/" .$name.".png");
        imagedestroy($image);

        if(PHP_OS!=="WINNT") {
          $verzeichnis = __DIR__ . "/img/split/" . $name;
        }else{
            $verzeichnis = __DIR__ . "\\img\\split\\" . $name;
        }
        mkdir($verzeichnis);

        $source = imagecreatefrompng(__DIR__ . "/img/" .$name.".png");
        $source_width = imagesx( $source );
        $source_height = imagesy( $source );

        for( $col = 0; $col < $source_width / $zoomrechnet*$width; $col++)
        {
            for( $row = 0; $row < $source_height / $zoomrechnet*$height; $row++)
            {
                $fn = __DIR__ . "/img/split/" .$col."-".$row.".png";

                $im = @imagecreatetruecolor( $width, $height );
                imagecopyresized( $im, $source, 0, 0,
                    $col * $width, $row * $height, $width, $height,
                    $width, $height );
                imagepng( $im, $fn );
                imagedestroy( $im );
            }
        }
        unlink(__DIR__ . "/img/" .$name.".png");

        return __DIR__ . "/img/split/";
    }

    public function imagenewsize(resource $image, int $width, int $height){
        return imagescale($image, $width,$height, IMG_PNG);
    }

    public function imagecut($fileimg,$name,int $startwidth,int $startheight,int $endwidth,int $endheight): string{
        $im = imagecreatefrompng($fileimg);
        $im2 = imcrop($im, ['x'=> $startwidth, 'y'=>$startheight,'width'=>$endwidth,'height'=>$endheight]);
        if ($im2 !== FALSE) {
            imagepng($im2, __DIR__ . "/img/cut/" .$name.".png");
            imagedestroy($im2);
        }
        imagedestroy($im);
        return __DIR__ . "/img/cut/" .$name.".png";
    }

    public function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        switch (strlen($hex)) {
            case 1:
                $hex = $hex.$hex;
            case 2:
                $r = hexdec($hex);
                $g = hexdec($hex);
                $b = hexdec($hex);
                break;

            case 3:
                $r = hexdec(substr($hex,0,1).substr($hex,0,1));
                $g = hexdec(substr($hex,1,1).substr($hex,1,1));
                $b = hexdec(substr($hex,2,1).substr($hex,2,1));
                break;

            default:
                $r = hexdec(substr($hex,0,2));
                $g = hexdec(substr($hex,2,2));
                $b = hexdec(substr($hex,4,2));
                break;
        }

        $rgb = array($r, $g, $b);
        return implode(",", $rgb);
    }

    public function getIMGList():array{
        require_once(__DIR__ . "/../divscan/scan.php");
        return (scanDir::scan(self::$imgdir, array("png")));
    }

    public function deleteFile($name){
    $file = self::$imgdir.$name.".png";
    if (file_exists($file)) {
        unlink($file);
    }
}

    public function saveimage($inPath,$outPath)
    {
        $in=    fopen($inPath, "rb");
        $out=   fopen($outPath, "wb");
        while ($chunk = fread($in,8192))
        {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }

}