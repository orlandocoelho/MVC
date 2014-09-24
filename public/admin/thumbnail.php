<?php

// Example for dynamic image
// See www.mywebmymail.com for more details

if (isset($_REQUEST['thumb'])) {
    include_once('../inc/Easy.php');
    // Your full path to the images
    $dir = str_replace(chr(92),chr(47),getcwd()) . '/images/save/';
    // Create the thumbnail
    $thumb = new Easy();
    $thumb -> Thumbheight = 150;
    $thumb -> Createthumb($dir . basename($_REQUEST['thumb']));
}