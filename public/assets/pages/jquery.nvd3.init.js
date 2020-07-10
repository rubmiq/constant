/**
* Theme: Ubold Admin
* Author: Coderthemes
* Chart Nvd3 page
*/


(function($) {
    'use strict';

    nv.addGraph(function() {
        var lineChart = nv.models.lineChart();
        var height = 300;
        lineChart.useInteractiveGuideline(true);
        lineChart.xAxis.tickFormat(d3.format(',r'));
        lineChart.yAxis.axisLabel('Voltage (v)').tickFormat(d3.format(',.2f'));
        d3.select('.line-chart svg').attr('perserveAspectRatio', 'xMinYMid').datum(sinAndCos()).transition().duration(500).call(lineChart);
        nv.utils.windowResize(lineChart.update);
        return lineChart;
    });

})(jQuery);