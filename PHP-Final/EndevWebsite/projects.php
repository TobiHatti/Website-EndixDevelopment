 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> ; <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> ; <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> ; <meta name="viewport" content="width=device-width" /> ; <title>Projects | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Projects</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php     $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));     $sql->Open();     ?> <div class="stagFade"> <h1>Projects</h1> <h3>Featured</h3> <div class=" featuredProjects"> <?php         $i = 1;         foreach($sql->ExecuteQuery("SELECT * FROM projects ORDER BY IsFeatured DESC, RAND() ASC LIMIT 3") as $project): ?> <input type="checkbox" id="pchb<?= $i ?>" /> <label for="pchb<?= $i++ ?>"> <img src="<?= $project["ProjectBanner"] ?>" /> <span class="sfIgnore"> <b><?= $project["ProjectNameShort"] ?></b> <?= $project["ProjectFlavorText"] ?> </span> <x-pnav> <a href="/project/<?= $project["ProjectID"]?>"><i class="fas fa-play"></i> View Project</a> <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>"><i class="fab fa-github"></i> Visit on GitHub</a> <a href="/download/<?= $project["ProjectID"] ?>"><i class="fas fa-download"></i> Download</a> </x-pnav> </label> <?php endforeach; ?> </div> <br /> <hr /> <h3>More</h3> <?php $projectCatoryResultSet = $sql->ExecuteQuery("SELECT * FROM projectcategories"); ?> <div class="projectBrowser"> <ul> <?php              $i = 0;             foreach($projectCatoryResultSet as $category): ?> <li onclick="SelectProjectTab(<?= $i++ ?>)"><i class="<?= $category["CategoryFAIcon"] ?>"></i><b> <?= $category["CategoryName"] ?></b></li> <?php endforeach; ?> </ul> <div class="browser"> <?php             $first = true;                 foreach($projectCatoryResultSet as $row): ?> <div class="projectTab" <?php if($first): ?>style="display: grid"<?php endif; $first = false; ?>> <h4><i class="<?= $row["CategoryFAIcon"] ?>"></i> <?= $row["CategoryLongName"] ?></h4> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE CategoryID = ?", $row["ID"]) as $subRow): ?> <div class="projectItem"> <div><img src="<?= $subRow["ProjectBanner"] ?>" /></div> <div> <h5><?= $subRow["ProjectName"] ?></h5> <?= $subRow["ProjectFlavorText"] ?> </div> <div> <a href="/project/<?= $subRow["ProjectID"] ?>"><i class="fas fa-play"></i> View Project</a> <a href="https://github.com/TobiHatti/<?= $subRow["GithubID"] ?>" target="_blank"><i class="fab fa-github"></i> Visit on GitHub</a> <a href="/download/<?= $subRow["ProjectID"] ?>"><i class="fas fa-download"></i> Download</a> </div> </div> <?php endforeach; ?> </div> <?php endforeach; ?> </div> </div> </div> <?php $sql->Close(); ?></main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> </footer> </body> </html> 