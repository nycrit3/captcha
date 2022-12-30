# nycrite\captcha
The better way to make image CAPTCHAs.

## Why?
I wanted to create the library to both create my first PHP package and because there were no other CAPTCHA creators out there. I was looking for one when I finally had to cave in and create my own.

## Usage
First, initalize the CAPTCHA generator as so:
```php
$captcha = new Nycrite\Captcha\Captcha();
$image = $captcha->image();
```
Optionally, if you are using the CAPTCHA creator for forms (you most likely are), you can save it to a session.
```php
$_SESSION['phrase'] = $captcha->phrase;
```
Next, output the image by encoding it in base64.
```php
echo "<img src='data:image/png;base64," . base64_encode($image) . "' alt='captcha'>";
```
