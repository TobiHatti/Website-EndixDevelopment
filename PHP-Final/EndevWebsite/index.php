 <?php  session_start(); ?> <!DOCTYPE html> <html> <head> <?php require("data/dbConnect.php"); require("libraries/WrapMySQL.php"); require("libraries/Parsedown.php");  use PHPMailer\PHPMailer\PHPMailer; use PHPMailer\PHPMailer\SMTP; use PHPMailer\PHPMailer\Exception;  require("vendor/autoload.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <title>Home | Endev</title> <link rel="shortcut icon" type="image/x-icon" href="/content/favicon.ico"> <?php       if(isset($_SESSION["CookieSessionAccepted"]) AND !isset($_COOKIE["CookiesAccepted"])) {     setcookie("CookiesAccepted", "1", time() + (10 * 365 * 24 * 60 * 60)); }      ?> <link href="/styles/layoutStartPage.css" rel="stylesheet" /> </head> <body> <header> <div id="headerBGImage"></div> <div id="bannerCover" style="opacity: 0.5"></div> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Home</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <script>     SetProjectBanner("/content/EndevHeaderPrep.png"); </script> <?php     $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));     $sql->Open();     ?> <article> <h1>Endev <img src="/content/EndevLogo.svg" style="height: 80px; margin-bottom: -20px;"/> Software solutions for every case</h1> <p> </p> </article> <br /><br /> <div class="servicesContainer"> <div class="blur"></div> <h2>Web, Desktop, Microcontrollers</h2> <span>Development on many platforms for a wide range of applications</span> <div class="serviceBoxes"> <div> <i class="fas fa-server"></i> <strong>Web and Backend Development</strong> <p> Websites, APIs, Web-Services </p> <a href="/projects#all">More</a> </div> <div> <i class="fas fa-desktop"></i> <strong>Desktop and Mobile Development</strong> <p> Windows-Applications, Apps, Programms </p> <a href="/projects#all">More</a> </div> <div> <i class="fas fa-microchip"></i> <strong>Microcontrollers, IoT and Integrated Systems</strong> <p> Handheld-Devices, Smart-Controllers </p> <a href="/projects#all">More</a> </div> </div> </div> <article class="homeSubarticle2"> <hr /> <br /><br /> <h2>Simple, Quick, Reliable</h2> <strong>No matter what you need, we got the right solution for you</strong> <a href="/projects">View Projects</a> <em>or</em> <a href="/contact">Contact us</a> <br /><br /><br /> <hr /> </article> <h2>Learn more about our projects!</h2> <script>         window.setInterval(function(){             CycleFeaturedSlide();         }, 5000);     </script> <div class="featuredSlideContainer"> <?php $first = true;  foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE IsHidden = 0 ORDER BY RAND() ASC LIMIT 6") as $project): ?> <div class="featureSlide" style="background-image: url(<?= $project["ProjectBanner"] ?>); display: <?= $first ? "inline-block" : "inline-block" ?>"> <div class="featureBackgroundBlur sfIgnore"></div> <div class="textContainer"> <h1><?= $project["ProjectNameShort"] ?></h1> <p> <?= $project["ProjectFlavorText"] ?> <a href="/project/<?= $project["ProjectID"]?>">Read more</a> </p> </div> <a href="/project/<?= $project["ProjectID"]?>" class="featureButton"><i class="fas fa-play"></i> View Project</a> <a href="project/<?= $project["ProjectID"] ?>/downloads#content" class="featureButton"><i class="fas fa-download"></i> Download</a> </div> <?php $first = false; endforeach; ?> <div class="bulletSelector"> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(0)" style="opacity: 1;"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(1)"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(2)"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(3)"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(4)"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(5)"></span> </div> </div> <article> </article></main> <?php if(!isset($_COOKIE["CookiesAccepted"]) AND !isset($_SESSION["CookieSessionAccepted"])): ?> <div class="cookieNotify"> <div> <h6>Cookies</h6> By using this Website, you automatically accept that we use cookies. <br /> <a href="/cookies">How do we use Cookies?</a> </div> <button onclick="AcceptCookies(); HideCookieBar();">Understood</button> </div> <?php endif; ?> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/s/Website-Endev"><i class="fas fa-bug"></i> Report Bugs</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="9ZEZF276ZAFXN" /> <input type="image" src="https://www.paypalobjects.com/en_US/AT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_AT/i/scr/pixel.gif" width="1" height="1" /> </form> </div> </footer> </body> </html>