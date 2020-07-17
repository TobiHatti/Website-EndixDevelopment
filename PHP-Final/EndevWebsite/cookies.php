 <?php  session_start();  $userAgent = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8'); if (preg_match('~MSIE|Internet Explorer~i', $userAgent) || (strpos($userAgent, 'Trident/7.0') !== false && strpos($userAgent, 'rv:11.0') !== false)) {     header("Location: /ie-support.html");     die(); } ?> <!DOCTYPE html> <html> <head> <?php require("data/dbConnect.php"); require("libraries/WrapMySQL.php"); require("libraries/Parsedown.php");  ?> <?php $build = 314; ?> <link href="/stylesV2/fontawesome.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/staggeredFade.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/textElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/formElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/progressiveImage.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__styleMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__layoutMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js?<?= $build ?>"></script> <script src="/scripts/CommonScripts.js?<?= $build ?>"></script> <script src="/scripts/progressiveImage.js?<?= $build ?>"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <meta name="google-site-verification" content="mIJhPJ5XZWL-5V_U8Bk3nCodCvgTeESE-YdP7QP0nlA" /> <title>Cookies | Endev</title> <link rel="shortcut icon" type="image/x-icon" href="/content/favicon.ico" /> <?php       if(isset($_SESSION["CookieSessionAccepted"]) AND !isset($_COOKIE["CookiesAccepted"])) {     setcookie("CookiesAccepted", "1", time() + (10 * 365 * 24 * 60 * 60)); }      ?> <link href="/stylesV2/layoutDefaultPage.min.css?<?= $build ?>" rel="stylesheet" /> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Cookies</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <div class="stagFade"> <article> <h1>What do we use cookies for?</h1> <p>Last updated: June 24, 2020</p> <p>This Cookies Policy explains what Cookies are and how We use them. You should read this policy so You can understand what type of cookies We use, or the information We collect using Cookies and how that information is used. Our Cookies Policy is maintained by the <a href="https://www.privacypolicies.com/cookies-policy-generator/">Cookies Policy Generator</a>.</p> <p>Cookies do not typically contain any information that personally identifies a user, but personal information that we store about You may be linked to the information stored in and obtained from Cookies. For further information on how We use, store and keep your personal data secure, see our Privacy Policy.</p> <p>We do not store sensitive personal information, such as mailing addresses, account passwords, etc. in the Cookies We use.</p> <h1>Interpretation and Definitions</h1> <h2>Interpretation</h2> <p>The words of which the initial letter is capitalized have meanings defined under the following conditions.</p> <p>The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p> <h2>Definitions</h2> <p>For the purposes of this Cookies Policy:</p> <ul> <li><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Cookies Policy) refers to Endev.</li> <li><strong>You</strong> means the individual accessing or using the Website, or a company, or any legal entity on behalf of which such individual is accessing or using the Website, as applicable.</li> <li><strong>Cookies</strong> means small files that are placed on Your computer, mobile device or any other device by a website, containing details of your browsing history on that website among its many uses.</li> <li><strong>Website</strong> refers to Endev, accessible from https://endev.at.</li> </ul> <h1>The use of the Cookies</h1> <h2>Type of Cookies We Use</h2> <p>Cookies can be "Persistent" or "Session" Cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p> <p>We use both session and persistent Cookies for the purposes set out below:</p> <ul> <li> <p><strong>Necessary / Essential Cookies</strong> <p>Type: Session Cookies</p> <p>Administered by: Us</p> <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p> </li> <li> <p><strong>Functionality Cookies</strong></p> <p>Type: Persistent Cookies</p> <p>Administered by: Us</p> <p>Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p> </li> </ul> <h2>Your Choices Regarding Cookies</h2> <p>If You prefer to avoid the use of Cookies on the Website, first You must disable the use of Cookies in your browser and then delete the Cookies saved in your browser associated with this website. You may use this option for preventing the use of Cookies at any time.</p> <p>If You do not accept Our Cookies, You may experience some inconvenience in your use of the Website and some features may not function properly.</p> <p>If You'd like to delete Cookies or instruct your web browser to delete or refuse Cookies, please visit the help pages of your web browser.</p> <ul> <li>For the Chrome web browser, please visit this page from Google: https://support.google.com/accounts/answer/32050</li> <li>For the Internet Explorer web browser, please visit this page from Microsoft: http://support.microsoft.com/kb/278835</li> <li>For the Firefox web browser, please visit this page from Mozilla: https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</li> <li>For the Safari web browser, please visit this page from Apple: https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</li> </ul> <p>For any other web browser, please visit your web browser's official web pages.</p> <h2>More Information about Cookies</h2> <p>You can learn more about cookies in the <a href="https://www.privacypolicies.com/blog/cookies/">"What Are Cookies"</a> article.</p> <h2>Contact Us</h2> <p>If you have any questions about this Cookies Policy, You can contact us:</p> <ul> <li>By email: office@endev.at</li> <li>By visiting this page on our website: https://endev.at/contact</li> </ul> </article> </div> </main> <?php if(!isset($_COOKIE["CookiesAccepted"]) AND !isset($_SESSION["CookieSessionAccepted"])): ?> <div class="cookieNotify"> <div> <h6>Cookies</h6> By using this Website, you automatically accept that we use cookies. <br /> <a href="/cookies">How do we use Cookies?</a> </div> <button onclick="AcceptCookies(); HideCookieBar();">Understood</button> </div> <?php endif; ?> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/s/Website-Endev"><i class="fas fa-bug"></i> Report Bugs</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="9ZEZF276ZAFXN" /> <input type="image" src="https://www.paypalobjects.com/en_US/AT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_AT/i/scr/pixel.gif" width="1" height="1" /> </form> </div> </footer> </body> </html>  <!-- CREATED USING LPHP VERSION 1.0.0 BY ENDEV. COPYRIGHT 2020 TOBIAS HATTINGER. https://endev.at/p/LPHP -->