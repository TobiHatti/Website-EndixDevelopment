 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script src="https://www.google.com/recaptcha/api.js?render=6LeTnKgZAAAAAJg7aZmwhI5mXmWZY3y_mfwikNKA"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> 6LeTnKgZAAAAACacoNxWThs9E82GpVjMp_bLh4rX <meta name="viewport" content="width=device-width" /> <title>Support | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Support</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <div class="stagFade"> <article> <h1>Support</h1> <?php                     $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));         $sql->Open();          $parsedown = new Parsedown();         $parsedown->setSafeMode(true);          if(!isset($_GET['id'])) echo '<meta http-equiv="refresh" content="0; url=/support">';         else $faq = $sql->ExecuteQueryRow("SELECT * FROM faq LEFT JOIN projects ON faq.ProjectID = projects.ProjectID WHERE faq.id = ?", $_GET['id']);          if(count($faq) != 0):         ?> <?php if($faq["ProjectID"] != ""): ?> <div class="pageNav"> <a href="/support">Support</a> <a href="/support/projects">Projects</a> <a href="/project/<?= $faq["ProjectID"]?>"><?= $faq["ProjectName"] ?></a> </div> <?php else: ?> <div class="pageNav"> <a href="/support">Support</a> <a href="/support/<?= $faq["GeneralCategory"] ?>"><?= $faq["GeneralCategory"] ?></a> </div> <?php endif; ?> <h2><?= $parsedown->text('Q: '.$faq["Question"]) ?></h2> <p> <?php if($faq["Votes"] > 0): ?> <?= $faq["Votes"] ?> People found this usefull:<br /> <?php endif; ?> <?= $parsedown->text($faq["Answer"]) ?> </p> <br /> <?php if(!isset($_COOKIE['endevFAQSurvey'.$faq['ID']])): ?> <form action="" method="post" class="voteBox"> <span>Did you find this answer usefull?</span> <input type="hidden" value="<?= $faq['ID'] ?>" name="faqID"/> <button type="submit" name="faqUpvote"> <i class="far fa-thumbs-up sfIgnore"></i> Yes </button> <button type="submit" name="faqDownvote"> <i class="far fa-thumbs-down sfIgnore"></i> No </button> </form> <?php else: ?> <p style="color: #ccc;">Thank you for voting!</p> <?php endif; ?> <?php else: ?> <meta http-equiv="refresh" content="0; url=/support"> <?php endif; ?> <br /><br /> <h4><a href="/support" style="text-decoration: none;"><i class="fas fa-backward"></i> Go back</a></h4> </article> </div> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> </div> </footer> </body> </html> 