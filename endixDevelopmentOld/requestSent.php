<?php
    require("_header.php");

    if(isset($_POST['sendToSupport']))
    {
        $id = uniqid();
        $supportID = number_format(hexdec(uniqid()),0,"","");
        $projectID = 1;
        $category = $_POST['section'];
        $contactMail = $_POST['email'];
        $date = date("Y-m-d H:i:s");

        if($category == "bug")
        {
            $page = $_POST['bugPage'];
            $error = $_POST['bugError'];
            $message = $_POST['bugMessage'];

            MySQL::NonQuery("INSERT INTO support_reports (id, supportID, projectID, category, message, bugPage, bugError, submitDate, contactEmail) VALUES (?,?,?,?,?,?,?,?,?)",'@s',$id,$supportID,$projectID,$category,$message,$page,$error,$date,$contactMail);
        }
        else if($category == "help")
        {
            $message = $_POST['helpMessage'];
            MySQL::NonQuery("INSERT INTO support_reports (id, supportID, projectID, category, message, submitDate, contactEmail) VALUES (?,?,?,?,?,?,?)",'@s',$id,$supportID,$projectID,$category,$message,$date,$contactMail);
        }
        else if($category == "request")
        {
            $message = $_POST['requestMessage'];
            MySQL::NonQuery("INSERT INTO support_reports (id, supportID, projectID, category, message, submitDate, contactEmail) VALUES (?,?,?,?,?,?,?)",'@s',$id,$supportID,$projectID,$category,$message,$date,$contactMail);
        }

        Page::Redirect("/requestSent");
        die();
    }

    echo '
        <h1>Vielen Dank f&uuml;r Ihre R&uuml;ckmeldung!</h1>
        <h3>
            Wir melden uns so schnell wie m&ouml;glich bei Ihnen 
        </h3>
    ';


    include ("_footer.php");
?>