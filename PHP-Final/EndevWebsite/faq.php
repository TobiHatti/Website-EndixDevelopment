 <?php  session_start();  $userAgent = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8'); if (preg_match('~MSIE|Internet Explorer~i', $userAgent) || (strpos($userAgent, 'Trident/7.0') !== false && strpos($userAgent, 'rv:11.0') !== false)) {     header("Location: /ie-support.html");     die(); } ?> <!DOCTYPE html> <html> <head> <?php require("data/dbConnect.php"); require("libraries/WrapMySQL.php"); require("libraries/Parsedown.php");  ?> <?php $build = 314; ?> <link href="/stylesV2/fontawesome.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/staggeredFade.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/textElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/formElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/progressiveImage.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__styleMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__layoutMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js?<?= $build ?>"></script> <script src="/scripts/CommonScripts.js?<?= $build ?>"></script> <script src="/scripts/progressiveImage.js?<?= $build ?>"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <meta name="google-site-verification" content="mIJhPJ5XZWL-5V_U8Bk3nCodCvgTeESE-YdP7QP0nlA" /> <title>Support | Endev</title> <link rel="shortcut icon" type="image/x-icon" href="/content/favicon.ico" /> <?php       if(isset($_SESSION["CookieSessionAccepted"]) AND !isset($_COOKIE["CookiesAccepted"])) {     setcookie("CookiesAccepted", "1", time() + (10 * 365 * 24 * 60 * 60)); }      ?> <link href="/stylesV2/layoutDefaultPage.min.css?<?= $build ?>" rel="stylesheet" /> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Support</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <div class="stagFade"> <article> <h1>Support</h1> <?php                     $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));         $sql->Open();          $parsedown = new Parsedown();         $parsedown->setSafeMode(true);          if(!isset($_GET['id'])) echo '<meta http-equiv="refresh" content="0; url=/support">';         else $faq = $sql->ExecuteQueryRow("SELECT * FROM faq LEFT JOIN projects ON faq.ProjectID = projects.ProjectID WHERE faq.id = ?", $_GET['id']);          if(count($faq) != 0):         ?> <?php if($faq["ProjectID"] != ""): ?> <div class="pageNav"> <a href="/support">Support</a> <a href="/support/projects">Projects</a> <a href="/project/<?= $faq["ProjectID"]?>"><?= $faq["ProjectName"] ?></a> </div> <?php else: ?> <div class="pageNav"> <a href="/support">Support</a> <a href="/support/<?= $faq["GeneralCategory"] ?>"><?= $faq["GeneralCategory"] ?></a> </div> <?php endif; ?> <h2><?= $parsedown->text('Q: '.$faq["Question"]) ?></h2> <p> <?php if($faq["Votes"] > 0): ?> <?= $faq["Votes"] ?> People found this usefull:<br /> <?php endif; ?> <?= $parsedown->text($faq["Answer"]) ?> </p> <br /> <?php if(!isset($_COOKIE['endevFAQSurvey'.$faq['ID']])): ?> <form action="" method="post" class="voteBox"> <span>Did you find this answer usefull?</span> <input type="hidden" value="<?= $faq['ID'] ?>" name="faqID"/> <button type="submit" name="faqUpvote"> <i class="far fa-thumbs-up sfIgnore"></i> Yes </button> <button type="submit" name="faqDownvote"> <i class="far fa-thumbs-down sfIgnore"></i> No </button> </form> <?php else: ?> <p style="color: #ccc;">Thank you for voting!</p> <?php endif; ?> <?php else: ?> <meta http-equiv="refresh" content="0; url=/support"> <?php endif; ?> <br /><br /> <h4><a href="/support" style="text-decoration: none;"><i class="fas fa-backward"></i> Go back</a></h4> </article> </div> </main> <?php if(!isset($_COOKIE["CookiesAccepted"]) AND !isset($_SESSION["CookieSessionAccepted"])): ?> <div class="cookieNotify"> <div> <h6>Cookies</h6> By using this Website, you automatically accept that we use cookies. <br /> <a href="/cookies">How do we use Cookies?</a> </div> <button onclick="AcceptCookies(); HideCookieBar();">Understood</button> </div> <?php endif; ?> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/s/Website-Endev"><i class="fas fa-bug"></i> Report Bugs</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="9ZEZF276ZAFXN" /> <input type="image" src="https://www.paypalobjects.com/en_US/AT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_AT/i/scr/pixel.gif" width="1" height="1" /> </form> </div> </footer> </body> </html>  <!-- CREATED USING LPHP VERSION 1.1.0 BY ENDEV. COPYRIGHT 2020 TOBIAS HATTINGER. https://endev.at/p/LPHP -->