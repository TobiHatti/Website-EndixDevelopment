 <?php  session_start();  $userAgent = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8'); if (preg_match('~MSIE|Internet Explorer~i', $userAgent) || (strpos($userAgent, 'Trident/7.0') !== false && strpos($userAgent, 'rv:11.0') !== false)) {     header("Location: /ie-support.html");     die(); } ?> <!DOCTYPE html> <html> <head> <?php require("data/dbConnect.php"); require("libraries/WrapMySQL.php"); require("libraries/Parsedown.php");  ?> <?php $build = 314; ?> <link href="/stylesV2/fontawesome.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/staggeredFade.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/textElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/formElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/stylesV2/progressiveImage.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__styleMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__layoutMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js?<?= $build ?>"></script> <script src="/scripts/CommonScripts.js?<?= $build ?>"></script> <script src="/scripts/progressiveImage.js?<?= $build ?>"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <meta name="google-site-verification" content="mIJhPJ5XZWL-5V_U8Bk3nCodCvgTeESE-YdP7QP0nlA" /> <title>Support | Endev</title> <link rel="shortcut icon" type="image/x-icon" href="/content/favicon.ico" /> <?php       if(isset($_SESSION["CookieSessionAccepted"]) AND !isset($_COOKIE["CookiesAccepted"])) {     setcookie("CookiesAccepted", "1", time() + (10 * 365 * 24 * 60 * 60)); }      ?> <link href="/stylesV2/layoutDefaultPage.min.css?<?= $build ?>" rel="stylesheet" /> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Support</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php  $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open();   function SaveIn($data) {     $data = trim($data);     $data = stripslashes($data);     $data = htmlspecialchars($data);     return $data; }  if(isset($_POST["submitReport"])) {     $type = SaveIn($_POST["type"]);     $project = SaveIn($_POST["project"]);     $os = SaveIn($_POST["os"]);     $description = SaveIn($_POST["description"]);     $fistname = SaveIn($_POST["firstname"]);     $lastname = SaveIn($_POST["lastname"]);     $email = SaveIn($_POST["email"]);      $sql->ExecuteNonQuery(         "INSERT INTO reports (ID, ReportType, Project, OS, Description, Firstname, Lastname, Email, ReportDate, Resolved) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW(), 0)",         $type, $project, $os, $description, $fistname, $lastname, $email     );      $ticketNumber = str_pad($sql->ExecuteScalar("SELECT ID FROM reports ORDER BY ID DESC"), 8, "0", STR_PAD_LEFT);      $supportTicketHTML = "     <table>         <tr>             <td>Submit-Date:</td>             <td>".date("Y-m-d H:i:s")."</td>         </tr>         <tr>             <td>Type</td>             <td>$type</td>         </tr>         <tr>             <td>Project</td>             <td>$project</td>         </tr>         <tr>             <td>OS</td>             <td>$os</td>         </tr>         <tr>             <td>Name</td>             <td>$fistname $lastname</td>         </tr>         <tr>             <td>Ticket-No.</td>             <td>$ticketNumber</td>         </tr>     </table>     <p>         <b>Message:</b>         <i>             $description         </i>     </p>     ";      $messageConsumer = "     <html>     <body>     <h1>Ticket Received!</h1>     <h4>Ticket No. $ticketNumber</h4>     <p>         Thanks for your message, we'll review your ticket and reply to you as soon as possible!     </p>     </p>         Please note, it may take up to 3 days until you receive a reply.         </p>     <hr />     <h3>Below you will find a copy of your support-ticket:</h3>     <p>         $supportTicketHTML     </p>     <hr />     <p>         This is an auto-generated message sent from <a href='https://endev.at'>endev.at</a>.<br />         Contact us at <a href='mailto:support@endev.at'>support@endev.at</a>          and include your Ticket-Number ($ticketNumber) in any further e-mails.     </p>     </body>     </html>     ";      $messageAdmin = "     <html>     <body>     <h1>New Ticket!</h1>     <h4>Ticket No. $ticketNumber</h4>     <p>         A new Ticket has been submitted via the support-form on <a href='https://endev.at'>endev.at</a>     </p>     <hr />     <h3>Below you will find a copy of the support-ticket:</h3>     <p>         $supportTicketHTML     </p>     </body>     </html>     ";      $subjectA = "Ticket Received";     $subjectB = "New Ticket";      $supportEMail = "support@endev.at";      $sql->ExecuteNonQuery("INSERT INTO mailscheduler (MailTo, MailHeader, MailMessage) VALUES (?,?,?)", $email, $subjectA, $messageConsumer);     $sql->ExecuteNonQuery("INSERT INTO mailscheduler (MailTo, MailHeader, MailMessage) VALUES (?,?,?)", $supportEMail, $subjectB, $messageAdmin);      header("Refresh:0");     die(); }   if(isset($_GET["projectID"])) {     $project = $sql->ExecuteQueryRow("SELECT * FROM projects WHERE ProjectID = ?", $_GET["projectID"]);          if(count($project) == 0)     {         header("Location: /support");         die();     } }  ?> <script src="https://www.google.com/recaptcha/api.js?render=6Ld_46gZAAAAAEfeiz2Ad4-QQtoeA8nQMSaZBWin"></script> <div class="stagFade"> <article> <?php if(isset($_GET["projectID"])): ?> <h1>Support - <?= $project["ProjectNameShort"] ?></h1> <?php else: ?> <h1>Support</h1> <?php endif; ?> <?php if(!isset($_GET["submitted"])): ?> <script>             grecaptcha.ready(function() {                 grecaptcha.execute("6Ld_46gZAAAAAEfeiz2Ad4-QQtoeA8nQMSaZBWin", {action: "homepage"})                     .then(function(token) {                     document.getElementById("submitButton").disabled = false;                 }                 );             });         </script> <h2>How can we help?</h2> <form action="?submitted" method="post" id="supportForm"> <table class="supportForm"> <tr> <td>How can we help you? *</td> <td> <select name="type" required> <option disabled>--- Please select ---</option> <option value="General Question">General question</option> <option value="Bug Report">Something's not working</option> <option value="Enhancement">Improvements / Enhancements</option> <option value="Other">Something else</option> </select> </td> </tr> <tr> <td>Project *</td> <td> <?php if(isset($_GET["projectID"])): ?> <select name="project" required> <option value="<?= $project["ProjectID"] ?>" selected><?= $project["ProjectName"] ?></option> </select> <?php else: ?> <select name="project" required> <option disabled>--- Please select ---</option> <option value="">None</option> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects") as $project): ?> <option value="<?= $project["ProjectID"] ?>"><?= $project["ProjectName"] ?></option> <?php endforeach; ?> </select> <?php endif; ?> </td> </tr> <tr> <td>Operating system</td> <td> <select name="os"> <option value="-">-</option> <optgroup label="Windows"> <option value="Win10">Windows 10</option> <option value="Win8.1">Windows 8.1</option> <option value="Win8">Windows 8</option> <option value="Win7">Windows 7</option> <option value="WinVista">Windows Vista</option> <option value="WinXP">Windows XP</option> </optgroup> <optgroup label="Other"> <option value="Linux">Linux</option> <option value="MacOS">MacOS</option> </optgroup> <optgroup label="Mobile"> <option value="Android">Android</option> <option value="iOS">iOS</option> </optgroup> <option value="Other">Other</option> </select> </td> </tr> <tr> <td colspan="2"> Please describe as detailed as possible how we can help you: * <br /> <textarea required name="description" maxlength="10000"></textarea> </td> </tr> <tr> <th colspan="2"> Contact Infos </th> </tr> <tr> <td>Firstname</td> <td><input type="text" placeholder="Firstname" name="firstname"/></td> </tr> <tr> <td>Lastname</td> <td><input type="text" placeholder="Lastname" name="lastname"/></td> </tr> <tr> <td>E-Mail *</td> <td><input type="email" placeholder="E-Mail" name="email" required/></td> </tr> <tr> <td colspan="2"> <button type="submit" name="submitReport" id="submitButton" disabled>Send</button> </td> </tr> </table> </form> <?php else: ?> <h3>Thanks for your Report!</h3> <br /> <h6> We'll review your request and reply to you as soon as possible! <br /><br /> <span style="color: lightgray;">(Please note that it may take up to 3 days until you receive a reply.)</span> </h6> <br /><br /> <h3><a href="/" style="text-decoration:none;">Back to the Start-Page</a></h3> <?php endif; ?> </article> </div> </main> <?php if(!isset($_COOKIE["CookiesAccepted"]) AND !isset($_SESSION["CookieSessionAccepted"])): ?> <div class="cookieNotify"> <div> <h6>Cookies</h6> By using this Website, you automatically accept that we use cookies. <br /> <a href="/cookies">How do we use Cookies?</a> </div> <button onclick="AcceptCookies(); HideCookieBar();">Understood</button> </div> <?php endif; ?> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/s/Website-Endev"><i class="fas fa-bug"></i> Report Bugs</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="9ZEZF276ZAFXN" /> <input type="image" src="https://www.paypalobjects.com/en_US/AT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_AT/i/scr/pixel.gif" width="1" height="1" /> </form> </div> </footer> </body> </html>  <!-- CREATED USING LPHP VERSION 1.1.0 BY ENDEV. COPYRIGHT 2020 TOBIAS HATTINGER. https://endev.at/p/LPHP -->