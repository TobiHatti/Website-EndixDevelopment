 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <meta name="viewport" content="width=device-width" /> <title>More | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>More</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <h1>More</h1> <b>Elements</b> <ul> <li><a href="/testPages/TextElements">Text-Elements</a></li> <li><a href="/testPages/FormElements">Form-Elements</a></li> </ul> <br /> <b>Test-Pages</b> <ul> <li><a href="/testPages/DefaultPage">DefaultPage</a></li> <li><a href="/testPages/ContentPAge">ContentPage</a></li> <li><a href="/testPages/AdvancedProject">AdvancedProjectPage</a></li> <li><a href="/testPages/SimpleProject">SimpleProjectPage</a></li> </ul> <b>Categories</b> <ul> <li>Tools for IT-Specialists (Surgit)</li> <li>Tools for Developers (XPS, SNMP-SCF, API2OOP, Utilis)</li> <li>Tools for Enterprices (EasRP)</li> <li>Consumer Programs (Velox, DialAssist, SimpleSudoku)</li> <li>IoT Devices and embeded systems (PiDex, PiDex2.0, Mint)</li> <li>Libraries (Atlas-API-Wrapper, WrapSQL, PHP-Library-Collection)</li> <li>Games (Tenebris)</li> </ul> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> </footer> </body> </html> 