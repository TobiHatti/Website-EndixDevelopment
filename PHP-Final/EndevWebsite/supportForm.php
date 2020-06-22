 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <title>Support | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Support</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php  $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open();  function SaveIn($data) {     $data = trim($data);     $data = stripslashes($data);     $data = htmlspecialchars($data);     return $data; }  if(isset($_POST["submitReport"])) {     $type = SaveIn($_POST["type"]);     $project = SaveIn($_POST["project"]);     $os = SaveIn($_POST["os"]);     $description = SaveIn($_POST["description"]);     $fistname = SaveIn($_POST["firstname"]);     $lastname = SaveIn($_POST["lastname"]);     $email = SaveIn($_POST["email"]);      $sql->ExecuteNonQuery(         "INSERT INTO reports (ID, ReportType, Project, OS, Description, Firstname, Lastname, Email, ReportDate, Resolved) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW(), 0)",         $type, $project, $os, $description, $fistname, $lastname, $email     );      header("Refresh:0");     die(); }  ?> <div class="stagFade"> <article> <h1>Support</h1> <?php if(!isset($_GET["submitted"])): ?> <h2>How can we help?</h2> <form action="?submitted" method="post"> <table class="supportForm"> <tr> <td>How can we help you? *</td> <td> <select name="type" required> <option disabled>--- Please select ---</option> <option value="General Question">General question</option> <option value="Bug Report">Something's not working</option> <option value="Enhancement">Improvements / Enhancements</option> <option value="Other">Something else</option> </select> </td> </tr> <tr> <td>Project *</td> <td> <select name="project" required> <option disabled>--- Please select ---</option> <option value="">None</option> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects") as $project): ?> <option value="<?= $project["ProjectID"] ?>"><?= $project["ProjectName"] ?></option> <?php endforeach; ?> </select> </td> </tr> <tr> <td>Operating system</td> <td> <select name="os"> <option value="-">-</option> <optgroup label="Windows"> <option value="Win10">Windows 10</option> <option value="Win8.1">Windows 8.1</option> <option value="Win8">Windows 8</option> <option value="Win7">Windows 7</option> <option value="WinVista">Windows Vista</option> <option value="WinXP">Windows XP</option> </optgroup> <optgroup label="Other"> <option value="Linux">Linux</option> <option value="MacOS">MacOS</option> </optgroup> <optgroup label="Mobile"> <option value="Android">Android</option> <option value="iOS">iOS</option> </optgroup> <option value="Other">Other</option> </select> </td> </tr> <tr> <td colspan="2"> Please describe as detailed as possible how we can help you: * <br /> <textarea required name="description" maxlength="10000"></textarea> </td> </tr> <tr> <th colspan="2"> Contact Infos </th> </tr> <tr> <td>Firstname</td> <td><input type="text" placeholder="Firstname" name="firstname"/></td> </tr> <tr> <td>Lastname</td> <td><input type="text" placeholder="Lastname" name="lastname"/></td> </tr> <tr> <td>E-Mail *</td> <td><input type="email" placeholder="E-Mail" name="email" required/></td> </tr> <tr> <td colspan="2"> CAPTCHA </td> </tr> <tr> <td colspan="2"> <button type="submit" name="submitReport">Send</button> </td> </tr> </table> </form> <?php else: ?> <h3>Thanks for your Report!</h3> <br /> <h6> We'll review your request and reply to you as soon as possible! <br /><br /> <span style="color: lightgray;">(Please note that it may take up to 3 days until you receive a reply.)</span> </h6> <br /><br /> <h3><a href="/" style="text-decoration:none;">Back to the Start-Page</a></h3> <?php endif; ?> </article> </div> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> <a href="/contact"><i class="far fa-address-book"></i> Contact</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> </div> </footer> </body> </html> 