<?php
    require("_header.php");

    if(isset($_POST['sendToSupport']))
    {
        $category = $_POST['section'];
        $date = date("Y-m-d")

        if($category == "bug")
        {
            $page = $_POST['bugPage'];
            $error = $_POST['bugError'];
            $message = $_POST['bugMessage'];

            MySQL::NonQuery("INSERT INTO support_reports (id, supportID, projectID, category, message, bugPage, bugError, submitDate) VALUES ()")
        }
        else if($category == "help")
        {
            $message = $_POST['helpMessage'];
        }
        else if($category == "request")
        {
            $message = $_POST['requestMessage'];
        }

    }

    echo '
        <form action="'.Page::This().'" method="post" accept-charset="utf-8" enctype="multipart/form-data">

            <div style="float: right;">
                <i>Entwickler:</i><br>
                Tobias Hattinger<br>
                Paul Luger
            </div>

            <h3 style="margin: 0;">Projekt: </h3>
            <h1 style="margin-top: 0px;">Website Badmintonverband O&Ouml;</h1>

            <div>
                <h3 style="margin: 0;">Betreff</h3>
                <hr>
                <p>
                W&auml;hlen Sie einen Betreff aus:
                <select name="section" onchange="ToggleSupportSections(this)">
                    <option value="" selected disabled> --- Bitte ausw&auml;hlen --- </option>
                    <option value="bug">Fehler melden</option>
                    <option value="request">W&uuml;nsche oder Anliegen</option>
                    <option value="help">Fragen und sonstige Hilfe</option>
                </select>
                </p><br>
            </div>

            <div id="sectionBug" style="display: none">
                <h3 style="margin: 0;">Fehler melden</h3>
                <hr>
                <p>
                Seite auf welcher der Fehler auftritt (URL):
                <br>
                <input type="url" name="bugPage" placeholder="Link zur Seite..."/>
                </p>
                <p>
                Fehlermeldung (optional):<br>
                <textarea name="bugError" style="width: 80%; height: 50px; resize: none;" placeholder="Fehlermeldung hier einf&uuml;gen..."></textarea>
                </p>
                <p>
                Bitte beschreiben Sie m&ouml;glichst Detailiert den auftretenden Fehler:
                <textarea name="bugMessage" style="width: 80%; height: 150px; resize: none;" placeholder="Beschreiben Sie den Fehler..."></textarea>
                </p>
                <br>
            </div>

            <div id="sectionRequest" style="display: none">
                <h3 style="margin: 0;">W&uuml;nsche und Anliegen</h3>
                <hr>
                <p>
                Verfassen Sie ihre Frage im untenstehenden Textfeld:

                <textarea name="requestMessage" style="width: 80%; height: 150px; resize: none;" placeholder="Beschreiben Sie Ihr Anliegen..."></textarea>
                </p><br>
            </div>

            <div id="sectionHelp" style="display: none">
                <h3 style="margin: 0;">Frage stellen</h3>
                <hr>
                <p>
                Bitte beschreiben Sie m&ouml;glichst Detailiert Ihr anliegen im untenstehenden Textfeld:

                <textarea name="helpMessage" style="width: 80%; height: 150px; resize: none;" placeholder="Beschreiben Sie Ihr Anliegen..."></textarea>
                </p><br>
            </div>

            <div>
                <h3 style="margin: 0;">Kontaktaufnahme</h3>
                <hr>
                <p>Geben Sie Ihre E-Mail Adresse an, damit wir Kontakt zu Ihnen aufnehmen k&ouml;nnen:</p>

                Ihre E-Mail Adresse: <input type="email" name="email" placeholder="E-Mail..."/>
                <br><br>
            </div>


            <div>
                <hr>
                <center>
                    <button type="submit" name="sendToSupport">Absenden</button>
                </center>
            </div>
        </form>
    ';


    include ("_footer.php");
?>