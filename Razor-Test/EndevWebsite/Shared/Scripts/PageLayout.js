﻿
window.onload = SetPageLayout;
window.addEventListener('scroll', SetPageLayout);
window.addEventListener('resize', SetPageLayout);

function SetPageLayout() {
    // Stick Nav to top
    // TODO: replace constant with nav.default top distance

    var navDefaultInstance = getComputedStyle(this.document.querySelector("nav.default"));
    if (window.scrollY > parseInt(navDefaultInstance.top)) this.document.getElementsByTagName("nav")[0].className = "sticky";
    else this.document.getElementsByTagName("nav")[0].className = "default";

    // Stick Header to top
    var viewport = document.getElementsByTagName("main")[0].getBoundingClientRect();
    var navInstance = getComputedStyle(this.document.querySelector("nav"));

    if (viewport.top - parseInt(navInstance.height) <= 0) document.getElementsByTagName("header")[0].className = "sticky";
    else document.getElementsByTagName("header")[0].className = "";

    // Stick Logo to top
    var logoInstance = getComputedStyle(this.document.querySelector(".endevLogo"));

    if (window.scrollY > parseInt(logoInstance.top) + parseInt(logoInstance.height)) {
        document.getElementsByClassName("endevLogo")[0].style.display = "none";
        document.getElementsByClassName("endevLogoSticky")[0].style.display = "block";
    }
    else {
        document.getElementsByClassName("endevLogo")[0].style.display = "block";
        document.getElementsByClassName("endevLogoSticky")[0].style.display = "none";
    }

    // Show "To-Top" button
    if (viewport.top <= 0) this.document.getElementsByClassName("navigateToTop")[0].style.right = "40px";
    else this.document.getElementsByClassName("navigateToTop")[0].style.right = "-80px";

    
    try
    {
        // Sticky Aside
        var headerInstance = getComputedStyle(this.document.querySelector("header"));
        if (parseInt(viewport.top) <= 50) document.getElementsByTagName("aside")[0].style.top = window.scrollY + 50 + "px";
        else document.getElementsByTagName("aside")[0].style.top = parseInt(headerInstance.height) + "px";
    }
    catch { }

    try {
        // Header-BG-Image Manipulation
        var blurFactor = window.scrollY / 25;
        var transparencyFactor = window.scrollY / 750 + 0.1;

        if (transparencyFactor > 0.6) transparencyFactor = 0.6;
        document.getElementById("bannerCover").style.opacity = transparencyFactor;

        if (blurFactor > 50) blurFactor = 50;
        document.getElementById("headerBGImage").style.filter = "blur(" + blurFactor + "px)";
        document.getElementById("headerBGImage").style.webkitFilter = "blur(" + blurFactor + "px)";
        document.getElementById("headerBGImage").style.marginTop = "-" + (blurFactor * 1.5) + "px";

    }
    catch{ }
}