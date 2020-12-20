/**
* Theme:   Admin Template
* 
* Component: Widget
* 
*/
 /* sparkline chart starts*/
$( document ).ready(function() {
    var randcolors ='#'+(Math.random()*0xFFFFFF<<0).toString(16);
    var DrawSparkline = function() {
        $('#custsparkline1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
            type: 'line',
            width: $('#custsparkline1').width(),
            height: '165',
            chartRangeMax: 50,
            lineColor: '#fb6d9d',
            fillColor: 'transparent',
            highlightLineColor: 'rgba(0,0,0,.1)',
            highlightSpotColor: 'rgba(0,0,0,.2)'
        });

        $('#custsparkline1').sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
            type: 'line',
            width: $('#custsparkline1').width(),
            height: '165',
            chartRangeMax: 40,
            lineColor: '#5d9cec',
            fillColor: 'transparent',
            composite: true,
            highlightLineColor: 'rgba(0,0,0,1)',
            highlightSpotColor: 'rgba(0,0,0,1)'
        });
    
        $('#custsparkline2').sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
            type: 'bar',
            height: '165',
            barWidth: '10',
            barSpacing: '3',
            barColor: '#fb6d9d'
        });
        
	/*	
        $('#custsparkline3').sparkline([20, 15, 30, 10,25], {
            type: 'pie',
            width: '165',
            height: '165',
            sliceColors: ['#dcdcdc', '#5d9cec', '#36404a', '#5fbeaa','#FF6B6B'],
			tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
			tooltipValueLookups: {
				'offset': {
					0: 'Magnetic Mobile Kit by STEELIE',
					1: 'Sayonara Killah-Bees Sunglasses',
					2: 'Arrow Hanger Baby Blue',
					3: 'American Indian Cigar Ashtray',
					4: 'Moto White. Giant Leisure Art Print on Canvas',
				}
			},
        });
    
*/
        
        
    };

    
    DrawSparkline();
    
    var resizeChart;

    $(window).resize(function(e) {
        clearTimeout(resizeChart);
        resizeChart = setTimeout(function() {
            DrawSparkline();
        }, 300);
    });
});

////////////////////
 /* sparkline chart starts*/
!function($) {
    "use strict";

    var DashboardCRM = function() {
    	this.$realData = []
    };
    
     //creates line chart
    DashboardCRM.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          fillOpacity: opacity,
          pointFillColors: Pfillcolor,
          pointStrokeColors: Pstockcolor,
          behaveLikeLine: true,
          gridLineColor: '#eef0f2',
          hideHover: 'auto',
         // resize: true, //defaulted to true
          lineColors: lineColors
        });
    },
  /*  
   //creates Bar chart
    DashboardCRM.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            barColors: lineColors
        });
    },
    
    //creates Donut chart
    DashboardCRM.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true, //defaulted to true
            colors: colors
        });
    }, 
    */
    DashboardCRM.prototype.init = function() {
		 
		var linechartdatavals= $('#linechartdata').val();
		linechartdatavals = JSON.parse(linechartdatavals);
 //console.log(linechartdatavals);
         //create line chart
      /*  var $data  = [
    		 
            { month: '2017-11-03', ordertotal: 25,  customertotal: 44 },
            { month: '2017-12-09', ordertotal: 15, customertotal: 10 }
          ];*/
		   
        this.createLineChart('custmorris-line-chart', linechartdatavals, 'month', ['ordertotal', 'customertotal'], ['Orders', 'Customers'],['0.1'],['#ffffff'],['#999999'], ['#81c868', '#ffbd4a']);
        
  /*    //creating bar chart
        var $barData  = [
            { y: '2009', a: 100, b: 90 },
            { y: '2010', a: 75,  b: 65 },
            { y: '2011', a: 50,  b: 40 },
            { y: '2012', a: 75,  b: 65 },
            { y: '2013', a: 50,  b: 40 },
            { y: '2014', a: 75,  b: 65 },
            { y: '2015', a: 100, b: 90}
        ];
        this.createBarChart('morris-bar-chart', $barData, 'y', ['a', 'b'], ['Won Deals ', 'Lost Deals '], ['#5fbeaa', '#5d9cec']);
        
        //creating donut chart
        var $donutData = [
                {label: "Group 1", value: 12},
                {label: "Group 2", value: 30},
                {label: "Group 3", value: 20}
            ];
        this.createDonutChart('morris-donut-example', $donutData, ['#ebeff2', '#5fbeaa', '#5d9cec']); 
	*/
    },
    //init
    $.DashboardCRM = new DashboardCRM, $.DashboardCRM.Constructor = DashboardCRM
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.DashboardCRM.init();
}(window.jQuery);
 /* morris chart ends*/
 /* sales range chart starts*/
