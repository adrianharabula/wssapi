<?php
$cache_life = 60 * 60 * 24 * 100; //caching time, in seconds
$vw = 1024;
$vh = 768;
$maxHeight = 500;
$paddingTop = 0;
$paddingLeft = 0;
$r = 0;
$download = intval(0);
$there = '/path/to/capture.js/and/resize.js';

if (!isset($_REQUEST['url'])) {
    exit();
}
$url = $_REQUEST['url'];

$url = trim(urldecode($url));
if ($url == '') {
    exit();
}

if (!stristr($url, 'http://') and !stristr($url, 'https://')) {
   $url = 'http://' . $url;
}

$url_segs = parse_url($url);
if (!isset($url_segs['host'])) {
    exit();
}

$here = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$cache = $here . 'cache' . DIRECTORY_SEPARATOR;

if (!is_dir($cache)) {
    mkdir($cache);
    file_put_contents($cache . 'index.php', '<?php exit(); ?>');
}

if (isset($_REQUEST['vw'])) {
    $vw = intval($_REQUEST['vw']);
}

if (isset($_REQUEST['vh'])) {
    $vh = intval($_REQUEST['vh']);
}

if (isset($_REQUEST['maxHeight'])) {
    $maxHeight = intval($_REQUEST['maxHeight']);
}

if (isset($_REQUEST['paddingTop'])) {
    $paddingTop = intval($_REQUEST['paddingTop']);
}

if (isset($_REQUEST['paddingLeft'])) {
    $paddingLeft = intval($_REQUEST['paddingLeft']);
}

if (isset($_REQUEST['r'])) {
    $r = intval($_REQUEST['r']);
}

if (isset($_REQUEST['download'])) {
    $download = intval($_REQUEST['download']);
}

$url = strip_tags($url);
$url = str_replace(';', '', $url);
$url = str_replace('"', '', $url);
$url = str_replace('\'', '/', $url);
$url = str_replace('<?', '', $url);
$url = str_replace('<?', '', $url);
$url = str_replace('\077', ' ', $url);

$screen_file = $url_segs['host'] . crc32($url) .'_' . $vw . 'x' . $vh . "MH" . $maxHeight . "R" . $r . 'top' . $paddingTop. 'left' . $paddingLeft . '.jpg';
$cache_job = $cache . $screen_file;

$refresh = false;
if (is_file($cache_job)) {
    $filemtime = @filemtime($cache_job); // returns FALSE if file does not exist
    if (!$filemtime or (time() - $filemtime >= $cache_life)) {
        $refresh = true;
    }
}

$url = escapeshellcmd($url);

if (!is_file($cache_job) or $refresh == true) {
    $exec = 'cd ' . $there . ' && /usr/local/bin/casperjs ' . $there . 'capture.js ' . $url . ' R' . $screen_file . ' ' . $vw . ' ' . $vh . ' ' . $maxHeight . ' ' . $paddingTop . ' ' . $paddingLeft;
    if ($r != 0) $exec .= ' && /usr/bin/node resize.js ' . $screen_file . ' '. $r;

    exec($exec);

    // Move resized ss to www
    if ($r == 0 && is_file($there . 'R' . $screen_file)) rename($there . 'R' . $screen_file, $cache_job); else
    if (is_file($there . $screen_file)) rename($there . $screen_file, $cache_job);

    // Remove un-resized ss to www
    if ($r != 0 && is_file($there . 'R' . $screen_file)) {
        unlink($there . 'R' . $screen_file);
    }
}

if (is_file($cache_job)) {
    // download the file if specified
    if ($download != 0) {
        $file = $cache_job;
        $file_name=basename($file);
        $type = 'image/jpeg';
        header("Content-disposition: attachment; filename={$file_name}");
        header("Content-type: {$type}");
        readfile($file);
    } else { // otherwise just show it in the webpage
        $file = $cache_job;
        $type = 'image/jpeg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}
