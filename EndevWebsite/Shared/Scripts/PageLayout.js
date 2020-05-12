﻿window.onload = SetPageLayout;
window.addEventListener('scroll', SetPageLayout);
window.addEventListener('resize', SetPageLayout);

function SetPageLayout() {
    // Stick Nav to top
    // TODO: replace constant with nav.default top distance
    if (window.scrollY > 50) this.document.getElementsByTagName("nav")[0].className = "sticky";
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
}