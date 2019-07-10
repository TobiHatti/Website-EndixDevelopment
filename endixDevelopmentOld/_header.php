<?php
    session_start();

    include("_headerincludes.php");

    echo '
        <!DOCTYPE html>
        <html>
            <head>
    ';

    include("_headerlinks.php");

    echo '
                <title>Endix Development</title>
            </head>
            <body id="mainBody">
                <header>

                    ';

                    if(!isset($_SESSION['firstLoadExecuted']))
                    {
                        echo '
                            <div class="startLoader">
                                <center>
                                    <div class="startLoaderImageContainer">
                                        <div class="startLogoImage">
                                            <img src="/content/LogoBackground.png" alt="" />
                                            <img src="/content/LogoCenterTransparentSmoothCutout.png" alt="" />

                                        </div>
                                        <span class="loaderTitle">Endix Development</span>
                                    </div>
                                    <div class="startLoaderCover"></div>
                                </center>
                            </div>
                        ';

                        $firstLoadMenuItems = true;
                        $firstLoadHeader = true;
                    }
                    else
                    {
                        $firstLoadMenuItems = false;
                        $firstLoadHeader = false;
                    }

                    echo '

                    <div class="headerLogoContainer" id="'.($firstLoadHeader ? 'headerLogoFlyIn' : '').'">
                        <div class="headerLogo">
                            <img src="/content/LogoBackground.png" alt="" />
                            <img src="/content/LogoCenterTransparentSmoothCutout.png" alt="" />
                        </div>
                        <div class="headerName">
                            <span class="headerTitle">Endix<br>Development</span>
                        </div>
                    </div>
                    <nav>
                        <center>
                            <ul>
                                <a href="#"><li id="'.($firstLoadMenuItems ? 'menuItem1' : '').'">Home</li></a>
                                <a href="#"><li id="'.($firstLoadMenuItems ? 'menuItem2' : '').'">Projects</li></a>
                                <a href="#"><li id="'.($firstLoadMenuItems ? 'menuItem3' : '').'">Support</li></a>
                                <a href="#"><li id="'.($firstLoadMenuItems ? 'menuItem4' : '').'">Help</li></a>
                                <a href="#"><li id="'.($firstLoadMenuItems ? 'menuItem5' : '').'">More</li></a>
                            </ul>
                        </center>
                    </nav>
                </header>
                <main>
    ';


    $_SESSION['firstLoadExecuted'] = 1;

?>