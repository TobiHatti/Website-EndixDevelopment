function SelectProjectTab(tabPage)
{
    for (var i = 0; i < document.getElementsByClassName("projectTab").length; i++)
    {
        if (i == tabPage) document.getElementsByClassName("projectTab")[i].style.display = "grid";
        else document.getElementsByClassName("projectTab")[i].style.display = "none";

        /*
         * Does not work for mobile view
        var subpageItemCount = document.getElementsByClassName("projectTab")[tabPage].childElementCount - 1;
        document.getElementsByClassName("projectBrowser")[0].style.height = (100 + 131 * subpageItemCount) + "px"; 
        */
    }
}

function SelectProjectPage(tabPage, projectID, urlName)
{
    // .htaccess must be set too!
    window.history.pushState('subpage' + tabPage, 'Projects | Endev', "/project/" + projectID + "/" + urlName);

    for (var i = 0; i < document.getElementsByClassName("projectSubpage").length; i++) {
        if (i == tabPage) document.getElementsByClassName("projectSubpage")[i].style.display = "block";
        else document.getElementsByClassName("projectSubpage")[i].style.display = "none";
    }
}


function ShowElementIfChecked(e, targetElement)
{
    if (e.checked) document.getElementById(targetElement).style.display = "block";
    else document.getElementById(targetElement).style.display = "none";
}

function SetProjectTitle(title) {
    document.getElementById("headerProjectTitle").innerHTML = title;
}

function SetProjectBanner(bannerURL)
{
    document.getElementsByTagName("header")[0].style.background = "white";
    document.getElementById("bannerCover").style.display = "block";
    document.getElementById("headerBGImage").style.display = "block";
    document.getElementById("headerBGImage").style.backgroundImage = "url(" + bannerURL + ")";
}

function SelectIssueTab(issueTab)
{
    document.getElementById("msgNoOpenIssues").style.display = "none";
    document.getElementById("msgNoClosedIssues").style.display = "none";


    if (issueTab == 0)
    {
        for (var i = 0; i < document.getElementsByClassName("issueStateOpen").length; i++)
            document.getElementsByClassName("issueStateOpen")[i].style.display = "block";

        for (var i = 0; i < document.getElementsByClassName("issueStateClosed").length; i++)
            document.getElementsByClassName("issueStateClosed")[i].style.display = "none";

        if (document.getElementsByClassName("issueStateOpen").length == 0)
            document.getElementById("msgNoOpenIssues").style.display = "block";
    }
    else if (issueTab == 1)
    {
        for (var i = 0; i < document.getElementsByClassName("issueStateOpen").length; i++)
            document.getElementsByClassName("issueStateOpen")[i].style.display = "none";

        for (var i = 0; i < document.getElementsByClassName("issueStateClosed").length; i++)
            document.getElementsByClassName("issueStateClosed")[i].style.display = "block";

        if (document.getElementsByClassName("issueStateClosed").length == 0)
            document.getElementById("msgNoClosedIssues").style.display = "block";
    }
}