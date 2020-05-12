window.onload = function () {
    SetPageLayout();
}

window.addEventListener('scroll', function () {
    SetPageLayout();
});

function SetPageLayout(isOnLoad) {
    if (window.scrollY > 50) {
        this.document.getElementsByTagName("header")[0].className = "headerTopMost";
        this.document.getElementsByClassName("navigateToTop")[0].style.right = "40px";
    }
    else {
        this.document.getElementsByTagName("header")[0].className = "headerDefault";
        this.document.getElementsByClassName("navigateToTop")[0].style.right = "-80px";
    }


    if (this.window.scrollY / 2 <= 2000)
        this.document.getElementsByTagName("header")[0].style.backgroundPositionY = -(this.window.scrollY / 2) + "px";
}