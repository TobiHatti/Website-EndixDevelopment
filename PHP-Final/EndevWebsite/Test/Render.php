<?php

function RenderLayout($file)
{
    // Get calling file
    $callingFile = debug_backtrace()[0]["file"];

    echo 'Start_of_render<br>';

    require("../index.php?test");

    echo 'End_of_render';

    // Terminate page-loading
    die();
}