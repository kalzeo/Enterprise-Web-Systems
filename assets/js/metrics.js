$(document).ready(function ()
{
    /**
     * Get the minimum and maximum values of an array of data.
     * @param data - An array of ints
     * @returns {number[]} - Returns an array containing the minimum and maximum values from the array of values.
     */
    function GetMinMax(data)
    {
        let min = Math.min.apply(Math, data);
        let max = Math.max.apply(Math, data);

        return [min, max]
    }

    /**
     * Find the best performer of a A/B test (control vs variation).
     * @param data - The values of the AB test.
     * @param labels - The labels of the AB test values.
     * @returns {*}
     */
    function BestPerformer(data, labels)
    {
        // Determine the best performer of the AB test (control vs variation)
        let maxValueIndex = data.reduce((bestIndex,
                                         testValue,
                                         testIndex, array) => testValue > array[bestIndex] ? testIndex : bestIndex, 0);

        return labels[maxValueIndex]
    }

    /**
     * Calculate the improvement % of the best performing metric using the following formula:
     * 100 * (max - min) / min
     *
     * Assuming the min and max values are both 0 then there's no change so the improvement % is 0%.
     * e.g. 100 * (0 - 0) / 0 = NaN, so set it 0
     *
     * If the min value happens to be 0 but max isn't, NaN will be thrown because the end of the foruma divides by min.
     * To get around this the improvement % will be set to 100% until the min value has an actual value thats divisible.
     * e.g. 100 * (100 - 0) / 0 = NaN, so set it 100
     *
     * If the min and max values are both >0 then the formula will be carried out normally.
     * e.g. 100 * (100 - 90) / 90 = 11.1%
     *
     * @param min - Minimum int value in the dataset
     * @param max - Maximum int value in the dataset
     * @returns {number|number} - Returns the improvement %, either 0, 100, or int depending on edge cases.
     */
    function ImprovementPercentage(min, max)
    {
        return min === 0 && max === 0
            ? 0
            : min === 0
            ? 100
            : Math.round(100 * (max - min) / min)
    }

    /**
     * Creates a pie chart using Charts.JS.
     * @param element_id - Element ID of the pie chart canvas.
     * @param labels - An array of labels that map to each value.
     * @param data - An array of values to populate the chart.
     */
    function CreatePieChart(element_id, labels, data)
    {
        // Get the best performer and improvement %
        let [min, max] = GetMinMax(data);
        let improvementPercentage = ImprovementPercentage(min, max)
        let bestPerformer = BestPerformer(data, labels).replace("Clicks", "")


        // Create the Pie Chart
        new Chart($(`#${element_id}`)[0].getContext("2d"),
        {
            type: 'pie',

            // The data for the pie chart
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: ['rgb(255, 99, 132)', 'rgb(122, 99, 132)'],
                    borderColor: ['rgb(255, 99, 132)', 'rgb(122, 99, 132)'],
                    data: data
                }]
            },

            // Configuration options
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: "left"
                },
                title: {
                    display: true,
                    //text: `${bestPerformer} Received ${improvementPercentage}% More Clicks`
                    text: [`Best AB Test Performer: ${bestPerformer}`, `${bestPerformer} Has Performed Better By: ${improvementPercentage}%`, ""]
                }
            }
        });
    }

    /**
     * Creates a bar chart using Charts.JS.
     * @param element_id - Element ID of the bar chart canvas.
     * @param labels - An array of labels that map to each value.
     * @param data - An array of values to populate the chart.
     */
    function CreateBarChart(element_id, labels, data)
    {
        // Get the best performer and improvement %
        let [min, max] = GetMinMax(data);
        let improvementPercentage = ImprovementPercentage(min, max)
        let bestPerformer = BestPerformer(data, labels).replace("Signups", "");

        new Chart($(`#${element_id}`)[0].getContext("2d"),
        {
            type: 'bar',
            // The data for the bar chart
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: ['rgb(255, 99, 132)', 'rgb(122, 99, 132)'],
                    borderColor: ['rgb(255, 99, 132)', 'rgb(122, 99, 132)'],
                    data: data
                }]
            },

            // Configuration options
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: `${improvementPercentage}% More People Signed Up Using ${bestPerformer}`
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }]
                }
            }
        });
    }

    // Create an AJAX call to fetch metric values from the server so that they can be plotted
    $.ajax({
        url: 'assets/php/get_metrics.php',
        type: 'GET',
        dataType: "json",
        success: function (data)
        {
            // Quick and dirty
            new CreatePieChart("lightvsdark_graph",
                [data[0].metric, data[1].metric],
                [data[0][0].value, data[1][0].value])

            new CreatePieChart("offer_header_graph",
                [data[2].metric, data[3].metric],
                [data[2][0].value, data[3][0].value])

            new CreateBarChart("offer_signup_graph",
                [data[4].metric, data[5].metric],
                [data[4][0].value, data[5][0].value])
        }
    });

    // Dynamically add the buttons to reset each of the A/B test metrics by targeting the child elements of the metrics card
    $("#metric-card .tab-pane").each(function()
    {
        // The reset buttons for the control and variation. IDs are dynamically created.
        let id = this.id;
        let controlButton = `<button type="button" class="btn btn-sm btn-outline-red" id="reset-control-${id}">Reset Control</button>`;
        let variationButton = `<button type="button" class="btn btn-sm btn-outline-red" id="reset-variation-${id}">Reset Variation</button>`;

        // Appends the buttons to the AB test tab
        $(`#${id}`).append(controlButton, variationButton);
    });

    // Reset the metric value for a specific AB test when the control or variation button is pressed
    $("#metric-card .tab-pane .btn[id^='reset-']").click(function()
    {
        let metricType;
        switch(this.id)
        {
            case "reset-control-lightvsdark-pill": metricType = "Light Mode"; break;
            case "reset-variation-lightvsdark-pill": metricType = "Dark Mode"; break;
            case "reset-control-homepageheader-pill": metricType = "Offer 1 Clicks"; break;
            case "reset-variation-homepageheader-pill": metricType = "Offer 2 Clicks"; break;
            default: break;
        }

        $.ajax({
            url: "assets/php/update_metric.php",
            type: "POST",
            data:
                {
                    "method": "reset",
                    "metric_type": metricType
                }
        });
    });
});