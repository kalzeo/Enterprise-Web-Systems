// Wait until the DOM is ready before executing any JS
$(document).ready(function ()
{
    // Execute if any of the homepage header buttons are pressed to go to the sign up page
    $(".btn[id^='homepage_header_']").click(function()
    {
        // Determine the metric type and increment it with the AJAX call
        var metricType = `Homepage Header ${this.id[this.id.length - 1]}`;

        $.ajax({
            url: "assets/php/update_metric.php",
            type: "POST",
            data:
                {
                    "method": "update",
                    "metric_type": metricType
                }
        });
    });
});