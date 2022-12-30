<?php
    namespace Nycrite\Captcha {
        class Captcha {
            public $phrase;
        
            public function __construct() {
                $this->phrase = $this->generatePhrase();
            }
    
            public function generatePhrase() {
                $phrase = "";
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $length = strlen($chars);
                for ($i = 0; $i < 6; $i++) {
                    $phrase .= $chars[rand(0, $length - 1)];
                }
                return $phrase;
            }
    
            public function image($save = false) {
                $image = imagecreate(200, 50);
                // background color is random and is not white or high contrast, it is also not too dark
                $bg = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));
                // text color is random and readable
                $text = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
                // draw the text, it is spaced out, and for each character is rotated a random amount but not too much, and is a random size, and is a random font from the fonts folder, and is a random color, and is a random position, but the text is centered both vertically and horizontally, draw each individual character
                for ($i = 0; $i < strlen($this->phrase); $i++) {
                    // pick a random font from the fonts folder
                    $files = glob("captcha/fonts/*.ttf");
                    $file = array_rand($files);
                    $font = $files[$file];
                    $size = rand(20, 30);
                    $angle = rand(-10, 10);
                    $x = 20 + ($i * 30);
                    $y = rand(30, 35);
                    imagettftext($image, $size, $angle, $x, $y, $text, $font, $this->phrase[$i]);
                }
                // draw noise, random pixels, a color relating to the background color, and a random size, not too big to obstruct the text
                for ($i = 0; $i < 1000; $i++) {
                    $noise = imagecolorallocate($image, rand(50, 100), rand(50, 100), rand(50, 100));
                    imagesetpixel($image, rand(0, 200), rand(0, 50), $noise);
                }
                // draw some random pixels, a color kinda relating to the background color, and a random size, not too big to obstruct the text
                for ($i = 0; $i < 1000; $i++) {
                    $noise = imagecolorallocate($image, rand(0, 50), rand(0, 50), rand(0, 50));
                    imagesetpixel($image, rand(0, 200), rand(0, 50), $noise);
                }
                // draw some random lines, a color kinda relating to the background color, and a random size, not too big to obstruct the text, the thickness of the line is thin
                for ($i = 0; $i < 10; $i++) {
                    $noise = imagecolorallocate($image, rand(0, 50), rand(0, 50), rand(0, 50));
                    imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise);
                }
                // draw some random wavy lines, a color kinda relating to the background color, and a random size, not too big to obstruct the text, the thickness of the line is thin
                for ($i = 0; $i < 10; $i++) {
                    $noise = imagecolorallocate($image, rand(0, 50), rand(0, 50), rand(0, 50));
                    imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise);
                }
                // draw some noise, a color not too dark, and a random size, not too big to obstruct the text, the thickness of the line is thin
                for ($i = 0; $i < 10; $i++) {
                    $noise = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
                    imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise);
                }
                // draw some noise, a color not  dark, and a random size, not too big to obstruct the text, the thickness of the line is thin
                for ($i = 0; $i < 10; $i++) {
                    $noise = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
                    imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise);
                }
                // draw white noise
                for ($i = 0; $i < 1000; $i++) {
                    $noise = imagecolorallocate($image, 255, 255, 255);
                    imagesetpixel($image, rand(0, 200), rand(0, 500), $noise);
                }
                // draw white lines, the thickness of the line is VERY thin
                for ($i = 0; $i < 10; $i++) {
                    $noise = imagecolorallocate($image, 255, 255, 255);
                    imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise);
                }
                
                ob_start();
                imagepng($image);
                $image_data = ob_get_contents();
                ob_end_clean();
    
                return $image_data;
            }
        }
    }
?>