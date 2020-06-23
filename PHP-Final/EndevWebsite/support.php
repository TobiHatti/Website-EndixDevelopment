 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script src="https://www.google.com/recaptcha/api.js?render=6LeTnKgZAAAAAJg7aZmwhI5mXmWZY3y_mfwikNKA"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> 6LeTnKgZAAAAACacoNxWThs9E82GpVjMp_bLh4rX <meta name="viewport" content="width=device-width" /> <title>Support | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Support</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php  $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open(); ?> <div class="stagFade"> <article> <h1>Support</h1> <?php  if(!isset($_GET["page"])): ?> <h3>How can we help you?</h3> <div class="supportCategoryContainer"> <a href="/support/general">General <i class="far fa-question-circle"></i></a> <a href="/support/projects">Projects <i class="fas fa-code"></i></a> <a href="/support/website">Website <i class="fas fa-globe"></i></a> <a href="/support/licensing">Licensing <i class="fas fa-balance-scale"></i></a> <a href="/support/payments">Payments <i class="fas fa-shopping-cart"></i></a> </div> <?php elseif(strtolower($_GET["page"]) == "projects"): ?> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE IsHidden = 0") as $project): ?> <ul class="projectListView"> <li> <img src="<?= $project["ProjectLogo"] ?>" class="sfIgnore"/> <span><?= $project["ProjectName"] ?></span> <a href="/project/<?= $project["ProjectID"] ?>/support#content"> Go to project-support</a> </li> </ul> <?php endforeach; ?> <br /><br /> <h4><a href="/support" style="text-decoration: none;"><i class="fas fa-backward"></i> Go back</a></h4> <?php else: ?> <?php          switch(strtolower($_GET["page"]))         {             case "general":                 $query = "SELECT * FROM faq WHERE GeneralCategory = 'General'";                 break;             case "website":                 $query = "SELECT * FROM faq WHERE GeneralCategory = 'Website'";                 break;               case "licensing":                 $query = "SELECT * FROM faq WHERE GeneralCategory = 'Licensing'";                 break;             case "payments":                 $query = "SELECT * FROM faq WHERE GeneralCategory = 'Payments'";                 break;             default:                 echo '<meta http-equiv="refresh" content="0; url=/support">';                 die();         }          $faqResults = $sql->ExecuteQuery($query);          ?> <?php if(count($faqResults) > 0): ?> <ul class="faqContainer"> <?php foreach($faqResults as $faq): ?> <li> <div class="votes"> <span class="voteCounter"><?= $faq["Votes"] ?></span> </div> <a href="/support/faq/<?= $faq["ID"] ?>" title="Click to see the full entry"> <div class="faq"> <b><?= $faq["Question"] ?></b> <p><?= $faq["Answer"] ?></p> </div> </a> </li> <?php endforeach; ?> </ul> <?php else: ?> <h3>Sorry, there's nothing about this topic yet.</h3> <?php endif; ?> <br /><br /> <h4><a href="/support" style="text-decoration: none;"><i class="fas fa-backward"></i> Go back</a></h4> <?php endif; ?> <hr /> <h3>Got any more questions?</h3> <h3>Contact us!</h3> <div class="supportCategoryContainer"> <a href="mailto:support@endev.at">E-Mail <i class="fas fa-at"></i></a> <a href="/support/form">Support-Form<em>(Recommended)</em> <i class="fas fa-file-invoice"></i></a> <a href="#disabled">Live-Chat <i class="far fa-comment-dots"></i></a> </div> </article> </div> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> </div> </footer> </body> </html> 