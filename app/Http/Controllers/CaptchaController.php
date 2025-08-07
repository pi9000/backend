<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
        $width = 200;
        $height = 56;
        $font = public_path('fonts/Roboto-SemiBold.ttf');
        $length = 6;
        $fontSize = 29;

        $image = imagecreatetruecolor($width, $height);

        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 110, 110, 110);
        $shadowColor = imagecolorallocate($image, 120, 120, 120);
        $lineColor = imagecolorallocate($image, 110, 110, 110);


        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);


        $captchaText = substr(str_shuffle('0123456789'), 0, $length);
        Session::put('captcha', $captchaText);

        for ($i = 0; $i < 85; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }

        $bbox = imagettfbbox($fontSize, 0, $font, $captchaText);
        $textWidth = abs($bbox[2] - $bbox[0]);
        $textHeight = abs($bbox[7] - $bbox[1]);

        $xStart = ($width - $textWidth) / 2;
        $yStart = ($height + $textHeight) / 2;

        imagettftext($image, $fontSize, 0, $xStart + 1, $yStart + 1, $shadowColor, $font, $captchaText);
        imagettftext($image, $fontSize, 0, $xStart, $yStart, $textColor, $font, $captchaText);



        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    public function validateCaptcha(Request $request)
    {
        $request->validate([
            'captcha' => 'required'
        ]);

        if (Session::get('captcha') == $request->captcha) {
            return back()->with('success', 'Captcha valid!');
        } else {
            return back()->with('error', 'Captcha tidak valid, coba lagi.');
        }
    }
}
