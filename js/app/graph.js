$(function() {
    var chart;
    $.getJSON('rest/get/countstats', function(data) {

    });


    $.getJSON('rest/get/graph2', function(data) {
        console.log(data);
        all = [];
        all_added = [];
        all_studied = [];
        all_known = [];
        views = [];
        for (var i = 0, j = data.length; i < j; i++) {
            all[i] = [];
            all[i][0] = parseInt(0 + data[i][0] + '000');
            all[i][1] = parseInt(0 + data[i][1]);

            all_added[i] = [];
            all_added[i][0] = parseInt(0 + data[i][0] + '000');
            all_added[i][1] = parseInt(0 + data[i][2]);

            all_studied[i] = [];
            all_studied[i][0] = parseInt(0 + data[i][0] + '000');
            all_studied[i][1] = parseInt(0 + data[i][3]);

            all_known[i] = [];
            all_known[i][0] = parseInt(0 + data[i][0] + '000');
            all_known[i][1] = parseInt(0 + data[i][4]);

            // views[i] = parseInt(0 + data[i][0]);
        }


        window.chart = new Highcharts.StockChart({
            chart : {
                renderTo : 'graph',
                zoomType : 'x',
                 type : 'spline'
            },

            rangeSelector : {
                selected : 1
            },

            title : {
                text : 'Statystyki nauki'
            },
            xAxis : {
                type : 'datetime',
                dateTimeLabelFormats : {
                    second : ' ',
                    minute : ' ',
                    hour : ' ',
                    day : '%e. %b',
                    week : '%e. %b',
                    month : '%b \'%y',
                    year : '%Y'
                }
            },
            yAxis : {
                min : 0,
                startOnTick : true,
                endOnTick : true,
            },
            scrollbar : {
                enabled : false
            },
            navigator : {
                enabled : false
            },
            series : [{
                name : 'Tłumaczeń',
                data : all,
                type: 'column',
                step: true,
                pointInterval : 24 * 3600 * 1000, // one day
                tooltip : {
                    valueDecimals : 2
                }
            }, {
                name : 'Dodanych',
                type: 'column',
                data : all_added,
                pointInterval : 24 * 3600 * 1000, // one day
                tooltip : {
                    valueDecimals : 2
                }
            }, {
                name : 'Ćwiczonych',
                type: 'column',
                data : all_studied,
                pointInterval : 24 * 3600 * 1000, // one day
                tooltip : {
                    valueDecimals : 2
                }
            }, {
                name : 'Nauczonych',
                type: 'column',
                data : all_known,
                step : true,
                pointInterval : 24 * 3600 * 1000, // one day
                tooltip : {
                    valueDecimals : 2
                }
            }]
        });
    });
});