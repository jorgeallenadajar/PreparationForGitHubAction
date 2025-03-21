<?php

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

function hello_world()
{
    echo 5;
}


function rock_my_world($rock_this, $action)
{

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27';
    $secret_iv = 'weonlyliveonce';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($rock_this, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($rock_this), $encrypt_method, $key, 0, $iv);
    }

    return $output;

}

function position_add($arrray)
{

    foreach ($arrray as $data) {
        DB::table('ict_lib_positions')->insert([
            'position' => $data,
            'status' => 1,
            'date_created' => Carbon::now(),
        ]);
    }
}


function department_add($array)
{
    foreach ($array as $data) {
        DB::table('ict_lib_departments')->insert([
            'department' => $data,
            'status' => 1,
            'date_created' => Carbon::now(),
        ]);
    }
}


function dynamic_file($path)
{

    if (config('app.env') == 'local') {
        return url(env('APP_ENV') . $path);
    } else {
        return url(env('APP_ENV') . 'public/' . $path);
    }

}

function page_token()
{

    $randomString = Str::random(10);
    $random_num = random_token(5);
    $random_jutsu = $randomString . '-' . $random_num;
    return $random_jutsu;

}


function random_token($length = 5)
{
    $data_pool = '0123456789';
    return substr(str_shuffle(str_repeat($data_pool, $length)), 0, $length);
}





