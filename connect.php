<?php
function send_post($url, $values, $cookieFile)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($values));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

    $response = curl_exec($ch);

    if ($response === false) {
        die('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}

function send_get($url, $cookieFile)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

    $response = curl_exec($ch);

    if ($response === false) {
        die('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}

$cookieFile = 'cookies.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

print "1:\n";
$url = "http://wifi.wispotter.com";
$response = send_get($url, $cookieFile);
var_dump($response);

print "2:\n";
$url = "http://redirect.wispotter.com";
$response = send_get($url, $cookieFile);
var_dump($response);

print "3:\n";
$url = "http://wifi.wispotter.com";
$response = send_get($url, $cookieFile);
var_dump($response);

print "4:\n";
$url = "http://wifi.wispotter.com/Wispotter";
$response = send_get($url, $cookieFile);
var_dump($response);

print "5:\n";
$url = "http://wifi.wispotter.com/wispotter/CNA";
$response = send_get($url, $cookieFile);
var_dump($response);

print "6:\n";
$url = "https://wifi.wispotter.com/salesapp/Login";
$response = send_get($url, $cookieFile);
var_dump($response);

print "7:\n";
$url = "http://redirect.wispotter.com";
$response = send_get($url, $cookieFile);
var_dump($response);

print "8:\n";
$url = "https://wifi.wispotter.com/salesapp/Login";
$response = send_get($url, $cookieFile);
var_dump($response);

print "9:\n";
$url_post = "https://wifi.wispotter.com/SalesApp/CardCheckCtrl";
$pass_url = "https://wifi.wispotter.com/SalesApp/CardAuthByPassport";

$initial_values = [
    "clIdH" => 14,
    "CardPin" => 11359,
    "approvecontract" => "on",
    "approvemarketing" => "on",
];

$response = send_post($url_post, $initial_values, $cookieFile);
if (!$response) {
    die("Error: No response from the server.");
}

var_dump($response);

$match = '/\"__RequestVerificationToken\" type=\"hidden\" value=\"([^\"]+)\"/i';
if (preg_match($match, $response, $matches)) {
    $RequestVerificationToken = $matches[1];
} else {
    die("Error: Unable to extract __RequestVerificationToken.");
}

$passport_values = [
    "__RequestVerificationToken" => $RequestVerificationToken,
    "ActionType" => "checkpassport",
    "CardPin" => "",
    "PassportNumber" => "XXXXXXXXXXXXXXXXX",
];

$response = send_post($pass_url, $passport_values, $cookieFile);
if (!$response) {
    die("Error: No response from the server.");
}

var_dump($response);
