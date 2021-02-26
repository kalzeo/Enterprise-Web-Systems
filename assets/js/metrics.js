$(document).ready(function ()
{
    /**
     * Creates a pie chart using Charts.JS.
     * @param element_id - Element ID of the pie chart canvas.
     * @param labels - An array of labels outputted by the server.
     * @param data - An array of values outputted by the server.
     */
    function CreatePieChart(element_id, labels, data)
    {
        new Chart($(`#${element_id}`)[0].getContext("2d"),
        {
            // The type of chart we want to create
            type: 'pie',

            // The data for the pie chart
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: ['rgb(255, 99, 132)','rgb(122, 99, 132)'],
                    borderColor: ['rgb(255, 99, 132)','rgb(122, 99, 132)'],
                    data: data
                }]
            },

            // Configuration options
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: "left"
                }
            }
        });
    }

    // Create an AJAX call to fetch the pie chart information from the server
    $.ajax({
        url: 'assets/php/get_metrics.php',
        type: 'GET',
        dataType:"json",
        success: function(data)
        {
            // Quick and dirty
            new CreatePieChart("lightvsdark_graph", [`${data[0].metric} (control)`, `${data[1].metric} (variation)`], [data[0][0].value, data[1][0].value])
            new CreatePieChart("homepage_header_graph", [`${data[2].metric} (control)`, `${data[3].metric} (variation)`], [data[2][0].value, data[3][0].value])
        }
    });
});