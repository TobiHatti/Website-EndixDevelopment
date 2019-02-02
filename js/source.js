function ToggleSupportSections(e)
{
    var selectedOption = e.options[e.selectedIndex].value;

    if(selectedOption == "bug")
    {
        document.getElementById("sectionBug").style.display = "block";
        document.getElementById("sectionHelp").style.display = "none";
        document.getElementById("sectionRequest").style.display = "none";
    }
    else if(selectedOption == "help")
    {
        document.getElementById("sectionBug").style.display = "none";
        document.getElementById("sectionHelp").style.display = "block";
        document.getElementById("sectionRequest").style.display = "none";
    }
    else if(selectedOption == "request")
    {
        document.getElementById("sectionBug").style.display = "none";
        document.getElementById("sectionHelp").style.display = "none";
        document.getElementById("sectionRequest").style.display = "block";
    }
}