 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <meta name="viewport" content="width=device-width" /> <title>Downloads | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Downloads</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php   $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open();  ?> <h1>Downloads</h1> <article> <h2>Open Source and Freeware</h2> <hr /> <div class="sortDropdown"> <span>Sort by:</span> <select> <option>Category</option> <option>Name</option> </select> </div> <div class="downloadProjectRaster"> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE IsOpenSource = 1") as $project): ?> <div class="rasterBox"> <img src="<?= $project["ProjectBanner"] ?>" /> <div class="boxInfo"> <h5><?= $project["ProjectNameShort"] ?></h5> </div> </div> <?php endforeach; ?> </div> <h2>Closed Source and Proprietary Software</h2> <hr /> <div class="sortDropdown"> <span>Sort by:</span> <select> <option>Category</option> <option>Name</option> </select> </div> <div class="downloadProjectRaster"> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE IsOpenSource = 0") as $project): ?> <div class="rasterBox"> <div class="<?= $project["IsWIP"] ? "filterWIP" : "" ?> <?= $project["IsDiscontinued"] ? "filterDiscontinued" : "" ?> <?= false ? "filterSale" : "" ?>"> <img src="<?= $project["ProjectBanner"] ?>" /> </div> <div class="boxInfo"> <h5><?= $project["ProjectName"] ?></h5> </div> </div> <?php endforeach; ?> </div> </article></main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> </footer> </body> </html> 