$('#custsalesrange a').on('click', function(e) {
	e.preventDefault();
	
	$(this).parent().parent().find('li').removeClass('active');
	
	$(this).parent().addClass('active');
	
	$.ajax({
		type: 'get',
	//	url: 'index.php?route=dashboard/chart/chart&token=<?php echo $token; ?>&range=' + $(this).attr('href'),
	url: 'get_sales_ajax.php?token=VYKHiGRAvTBATHnkKpG2g3mBN1f7MNpg&range=' + $(this).attr('href'),
	  beforeSend: function () {
            $('.loading-gif').show();
        },
		dataType: 'json',
		success: function(json) {
			$('.loading-gif').fadeOut("slow");
                        if (typeof json['order'] == 'undefined') { return false; }
			var option = {	
				shadowSize: 0,
				colors: ['#9FD5F1', '#1065D2'],
				bars: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF',
					hoverable: true
				},
				points: {
					show: false
				},
				xaxis: {
					show: true,
            		ticks: json['xaxis']
				}
			}
			
			$.plot('#chart-sale', [json['order'], json['customer']], option);	
					
			$('#chart-sale').bind('plothover', function(event, pos, item) {
				$('.tooltip').remove();
			 // console.log(pos);
				if (item) {
					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(3) + '</div></div>').prependTo('body');
					
					$('#tooltip').css({
						position: 'absolute',
						left: item.pageX - ($('#tooltip').outerWidth() / 2),
						top: item.pageY - $('#tooltip').outerHeight(),
						pointer: 'cusror'
					}).fadeIn('slow');	
					
					$('#chart-sale').css('cursor', 'pointer');		
			  	} else {
					$('#chart-sale').css('cursor', 'auto');
				}
			});
		},
        error: function(xhr, ajaxOptions, thrownError) {
           alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});

$('#custsalesrange .active a').trigger('click');
  /* sales range chart starts*/
  
 /* !function($) {
    "use strict";

    var ChartJs = function() {};

    ChartJs.prototype.respChart = function respChart(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            switch(type){
                case 'Line':
                    new Chart(ctx).Line(data, options);
                    break;
                case 'Doughnut':
                    new Chart(ctx).Doughnut(data, options);
                    break;
                case 'Pie':
                    new Chart(ctx).Pie(data, options);
                    break;
                case 'Bar':
                    new Chart(ctx).Bar(data, options);
                    break;
                case 'Radar':
                    new Chart(ctx).Radar(data, options);
                    break;
                case 'PolarArea':
                    new Chart(ctx).PolarArea(data, options);
                    break; 
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();
    },
    //init
    ChartJs.prototype.init = function() {
        //creating lineChart
        var LineChart = {
            labels : ["January","February","March","April","May","June","July"],
            datasets : [
                {
                    fillColor : "rgba(93, 156, 236, 0.5)",
                    strokeColor : "rgba(93, 156, 236, 1)",
                    pointColor : "rgba(93, 156, 236, 1)",
                    pointStrokeColor : "#fff",
                    data : [3,5,0,9,15,23,6]
                },
              
                
            ]
        };
        
        this.respChart($("#custlineChart"),'Line',LineChart); 
         
    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);
*/
