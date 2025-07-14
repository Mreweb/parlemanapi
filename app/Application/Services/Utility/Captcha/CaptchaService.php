<?php

namespace App\Application\Services;
use App\Domain\Interfaces\ICaptchaRepository;
use App\Http\Requests\CaptchaVerifyRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CaptchaService implements ICaptchaRepository{

    /* for generating captcha*/
    public function generate(){
        return $this->phpcaptcha('#162453', '#fff', 120, 40, 4, 10);
    }
    protected function phpcaptcha($textColor, $backgroundColor, $imgWidth, $imgHeight, $noiceLines = 0, $noiceDots = 0, $noiceColor = '#162453'){

        /* Settings */
        $text = rand(10001, 99999);;
        $font = public_path('font.ttf');/* font */
        $textColor = $this->hexToRGB($textColor);
        $fontSize = $imgHeight * 0.75;
        $im = imagecreatetruecolor($imgWidth, $imgHeight);
        $textColor = imagecolorallocate($im, $textColor['r'], $textColor['g'], $textColor['b']);
        $backgroundColor = $this->hexToRGB($backgroundColor);
        $backgroundColor = imagecolorallocate($im, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
        /* generating lines randomly in background of image */
        if ($noiceLines > 0) {
            $noiceColor = $this->hexToRGB($noiceColor);
            $noiceColor = imagecolorallocate($im, $noiceColor['r'], $noiceColor['g'], $noiceColor['b']);
            for ($i = 0; $i < $noiceLines; $i++) {
                imageline($im, mt_rand(0, $imgWidth), mt_rand(0, $imgHeight),
                    mt_rand(0, $imgWidth), mt_rand(0, $imgHeight), $noiceColor);
            }
        }
        if ($noiceDots > 0) {
            for ($i = 0; $i < $noiceDots; $i++) {

                imagefilledellipse($im, mt_rand(0, $imgWidth),

                    mt_rand(0, $imgHeight), 3, 3, $textColor);

            }
        }

        imagefill($im, 0, 0, $backgroundColor);
        list($x, $y) = $this->ImageTTFCenter($im, $text, $font, $fontSize);
        imagettftext($im, $fontSize, 0, $x, $y, $textColor, $font, $text);
        ob_start();
        imagejpeg($im, NULL, 90);
        $img = ob_get_clean();
        //ob_end_clean();
        imagedestroy($im);
        $uuid = Str::orderedUuid();
        DB::table('captcha')->insert([
            'captcha_id' => $uuid,
            'captcha_code' => $text,
            'created_at' => \Carbon\Carbon::now()
        ]);
        return [
            'captcha_id' => $uuid,
            'captcha_code' => $text,
            'captcha_image' => 'data:image/png;base64,'.base64_encode($img)
        ];


    }
    protected function hexToRGB($colour){

        if ($colour[0] == '#') {

            $colour = substr($colour, 1);

        }

        if (strlen($colour) == 6) {

            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);

        } elseif (strlen($colour) == 3) {

            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);

        } else {

            return false;

        }

        $r = hexdec($r);

        $g = hexdec($g);

        $b = hexdec($b);

        return array('r' => $r, 'g' => $g, 'b' => $b);

    }
    protected function ImageTTFCenter($image, $text, $font, $size, $angle = 8){

        $xi = imagesx($image);

        $yi = imagesy($image);

        $box = imagettfbbox($size, $angle, $font, $text);

        $xr = abs(max($box[2], $box[4])) + 5;

        $yr = abs(max($box[5], $box[7]));

        $x = intval(($xi - $xr) / 2);

        $y = intval(($yi + $yr) / 2);

        return array($x, $y);

    }

    /* for validating captcha*/
    public function verify(CaptchaVerifyRequest $request){
        $record = DB::table('captcha')->where('captcha_id', $request->get('captcha_id'))->first();
        if (!$record) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

        if (Carbon::parse($record->created_at)->timestamp < Carbon::now()->subMinutes(5)->timestamp) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی منقضی شده است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

        $valid = strtolower($record->captcha_code) === strtolower($request->get('captcha_code'));
        if (!$valid) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }


        if($request->get('otc')) {
            DB::table('captcha')->where('captcha_id', $request->get('captcha_id'))->delete();
        }
        return response()->json( DBMessageService::get_message(null,'SuccessAction',"احراز کد امنیتی با موفقیت انجام شد" ) , 201, [], JSON_UNESCAPED_UNICODE);
    }

}
