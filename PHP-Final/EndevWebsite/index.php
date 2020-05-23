<?php
if(!isset($_GET['headless']))
{
    require_once("Test/Render.php");
    RenderLayout("Layouts/Layout.php");
}
?>

<h1>This is my startpage</h1>