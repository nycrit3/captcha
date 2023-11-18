# nycrite\captcha
The better way to make image CAPTCHAs.

## Why?
As a last resort, I created my own CAPTCHA generator after not wanting to use Google's reCAPTCHA. Certainly, Google's CAPTCHAs are more reliable, but I wanted to make my own alternative for certain cases.

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
