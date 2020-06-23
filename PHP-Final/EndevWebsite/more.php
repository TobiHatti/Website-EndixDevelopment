 <?php  session_start(); ?> <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script src="https://www.google.com/recaptcha/api.js?render=6LeTnKgZAAAAAJg7aZmwhI5mXmWZY3y_mfwikNKA"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> 6LeTnKgZAAAAACacoNxWThs9E82GpVjMp_bLh4rX <meta name="viewport" content="width=device-width" /> <title>More | Endev</title> <?php       if(isset($_SESSION["CookieSessionAccepted"]) AND !isset($_COOKIE["CookiesAccepted"])) {     setcookie("CookiesAccepted", "1", time() + (10 * 365 * 24 * 60 * 60)); }      ?> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>More</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <div class="stagFade"> <article> <h1>More</h1> </article> </div> </main> <?php if(!isset($_COOKIE["CookiesAccepted"]) AND !isset($_SESSION["CookieSessionAccepted"])): ?> <div class="cookieNotify"> <div> <h6>Cookies</h6> By using this Website, you automatically accept that we use cookies. <br /> <a href="/cookies">How do we use Cookies?</a> </div> <button onclick="AcceptCookies(); HideCookieBar();">Understood</button> </div> <?php endif; ?> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="9ZEZF276ZAFXN" /> <input type="image" src="https://www.paypalobjects.com/en_US/AT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_AT/i/scr/pixel.gif" width="1" height="1" /> </form> </div> </footer> </body> </html> 