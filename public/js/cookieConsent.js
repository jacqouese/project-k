const cookieBanner = document.querySelector(".cookie-banner");
const cookieButton = document.getElementById("cookie-btn");

const helpBanner = document.querySelector(".help-banner");
const helpButton = document.getElementById("help-btn");
const helpContentContainer = document.getElementById("helpContentContainer");

//cookie
cookieButton.addEventListener("click", () => {
    cookieBanner.classList.remove("active");
    localStorage.setItem("cookieBannerDisplayed", "true");
});

setTimeout(() => {
    if(!localStorage.getItem("cookieBannerDisplayed"))
        cookieBanner.classList.add("active");
}, 2000);
//

//help
setTimeout(() => {
    if (!localStorage.getItem("helpBannerDisplayed"))
        helpBanner.classList.add("active");
}, 2000);

function showHelp() {
    helpContentContainer.classList.add("active");
}

function hideHelp() {
    helpContentContainer.classList.remove("active");
}

function hideHelpBanner() {
    helpBanner.classList.remove("active");
    localStorage.setItem("helpBannerDisplayed", "true");
}