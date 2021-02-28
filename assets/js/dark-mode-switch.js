// Taken from https://github.com/coliff/dark-mode-switch and adapted

/**
 * Initializes the theme for the page.
 *
 * Does a comparison to check if the darkSwitch key in the local storage is set to "dark" and returns true/false depending
 * on the value. If it returns true then the dark mode theme gets enabled, otherwise the light mode theme is.
 */
function initTheme()
{
    const toggled = localStorage.getItem("darkSwitch") !== null && localStorage.getItem("darkSwitch") === "dark";
    (darkSwitch.checked = toggled), toggled ? $("body").attr("data-theme", "dark") : $('body').removeAttr("data-theme")
}

/**
 * Resets the page theme to the inverse of what it's currently on when the dark mode switch is toggled.
 * If the dark mode switch is toggled to on, the dark mode theme is applied and vice versa for the light mode.
 *
 * A call to update the light/dark mode metrics is made to keep track for the A/B test.
 */
function resetTheme()
{
    if (darkSwitch.checked)
    {

        $type = "Dark Mode";
        $("body").attr("data-theme", "dark");
        localStorage.setItem("darkSwitch", "dark");
    }
    else
    {
        $type = "Light Mode";
        $("body").removeAttr("data-theme");
        localStorage.removeItem("darkSwitch");
    }

    // Update the light mode or dark mode metric value depending on what ones toggled
    $.ajax({
        url: 'assets/php/update_metric.php',
        type: 'POST',
        data:
            {
                'type': $type
            }
    });
}

// Wait until the DOM is ready to execute the JS
$(document).ready(function ()
{
    var darkSwitch = $("#darkSwitch");

    // Reset the page theme each time the dark mode switch button is toggled on/off.
    darkSwitch && (initTheme(), darkSwitch.on("change", function ()
    {
        resetTheme();
    }));
});