<?php include "./captcha/captcha.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunch O' CAPTCHAs!</title>
</head>
<body>
    <!-- display in a grid, style -->
    <div style="display: grid; grid-template-columns: auto auto auto auto auto; gap:2px 1px;">
        <?php
            // do this 25 times
            for ($i = 0; $i < 25; $i++) {
                $captcha = new Nycrite\Captcha\Captcha();
                $image = $captcha->image();
                // use base64 encoding to display the image in the browser
                echo "<img src='data:image/png;base64," . base64_encode($image) . "' alt='captcha'>";
            }
        ?>
    </div>
</body>
</html>