 <!DOCTYPE html> <html> <head> <?php include("data/dbConnect.php"); include("libraries/WrapMySQL.php"); include("libraries/Parsedown.php"); ?> <link href="/styles/fontawesome.min.css" rel="stylesheet" /> <link href="/styles/style.min.css" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css" rel="stylesheet" /> <link href="/styles/textElements.min.css" rel="stylesheet" /> <link href="/styles/formElements.min.css" rel="stylesheet" /> <link href="/styles/layoutGeneral.min.css" rel="stylesheet" /> <script src="/scripts/jquery-3.5.1.min.js"></script> <script src="/scripts/PageLayout.js"></script> <script src="/scripts/CommonScripts.js"></script> <script> window.FontAwesomeConfig = {     searchPseudoElements: true } </script> <meta name="viewport" content="width=device-width" /> <title>Projects | Endev</title> <link href="/styles/layoutAdvancedProject.css" rel="stylesheet" /> </head> <body> <header style="overflow: hidden;"> <div id="headerBGImage"></div> <div id="bannerCover" style="opacity: 0.5"> </div> <h1 id="headerProjectTitle"></h1> <a href="/"> <div class="endevLogo" id="endevLogo"></div> <div class="endevLogoSticky" id="endevLogoSticky"></div> </a> <nav class="default"> <div class="fullWidthMenu"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> </div> <div class="mobileMenu stagFade"> <label for="toggleMobileMenuOverlay"><span>Projects</span><a><i class="fa fa-bars"></i></a></label> <input type="checkbox" id="toggleMobileMenuOverlay" onchange="ShowElementIfChecked(this, 'mobileMenuOverlay')"/> <div class="mobileMenuOverlay" id="mobileMenuOverlay"> <a href="/">Home</a> <a href="/projects">Projects</a> <a href="/support">Support</a> <a href="/downloads">Downloads</a> <a href="/contact">Contact</a> <a href="/more">More</a> <label for="toggleMobileMenuOverlay"><a>Close</a></label> </div> </div> </nav> <nav class="default" style="display: none;"></nav> <div class="breakpointCheck"></div> </header> <main> <?php                                                                 
