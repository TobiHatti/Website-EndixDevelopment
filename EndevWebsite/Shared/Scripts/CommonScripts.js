function UncheckIfChecked(elementID)
{
    var element = document.getElementById(elementID);
    if (element.Checked) element.checked = false;
}