// Taken from https://github.com/coliff/dark-mode-switch
// Code has been changed from vanilla JS to jQuery

function initTheme()
{
  var e = null !== localStorage.getItem("darkSwitch") && "dark" === localStorage.getItem("darkSwitch");
    (darkSwitch.checked = e), e ? $("body").attr("data-theme", "dark") : $("body").removeAttr("data-theme")
}

function resetTheme()
{
  darkSwitch.checked ? ($("body").attr("data-theme", "dark"), localStorage.setItem("darkSwitch", "dark")) : ($("body").removeAttr("data-theme"), localStorage.removeItem("darkSwitch"));
}

// Initialise the dark theme when the DOM is ready
$(document).ready(function()
{
    var darkSwitch = $("#darkSwitch");
    darkSwitch && (initTheme(), darkSwitch.on("change", function()
    {
        resetTheme();
    }));
});