if(isset($_GET['projectID'])) $projectID = $_GET['projectID']; else {     header("Location: /projects");     die(); }  if(isset($_GET['page']) AND $_GET['page'] == -1)  {     header("Location: /project/".$projectID);     die(); }  $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open();  $parsedown = new Parsedown(); $parsedown->setSafeMode(true);                                                                  
$project = $sql->ExecuteQueryRow("SELECT * FROM projects WHERE ProjectID = ?", $projectID); if($project == null) {     header("Location: /projects");     die(); } ?> <aside> <ul> <li onclick="SelectProjectPage(0, '<?= $project["ProjectID"] ?>', 'Overview')"><i class="fas fa-home"></i> <span>Overview</span></li> <li onclick="SelectProjectPage(1, '<?= $project["ProjectID"] ?>', 'Support')"><i class="fas fa-headset"></i> <span>Support &amp; FAQ</span></li> <li onclick="SelectProjectPage(2, '<?= $project["ProjectID"] ?>', 'Issues')"><i class="fas fa-exclamation-circle"></i> <span>Issues</span></li> <li onclick="SelectProjectPage(3, '<?= $project["ProjectID"] ?>', 'Downloads')"><i class="fas fa-download"></i> <span>Downloads</span></li> <li onclick="SelectProjectPage(4, '<?= $project["ProjectID"] ?>', 'Version-History')"><i class="fas fa-history"></i> <span>Version History</span></li> <li onclick="SelectProjectPage(5, '<?= $project["ProjectID"] ?>', 'Readme')"><i class="fas fa-book-reader"></i> <span>Readme</span></li> <li onclick="SelectProjectPage(6, '<?= $project["ProjectID"] ?>', 'Tech-Info')"><i class="fas fa-cogs"></i> <span>Tech. Information</span></li> <li onclick="SelectProjectPage(7, '<?= $project["ProjectID"] ?>', 'License')"><i class="fas fa-file-alt"></i> <span>License</span></li> </ul> </aside> <script>     SetProjectTitle("<?= $project["ProjectNameShort"]?>");     SetProjectBanner("<?= $project["ProjectBanner"]?>"); </script> <?php   function TabPageSelected($tabIndex, $isDefaultTab = false) {     if(isset($_GET['page']) AND $_GET['page'] >= 0 AND $_GET['page'] <= 7)     {         if($_GET['page'] == $tabIndex) return "block";         else return "none";     }     else if($isDefaultTab) return "block";     else return "none"; }  function GetGithubAPIResponse($url) {     $curl = curl_init();      curl_setopt_array($curl, [     CURLOPT_URL => $url,     CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',     CURLOPT_TIMEOUT => 30,     CURLOPT_RETURNTRANSFER => 1,     CURLOPT_HTTPHEADER => array(         'Authorization: token '.getenv("GithubOAuth")         )     ]);      return json_decode(curl_exec($curl)); }  function ReadableFileSize($byteSize) {     if($byteSize < 1024) return $byteSize." Bytes";      else if($byteSize < 1048576) return round(($byteSize / 1024),2)." KB";     else return round(($byteSize / 1048576), 2)." MB"; }   foreach($sql->ExecuteQuery("SELECT * FROM apicache WHERE ProjectID = ?", $project["ProjectID"]) as $result) {     switch($result["Request"])     {         case "General":             $projectData = json_decode($result["APIResult"]);             break;         case "Releases":             $releases = json_decode($result["APIResult"]);             break;         case "Issues":             $issues = json_decode($result["APIResult"]);             break;         case "Languages":             $languages = json_decode($result["APIResult"]);             break;         case "Readme":             $readme = json_decode($result["APIResult"]);             break;         case "License":             $license = json_decode($result["APIResult"]);             break;     } }                       
?> <a name="content"></a> <h1><?= $project["ProjectName"]?> </h1> <hr /> <div class="projectSubpageContainer"> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(0, true) ?>"> <h1>Overview</h1> <article> <div class="overviewSideContent"> <?php if(is_countable($releases) AND count($releases) > 0): ?> <div class="downloadShortcuts"> <a download href="<?= (count($releases[0]->assets) > 0) ? $releases[0]->assets[0]->browser_download_url : $releases[0]->zipball_url ?>" class="<?= ($releases[0]->prerelease) ? "downloadButtonPrerelease" : "downloadButtonRelease" ?> large sfIgnore"> Download latest </a> <em>Latest version: <?= $releases[0]->tag_name ?></em> <span>or</span> <br /> <a onclick="SelectProjectPage(3, '<?= $project["ProjectID"] ?>', 'Downloads')" class="downloadButtonPrerelease sfIgnore"> View prev. versions </a> </div> <?php endif; ?> <div class="socialInfo"> <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>" target="_blank"> <i class="fab fa-github"></i> View this project on Github! </a> <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>/network/members" target="_blank"> <img alt="GitHub forks" src="https://img.shields.io/github/forks/TobiHatti/<?= $project["GithubID"] ?>?label=Forks&style=social"> </a> <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>/stargazers" target="_blank"> <img alt="GitHub stars" src="https://img.shields.io/github/stars/TobiHatti/<?= $project["GithubID"] ?>?label=Stars&style=social"> </a> <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>/watchers" target="_blank"> <img alt="GitHub watchers" src="https://img.shields.io/github/watchers/TobiHatti/<?= $project["GithubID"] ?>?label=Watchers&style=social"> </a> </div> <div class="reports"> <a href="/support"> <i class="fas fa-exclamation-circle"></i> Report a problem </a> </div> </div> <p> <?= $parsedown->text($project["ProjectDescription"]) ?> </p> </article> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(1) ?>"> <h1>Support &amp; FAQ</h1> <form action="/projectSupportResult" target="faqOutput" method="get" accept-charset="utf-8" onsubmit="document.getElementsByName('faqOutput')[0].scrollIntoView(true)"> <div class="faqSearch"> <span>How can we help you?</span> <input type="hidden" value="<?= $project["ProjectID"] ?>" name="project" /> <input type="search" placeholder="Search for a topic or keyword..." name="search" required/> <button type="submit" >Search</button> <br /> <b>Can't find what you're looking for?<br /><a href="/support">Contact our support here!</a></b> </div> </form> <article> <iframe src="/projectSupportResult?project=<?= $project["ProjectID"] ?>" name="faqOutput" class="faqResults" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+20)+'px';"></iframe> </article> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(2) ?>"> <h1>Issues</h1> <p> Should you encounter any problems or issues with this project, let us know by either <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>/issues/new" target="_blank">submitting an issue via GitHub</a>, or by sending a bug-report via the <a href="">support page!</a> <br /><br /> Before submitting a new issue or bug report, please make sure the same problem has not been reported already. <br /> </p> <div class="issueStateSelector"> <div onclick="SelectIssueTab(0);"><i class="fas fa-exclamation-circle"></i> Open</div> <div onclick="SelectIssueTab(1);">Closed <i class="fas fa-check-circle"></i></div> </div> <?php   $openCtr = 0;  if(is_countable($issues)):     if(count($issues) > 0):         foreach($issues as $issue):              if(!isset($issue->pull_request)):                 if($issue->state == "open") $openCtr++; ?> <div class="issueBox <?= ($issue->state == "open") ? 'issueStateOpen' : 'issueStateClosed' ?>"> <h4><i class="fas <?= ($issue->state == "open") ? 'fa-exclamation-circle' : 'fa-check-circle' ?>"></i> <a href="<?= $issue->html_url ?>" target="_blank"><?= $issue->title ?></a></h4> <?php foreach($issue->labels as $label): ?> <div class="issueLabel" style="background-color: #<?= $label->color ?>" title="<?= $label->description ?>"><?= $label->name ?></div> <?php endforeach; ?> <br /> <span>#<?= $issue->number ?> opened on <?= date_format(date_create($issue->created_at)," j. M Y") ?> by <a href="<?= $issue->user->html_url ?>" target="_blank"><?= $issue->user->login ?></a></span> </div> <?php                    endif;         endforeach;  ?> <h3 style="margin: 20px 0; display: <?= ($openCtr == 0) ? "block" : "none"?>;" id="msgNoOpenIssues">There are currently no open issues.</h3> <h3 style="margin: 20px 0; display: none;" id="msgNoClosedIssues">No issues have been closed yet.</h3> <?php     else: ?> <h2>This project has no known issues yet.</h2> <h3>Report <a href="https://github.com/TobiHatti/<?= $project["GithubID"] ?>/issues/new" target="_blank">here</a></h3> <?php      endif;  else: ?> <h2>Could not process your request at the current time.</h2> <h3>Please check back in a few minutes.</h3> <?php endif; ?> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(3) ?>"> <h1>Downloads</h1> <article> <?php if(is_countable($releases) AND count($releases) > 0): ?> <a href="<?= (count($releases[0]->assets) > 0) ? $releases[0]->assets[0]->browser_download_url : $releases[0]->zipball_url ?>" download class="sfIgnore <?= ($releases[0]->prerelease) ? "downloadLatestPrerelease" : "downloadLatestRelease" ?> "> <i class="fas fa-download sfIgnore"></i> <div> Download<br /> <?= ($releases[0]->prerelease) ? "Pre-Release" : "Release" ?> <span>Version <?= $releases[0]->tag_name ?></span> <pre>File: <?= (count($releases[0]->assets) > 0) ? $releases[0]->assets[0]->name : "Source code (zip)" ?></pre> </div> </a> <h2>Other releases:</h2> <div class="otherReleases"> <?php foreach($releases as $release): ?> <h4>Version <?= $release->tag_name ?><strong>(Released on <?= date_format(date_create($release->published_at)," j. M Y")?>)</strong></h4> <?php foreach($release->assets as $asset): ?> <div class="downloadButtonWrapper sfIgnore"> <a download href="<?= $asset->browser_download_url ?>" class="<?= ($release->prerelease) ? "downloadButtonPrerelease" : "downloadButtonRelease" ?> sfIgnore"> <?= $asset->name ?> </a> <div class="<?= ($release->prerelease) ? "downloadButtonExtraInfoPrerelease" : "downloadButtonExtraInfoRelease" ?> sfIgnore"> <span> <?= ($release->prerelease) ? "Pre-Release" : "Release" ?><br /> Size: <?= ReadableFileSize($asset->size) ?> <br /> Author: <?= $release->author->login ?> </span> </div> </div> <?php endforeach; ?> <br /><br /><hr /> <?php endforeach; ?> </div> <?php else: ?> <h2>This project has no official releases yet.</h2> <h3>Check back soon for updates.</h3> <?php endif; ?> </article> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(4) ?>"> <h1>Version History</h1> <?php  if(is_countable($releases)):     if(count($releases) > 0):         foreach($releases as $release):               $downloadCount = 0;             foreach($release->assets as $asset) $downloadCount += $asset->download_count; ?> <div class="versionBox"> <div class="tagInfo"> <?php if($release->prerelease): ?> <span class="prerelease">Pre-release</span> <?php else: ?> <span class="release">Release</span> <?php endif; ?> <span class="tag"><i class="fas fa-tag"></i> <?= $release->tag_name ?></span> </div> <div class="generalInfo"> <a href="<?= $release->html_url ?>" target="_blank"><b><?= $release->name ?></b></a> <span>Released by <a href="<?= $release->author->html_url ?>" target="_blank"><?= $release->author->login ?></a> on the <?= date_format(date_create($release->published_at)," j. M Y")?>. Downloaded <?= $downloadCount ?> times.</span> <x-md> <?= $parsedown->text($release->body) ?> </x-md> <a class="githubBtn" href="<?= $release->html_url ?>" target="_blank"><i class="fab fa-github"></i> View on GitHub</a> <hr /> <strong>Assets:</strong> <ul class="assets"> <?php foreach($release->assets as $asset): ?> <li><a href="<?= $asset->browser_download_url ?>" download><i class="fas fa-cubes"></i> <?= $asset->name ?></a><em><?= ReadableFileSize($asset->size) ?> </em></li> <?php endforeach; ?> <li><a href="<?= $release->zipball_url ?>" download><i class="far fa-file-archive"></i> Source code (zip)</a></li> <li><a href="<?= $release->tarball_url ?>" download><i class="far fa-file-archive"></i> Source code (tar.gz)</a></li> </ul> </div> </div> <?php         endforeach;      else: ?> <h2>This project has no official releases yet.</h2> <h3>Check back soon for updates.</h3> <?php      endif;  else: ?> <h2>Could not process your request at the current time.</h2> <h3>Please check back in a few minutes.</h3> <?php endif; ?> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(5) ?>"> <h1>Readme (GitHub)</h1> <article> <?php       function CheckRMDataImage($rawFileContent)     {         $lines =  explode("\n", $rawFileContent);         foreach($lines as $line)         {             if(strpos($line, "data-rmimg"))              {                 preg_match('/https?\:\/\/[\S\s]*?(?=\")/', $line, $httpLink);                 if(count($httpLink) > 0)                 {                     $rawFileContent = str_replace($line, '<img align="right" width="80" height="80" src="'.$httpLink[0].'">', $rawFileContent);                 }                 else $rawFileContent = str_replace($line, '', $rawFileContent);             }         }         return $rawFileContent;     }          if($readme !== false):     ?> <x-md><?= CheckRMDataImage($parsedown->text(base64_decode($readme->content))) ?></x-md> <?php else: ?> <h2>The Readme could not be found, or no Readme exists.</h2> <h3>Error 404</h3> <?php endif; ?> </article> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(6) ?>"> <h1>Technical Information</h1> <article> <?php if($sql->ExecuteScalar("SELECT * FROM projectlanguages WHERE ProjectID = ?", $project["ProjectID"]) > 0): ?> <h4>Supported Languages</h4> <table> <?php foreach($sql->ExecuteQuery("SELECT * FROM projectlanguages WHERE ProjectID = ?", $project["ProjectID"]) as $lang): ?> <tr> <td><?= $lang["Language"] ?></td> <td>Supported</td> </tr> <?php endforeach; ?> </table> <br /> <?php endif; ?> <?php if($sql->ExecuteScalar("SELECT * FROM projectbadges WHERE Category = 'Status' AND ProjectID = ?", $project["ProjectID"]) > 0): ?> <h4>Status</h4> <table> <?php foreach($sql->ExecuteQuery("SELECT * FROM projectbadges WHERE Category = 'Status' AND ProjectID = ?", $project["ProjectID"]) as $status): ?> <tr> <td><?= $status["Title"] ?></td> <td><img alt="<?= $status["Title"] ?>" src="<?= $status["Badge"] ?>"></td> </tr> <?php endforeach; ?> </table> <br /> <?php endif; ?> <?php if($sql->ExecuteScalar("SELECT * FROM projectbadges WHERE Category = 'BuildAndTestResults' AND ProjectID = ?", $project["ProjectID"]) > 0): ?> <h4>Build and Test results</h4> <table> <?php foreach($sql->ExecuteQuery("SELECT * FROM projectbadges WHERE Category = 'BuildAndTestResults' AND ProjectID = ?", $project["ProjectID"]) as $buildAndTest): ?> <tr> <td><?= $buildAndTest["Title"] ?></td> <td><img alt="<?= $buildAndTest["Title"] ?>" src="<?= $buildAndTest["Badge"] ?>"></td> </tr> <?php endforeach; ?> </table> <br /> <?php endif; ?> <h4>General project info</h4> <table> <tr> <td>Created-Date</td> <td><img alt="GitHub Created" src="https://img.shields.io/badge/created-<?= date_format(date_create($projectData->created_at)," j. M Y") ?>-yellow"></td> </tr> <tr> <td>Last Updated</td> <td><img alt="GitHub Updated" src="https://img.shields.io/badge/updated-<?= date_format(date_create($projectData->updated_at)," j. M Y") ?>-green"></td> </tr> <tr> <td>Last Commit</td> <td><img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>Last Release</td> <td> <img alt="GitHub release (latest by date including pre-releases)" src="https://img.shields.io/github/v/release/TobiHatti/<?= $project["GithubID"]?>?include_prereleases"><br /> <img alt="GitHub (Pre-)Release Date" src="https://img.shields.io/github/release-date-pre/TobiHatti/<?= $project["GithubID"]?>"> </td> </tr> <tr> <td>Downloads</td> <td><img alt="GitHub All Releases" src="https://img.shields.io/github/downloads/TobiHatti/<?= $project["GithubID"]?>/total"></td> </tr> <tr> <td>Primary Programming Language</td> <td><img alt="GitHub top language" src="https://img.shields.io/github/languages/top/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>All Programming Languages</td> <td> <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/TobiHatti/<?= $project["GithubID"]?>"><br /> <?php foreach($languages as $key => $language): ?> <img alt="language" src="https://img.shields.io/badge/-<?= urlencode($key) ?>-blue" /> <?php endforeach; ?> </td> </tr> <tr> <td>License</td> <td><img alt="GitHub" src="https://img.shields.io/github/license/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>Repository Size</td> <td><img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>Raw Code Size</td> <td><img alt="GitHub code size in bytes" src="https://img.shields.io/github/languages/code-size/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>Open Issues</td> <td><img alt="GitHub issues" src="https://img.shields.io/github/issues/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> <tr> <td>Open Pull-Requests</td> <td><img alt="GitHub pull requests" src="https://img.shields.io/github/issues-pr/TobiHatti/<?= $project["GithubID"]?>"></td> </tr> </table> </article> </div> <div class="projectSubpage stagFade" style="display: <?= TabPageSelected(7) ?>"> <h1>License</h1> <article> <p> <?php       if($license !== false):         echo nl2br(htmlspecialchars(base64_decode($license->content)));     else:     ?> </p> <h2>The License could not be found, or no License exists.</h2> <h3>Error 404</h3> <?php endif; ?> </article> </div> </div> </main> <a href="#top"><div class="navigateToTop"><i class="fas fa-chevron-up"></i></div></a> <footer> <span> Copyright &copy; 2020 Tobias Hattinger </span> <div> <p> <b>Endev</b> <br /> <a href="/contact"><i class="far fa-address-card"></i> Contact</a><br /> <a href="/references"><i class="fas fa-asterisk"></i> References</a><br /> <a href="/imprint"><i class="fas fa-stamp"></i> Imprint</a> </p> <p> <b>Navigation</b> <br /> <a href="/projects"><i class="fas fa-code"></i> Projects</a><br /> <a href="/support"><i class="fas fa-headset"></i> Support</a><br /> <a href="/downloads"><i class="fas fa-download"></i> Downloads</a><br /> </p> <p> <b>Social</b> <br /> <a href="https://github.com/TobiHatti" target="_blank"><i class="fab fa-github"></i> GitHub</a><br /> <a href="https://www.linkedin.com/in/tobias-hattinger-ba0932192" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br /> <a href="https://www.instagram.com/tobihatti/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br /> </p> </div> </footer> </body> </html>