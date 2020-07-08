 <?php  session_start();  $userAgent = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8'); if (preg_match('~MSIE|Internet Explorer~i', $userAgent) || (strpos($userAgent, 'Trident/7.0') !== false && strpos($userAgent, 'rv:11.0') !== false)) {     header("Location: /ie-support.html");     die(); } ?> <!DOCTYPE html> <html> <head> <?php require("data/dbConnect.php"); require("libraries/WrapMySQL.php"); require("libraries/Parsedown.php");  use PHPMailer\PHPMailer\PHPMailer; use PHPMailer\PHPMailer\SMTP; use PHPMailer\PHPMailer\Exception;  require("vendor/autoload.php"); ?> <?php $build = 301; ?> <link href="/styles/fontawesome.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/styles/staggeredFade.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/styles/textElements.min.css?<?= $build ?>" rel="stylesheet" /> <link href="/styles/formElements.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__styleMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_styleDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/__layoutMaster.min.css?<?= $build ?>" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutMobile.min.css?<?= $build ?>" media="(max-width: 690px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutTablet.min.css?<?= $build ?>" media="(min-width: 690px) and (max-width: 1139px)" rel="stylesheet" /> <link type="text/css" href="/stylesV2/_layoutDesktop.min.css?<?= $build ?>" media="(min-width: 1140px)" rel="stylesheet" /> <meta name="viewport" content="width=device-width" /> <link href="/styles/layoutIFramePage.css" rel="stylesheet" /> </head> <body> <main> <?php   $sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass")); $sql->Open();      if(isset($_POST["faqUpvote"]) AND !isset($_COOKIE['endevFAQSurvey'.$_POST['faqID']])) {     setcookie('endevFAQSurvey'.$_POST['faqID'], "1", time() + (10 * 365 * 24 * 60 * 60));     $sql->ExecuteNonQuery("UPDATE faq SET Votes = Votes + 1 WHERE ID = ?", $_POST['faqID']);     header("Refresh:0");     die();  }  if(isset($_POST["faqDownvote"]) AND !isset($_COOKIE['endevFAQSurvey'.$_POST['faqID']])) {     setcookie('endevFAQSurvey'.$_POST['faqID'], "1", time() + (10 * 365 * 24 * 60 * 60));                                                                                                              
    header("Refresh:0");     die(); }  ?> <div class="stagFade"> <?php      $parsedown = new Parsedown();     $parsedown->setSafeMode(true);      if(!isset($_GET['q'])):               if(isset($_GET['project']))         {             $projectID = $_GET['project'];             $project = $sql->ExecuteQueryRow("SELECT * FROM projects WHERE ProjectID = ?", $projectID);              if(count($project) == 0) die();               if(isset($_GET['search']))             {                 $faqTopic = $sql->ExecuteQuery("SELECT * FROM faq WHERE ProjectID = ? AND Keywords LIKE ?", $projectID, '%'.$_GET['search'].'%');                 $faqGeneral = $sql->ExecuteQuery("SELECT * FROM faq WHERE ProjectID = '' AND Keywords LIKE ?", '%'.$_GET['search'].'%');             }             else             {                 $faqTopic = $sql->ExecuteQuery("SELECT * FROM faq WHERE ProjectID = ?", $projectID);                 $faqGeneral = $sql->ExecuteQuery("SELECT * FROM faq WHERE ProjectID = ''");             }         }         else         {             die();         }      ?> <h2><?= $project["ProjectName"]?>:</h2> <?php if(count($faqTopic) > 0): ?> <ul class="faqContainer"> <?php foreach($faqTopic as $faq): ?> <li> <div class="votes"> <span class="voteCounter"><?= $faq["Votes"] ?></span> </div> <a href="?q=<?= $faq["ID"] ?>&project=<?= htmlspecialchars($_GET['project']) ?>" title="Click to see the full entry"> <div class="faq"> <b><?= $faq["Question"] ?></b> <p><?= $faq["Answer"] ?></p> </div> </a> </li> <?php endforeach; ?> </ul> <?php else: ?> <h3>Sorry, there's nothing about this topic yet.</h3> <?php endif; ?> <br /> <h2>General Questions:</h2> <?php if(count($faqGeneral) > 0): ?> <ul class="faqContainer"> <?php foreach($faqGeneral as $faq): ?> <li> <div class="votes"> <span class="voteCounter"><?= $faq["Votes"] ?></span> </div> <a href="?q=<?= $faq["ID"] ?>&project=<?=  htmlspecialchars($_GET['project']) ?>" title="Click to see the full entry"> <div class="faq"> <b><?= $faq["Question"] ?></b> <p><?= $faq["Answer"] ?></p> </div> </a> </li> <?php endforeach; ?> </ul> <?php else: ?> <h3>Sorry, there's nothing about this topic yet.</h3> <?php endif; ?> <?php else: ?> <?php               $faq = $sql->ExecuteQueryRow("SELECT * FROM faq WHERE ID = ?", $_GET['q']);         if(count($faq) == 0) die();         ?> <h2><?= $parsedown->text('Q: '.$faq["Question"]) ?></h2> <p> <?php if($faq["Votes"] > 0): ?> <?= $faq["Votes"] ?> People found this usefull:<br /> <?php endif; ?> <?= $parsedown->text($faq["Answer"]) ?> </p> <br /> <?php if(!isset($_COOKIE['endevFAQSurvey'.$faq['ID']])): ?> <form action="" method="post" class="voteBox"> <span>Did you find this answer usefull?</span> <input type="hidden" value="<?= $faq['ID'] ?>" name="faqID"/> <button type="submit" name="faqUpvote"> <i class="far fa-thumbs-up sfIgnore"></i> Yes </button> <button type="submit" name="faqDownvote"> <i class="far fa-thumbs-down sfIgnore"></i> No </button> </form> <?php else: ?> <p style="color: #ccc;">Thank you for voting!</p> <?php endif; ?> <?php endif; ?> <?php if((isset($_GET['search']) OR isset($_GET['q'])) AND isset($_GET['project'])): ?> <br /> <h3 style="font-size: 1.5em"><a href="?project=<?= htmlspecialchars($_GET['project']) ?>" style="text-decoration: none;"><i class="fas fa-backward"></i> Click here to see all FAQ-entries.</a></h3> <h5 style="font-size: 1.3em"><a href="/support/faq/<?= $faq['ID'] ?>" style="text-decoration: none;" target="_parent"><i class="fas fa-expand"></i> Open this question in fullscreen</a></h5> <?php endif; ?> </div> </main> </body> </html>