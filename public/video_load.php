<?php
// Path to the video file
$path = "modules/np_task/crait_vis.mov"; // Adjust the path to your video file accordingly

// Ensure the file exists to avoid errors
if (!file_exists($path)) {
    header("HTTP/1.0 404 Not Found");
    exit;
}

$filesize = filesize($path);
$offset = 0;
$length = $filesize;

// Check if the client has sent a range request
if (isset($_SERVER['HTTP_RANGE'])) {
    $range = $_SERVER['HTTP_RANGE'];
    $range = str_replace('bytes=', '', $range);
    $range = explode('-', $range);
    $offset = intval($range[0]);
    $end = ($range[1] !== '') ? intval($range[1]) : $filesize - 1;
    $length = $end - $offset + 1;

    header('HTTP/1.1 206 Partial Content');
    header("Content-Range: bytes $offset-$end/$filesize");
}

header("Content-Type: video/mp4");
header("Accept-Ranges: bytes");
header("Content-Length: $length");
header("Content-Disposition: inline; filename=\"" . basename($path) . "\"");

$fp = fopen($path, 'rb');
fseek($fp, $offset);
echo fread($fp, $length);
fclose($fp);
?>