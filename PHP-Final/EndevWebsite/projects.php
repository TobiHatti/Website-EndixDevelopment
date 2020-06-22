 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <title>Projects | Endev</title> </head> <body> <header> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Projects</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php     $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));     $sql->Open();     ?> <div class="stagFade"> <h1>Projects</h1> <h2>Featured</h2> <br /> <script>         window.setInterval(function(){             CycleFeaturedSlide();         }, 5000);     </script> <div class="featuredSlideContainer"> <?php $first = true;  foreach($sql->ExecuteQuery("SELECT * FROM projects ORDER BY IsFeatured DESC, RAND() ASC LIMIT 3") as $project): ?> <div class="featureSlide" style="background-image: url(<?= $project["ProjectBanner"] ?>); display: <?= $first ? "inline-block" : "inline-block" ?>"> <div class="featureBackgroundBlur sfIgnore"></div> <div class="textContainer"> <h1><?= $project["ProjectNameShort"] ?></h1> <p> <?= $project["ProjectFlavorText"] ?> <a href="/project/<?= $project["ProjectID"]?>">Read more</a> </p> </div> <a href="/project/<?= $project["ProjectID"]?>" class="featureButton"><i class="fas fa-play"></i> View Project</a> <a href="project/<?= $project["ProjectID"] ?>/downloads#content" class="featureButton"><i class="fas fa-download"></i> Download</a> </div> <?php $first = false; endforeach; ?> <div class="bulletSelector"> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(0)" style="opacity: 1;"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(1)"></span> <span class="sfIgnore slideBullet" onclick="SelectFeaturedSlide(2)"></span> </div> </div> <br /> <h3>All Projects</h3> <br /> <?php $projectCatoryResultSet = $sql->ExecuteQuery("SELECT * FROM projectcategories"); ?> <div class="projectBrowser"> <ul> <?php              $i = 0;             foreach($projectCatoryResultSet as $category): ?> <li onclick="SelectProjectTab(<?= $i++ ?>)"><i class="<?= $category["CategoryFAIcon"] ?>"></i><b> <?= $category["CategoryName"] ?></b></li> <?php endforeach; ?> </ul> <div class="browser"> <?php             $first = true;                 foreach($projectCatoryResultSet as $row): ?> <div class="projectTab" <?php if($first): ?>style="display: grid"<?php endif; $first = false; ?>> <h4><i class="<?= $row["CategoryFAIcon"] ?>"></i> <?= $row["CategoryLongName"] ?></h4> <?php foreach($sql->ExecuteQuery("SELECT * FROM projects WHERE CategoryID = ?", $row["ID"]) as $subRow): ?> <div class="projectItem"> <div> <a href="/project/<?= $subRow["ProjectID"] ?>"> <img src="<?= $subRow["ProjectBanner"] ?>" /> </a> </div> <div> <h5> <?= $subRow["ProjectName"] ?> <?= $subRow["IsWIP"] ? '<span class="badgeWIP"></span>' : '' ?> <?= $subRow["IsOnSale"] ? '<span class="badgeSale"></span>' : '' ?> <?= $subRow["IsDiscontinued"] ? '<span class="badgeDiscontinued"></span>' : '' ?> </h5> <?= $subRow["ProjectFlavorText"] ?> </div> <div> <a href="/project/<?= $subRow["ProjectID"] ?>"><i class="fas fa-play"></i> View Project</a> <a href="https://github.com/TobiHatti/<?= $subRow["GithubID"] ?>" target="_blank"><i class="fab fa-github"></i> Visit on GitHub</a> <?php if(!$subRow["IsWIP"] AND !$subRow["IsDiscontinued"]): ?> <?php if($subRow["IsFree"]): ?> <a href="project/<?= $subRow["ProjectID"] ?>/downloads#content"><i class="fas fa-download"></i> Download</a> <?php else: ?> <a href="#"><i class="fas fa-shopping-cart"></i> Buy</a> <?php endif; ?> <?php endif; ?> </div> </div> <?php endforeach; ?> </div> <?php endforeach; ?> </div> </div> </div> <?php $sql->Close(); ?></main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> <a href="/contact"><i class="far fa-address-book"></i> Contact</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> </div> </footer> </body> </html> 