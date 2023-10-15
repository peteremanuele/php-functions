<?php

 /**
 * Get a Website favicon image.
 *
 * @param string $url        website url
 * @param array  $attributes Optional, additional key/value attributes to include in the IMG tag
 *
 * @return string containing complete image tag
 */
function getFavicon($url, $attributes = [])
{
    $attr = trim(arrayToString($attributes));

    if (!empty($attr)) {
        $attr = " $attr";
    }

    return sprintf(
        '<img src="https://www.google.com/s2/favicons?domain=%s"%s/>',
        urlencode($url),
        $attr
    );
}



 /**
 * Convert Array to string.
 *
 * @param array  $array     array to convert to string
 * @param string $delimiter
 *
 * @throws \Exception
 *
 * @return string <key1>="value1" <key2>="value2"
 */
function arrayToString(array $array = [], $delimiter = ' ')
{
    $pairs = [];
    foreach ($array as $key => $value) {
        $pairs[] = "$key=\"$value\"";
    }

    return implode($delimiter, $pairs);
}



/**
 * Get a QR code.
 *
 * @param string $string     String to generate QR code for.
 * @param int    $width      QR code width
 * @param int    $height     QR code height
 * @param array  $attributes Optional, additional key/value attributes to include in the IMG tag
 *
 * @return string containing complete image tag
 */
function getQRcode($string, $width = 150, $height = 150, $attributes = [])
{
    $protocol = 'http://';
    if (isHttps()) {
        $protocol = 'https://';
    }

    $attr = trim(arrayToString($attributes));
    $apiUrl = $protocol.'chart.apis.google.com/chart?chs='.$width.'x'.$height.'&cht=qr&chl='.urlencode($string);

    return '<img src="'.$apiUrl.'" '.$attr.' />';
}

 /**
 * Check to see if the current page is being served over SSL.
 *
 * @return bool
 */
function isHttps()
{
    return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}