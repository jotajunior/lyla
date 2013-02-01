<?php
if (file_exists(__DIR__.'/'.$_SERVER["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] != '/') {
    return false;
}
require __DIR__.'/../application/bootstrap.php';