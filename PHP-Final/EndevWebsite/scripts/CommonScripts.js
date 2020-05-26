function SelectProjectTab(tabPage)
{
    for (var i = 0; i < document.getElementsByClassName("projectTab").length; i++)
    {
        if (i == tabPage) document.getElementsByClassName("projectTab")[i].style.display = "grid";
        else document.getElementsByClassName("projectTab")[i].style.display = "none";
    }
}

function SelectProjectPage(tabPage, projectID)
{
    window.history.pushState('subpage' + tabPage, 'Projects | Endev', "?project=" + projectID +  "&page=" + tabPage);

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