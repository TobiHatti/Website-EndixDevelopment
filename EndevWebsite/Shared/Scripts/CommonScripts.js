function SelectProjectTab(tabPage)
{
    for (var i = 0; i < document.getElementsByClassName("projectTab").length; i++)
    {
        if (i == tabPage) document.getElementsByClassName("projectTab")[i].style.display = "inline-block";
        else document.getElementsByClassName("projectTab")[i].style.display = "none";
    }
}