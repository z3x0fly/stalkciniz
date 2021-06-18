/**
Template Name: Xadmino
Dashboard
*/


!function($) {
    "use strict";

    var DashboardApp = function() {
        this.$window = $(window),
        this.$dataTable = $('#datatable-responsive'),
        this.$lastResizeEventTracker = null
    };
    //creates the sparkline
    DashboardApp.prototype.drawSparkline = function(element, values, height, chartRangeMax, lineColor, fillColor, highlightLineColor, highlightSpotColor) {
        element.sparkline(values, {
            type: 'line',
            width: element.width(),
            maxSpotColor:false,
            minSpotColor: false,
            spotColor:false,
            height: height,
            chartRangeMax: chartRangeMax,
            lineColor: lineColor,
            fillColor: fillColor,
            highlightLineColor: highlightLineColor,
            highlightSpotColor: highlightSpotColor
        });
    },
    DashboardApp.prototype.createDemoSparks = function () {
        this.drawSparkline($('#sparkline1'), [22, 23, 33, 35, 42, 38, 48, 32, 42], '190', 50, '#3bafda', 'rgba(59,175,218,0.3)', 'rgba(0,0,0,.1)', 'rgba(0,0,0,.2)');
        this.drawSparkline($('#sparkline2'), [25, 28, 33, 35, 42, 38, 48, 32, 42], '190', 50, '#01ba9a', 'rgba(1,186,154,0.3)', 'rgba(0,0,0,.1)', 'rgba(0,0,0,.2)');
        this.drawSparkline($('#sparkline3'), [22, 23, 33, 35, 42, 38, 48, 32, 42], '190', 50, '#f8ca4e', 'rgba(248,202,78,0.3)', 'rgba(0,0,0,.1)', 'rgba(0,0,0,.2)');
    },
    DashboardApp.prototype.start = function() {
        var $this = this;
        // creates the data table
        this.$dataTable.DataTable();

        this.$window.on('resize', function(e) {
            clearTimeout($this.$lastResizeEventTracker);
            //refreshing all the graphs on window resize
            $this.$lastResizeEventTracker = setTimeout(function() {
                $this.createDemoSparks();
            }, 300);
        });
    },
    //init
    $.DashboardApp = new DashboardApp, $.DashboardApp.Constructor = DashboardApp
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.DashboardApp.start();
}(window.jQuery);