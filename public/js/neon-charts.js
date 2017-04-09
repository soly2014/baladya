/**
 *	Neon Charts Scripts
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		
		// // Rickshaw Graphs
		if(typeof Rickshaw != 'undefined')
		{
			// Graph 1
			// var graph = new Rickshaw.Graph( {
			// 		element: document.querySelector("#chart1"),
			// 		renderer: 'area',
			// 		stroke: true,
			// 		height: 120,
			// 		series: [ {
			// 				data: [ { x: 0, y: 40 }, { x: 1, y: 49 }, {x: 2, y: 33}, {x: 3, y: 57}, {x: 4, y: 68} ],
			// 				color: 'steelblue'
			// 		}, {
			// 				data: [ { x: 0, y: 40 }, { x: 1, y: 49 }, {x: 2, y: 6}, {x: 3, y: 13}, {x: 4, y: 19} ],
			// 				color: 'lightblue'
			// 		} ]
			// } );

			// graph.render();
            //
            //
			// // Graph 2
			// var seriesData = [ [], [], [], [], [], [], [], [], [] ];
			// var random = new Rickshaw.Fixtures.RandomData(150);
			//
			// for (var i = 0; i < 100; i++) {
			// 	random.addData(seriesData);
			// }
			//
			// var palette = new Rickshaw.Color.Palette( { scheme: 'classic9' } );


			// var graph = new Rickshaw.Graph( {
			// 	element: document.getElementById("chart2"),
			// 	height: 120,
			// 	renderer: 'area',
			// 	stroke: true,
			// 	preserve: true,
			// 	series: [
			// 		{
			// 			color: palette.color(),
			// 			data: seriesData[0],
			// 			name: 'Moscow'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[1],
			// 			name: 'Shanghai'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[2],
			// 			name: 'Amsterdam'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[3],
			// 			name: 'Paris'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[4],
			// 			name: 'Tokyo'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[5],
			// 			name: 'London'
			// 		}, {
			// 			color: palette.color(),
			// 			data: seriesData[6],
			// 			name: 'New York'
			// 		}
			// 	]
			// } );

			// graph.render();
		}
		
	
		// Morris.js Graphs
		if(typeof Morris != 'undefined')
		{
			$.ajax({
				url: '/report/report',
				type: "get",
				success: function(data){
					console.log(data);
					// $.each(data,function(key,item) {
					//
					// });
				}
			});
			// Bar Charts

            $.ajax({
                url: '/report/viol-vs-resquars',
                type: "get",
                success: function(data){
                    console.log(data);
                    Morris.Bar({
                        element: 'chart3',
                        axes: true,
                        data: data,
                        xkey: 'x',
                        ykeys: ['y', 'z', 'a'],
                        labels: ['مخالفات', '', ''],
                        barColors: [getRandomColor(), '', '']
                    });
                }
            });

			
			// Stacked Bar Charts

            $.ajax({
                url: '/report/viol-vs-services',
                type: "get",
                success: function(data){
                    console.log(data);
                    Morris.Bar({
                        element: 'chart4',
                        data: data,
                        xkey: 'x',
                        ykeys: ['y', ],
                        labels: ['مخالفات', '', ''],
                        stacked: true,
                        barColors: [getRandomColor(), '#ff6264', '#d13c3e']
                    });
                }
            });

			
			// Donut
            $.ajax({
                url: '/report/visit-vs-resquars',
                type: "get",
                success: function(data){
                    console.log(data);
                    Morris.Donut({
                        element: 'chart5',
                        data: data.data,
                        labelColor: getRandomColor(),
                        colors: data.colors
                    });
                }
            });

			// Donut Colors
            $.ajax({
                url: '/report/visit-vs-days',
                type: "get",
                success: function(data){
                    console.log(data);
                    Morris.Donut({
                        element: 'chart6',
                        data: data.data,
                        labelColor: getRandomColor(),
                        colors: data.colors
                    });
                }
            });

			
			// Donut Formatting

			// Morris.Donut({
			// 	element: 'chart7',
			// 	data: [
			// 		{value: 70, label: 'foo', formatted: 'at least 70%' },
			// 		{value: 15, label: 'bar', formatted: 'approx. 15%' },
			// 		{value: 10, label: 'baz', formatted: 'approx. 10%' },
			// 		{value: 5, label: 'A really really long label', formatted: 'at most 5%' }
			// 	],
			// 	formatter: function (x, data) { return data.formatted; },
			// 	colors: ['#b92527', '#d13c3e', '#ff6264', '#ffaaab']
			// });
			
			
			// Line Chart
			// var day_data = [
			// 	{"elapsed": "البيضاء", "value": 34},
			// 	{"elapsed": "البيضاء", "value": 24},
			// 	{"elapsed": "البيضاء", "value": 3},
			// 	{"elapsed": "البيضاء", "value": 12},
			// 	{"elapsed": "البيضاء", "value": 13},
			// 	{"elapsed": "البيضاء", "value": 22},
			// 	{"elapsed": "البيضاء", "value": 5},
			// 	{"elapsed": "البيضاء", "value": 26},
			// 	{"elapsed": "البيضاء", "value": 12},
			// 	{"elapsed": "البيضاء", "value": 19}
			// ];


            $.ajax({
                url: '/report/viol-vs-months',
                type: "get",
                success: function(data){
                    console.log(data);
                    Morris.Line({
                        element: 'chart8',
                        data: data,
                        xkey: 'elapsed',
                        ykeys: ['value'],
                        labels: ['value'],
                        parseTime: false,
                        lineColors: [getRandomColor()]
                    });
                    // $.each(data,function(key,item) {
                    //
                    // });
                }
            });

			
			
			
			// Goals
			var decimal_data = [];
			
			for (var x = 0; x <= 360; x += 10) {
				decimal_data.push({
				x: x,
				y: Math.sin(Math.PI * x / 180).toFixed(4)
				});
			}
			
			// Morris.Line({
			// 	element: 'chart9',
			// 	data: decimal_data,
			// 	xkey: 'x',
			// 	ykeys: ['y'],
			// 	labels: ['sin(x)'],
			// 	parseTime: false,
			// 	goals: [-1, 0, 1],
			// 	lineColors: [getRandomColor()]
			// });


			$.ajax({
				url: '/report/viol-vs-days',
				type: "get",
				success: function(data){
					console.log(data);
					Morris.Line({
						element: 'chart10',
						data: data,
						xkey: 'elapsed',
						ykeys: ['value'],
						labels: ['value'],
						parseTime: false,
						lineColors: [getRandomColor()]
					});
					// $.each(data,function(key,item) {
					//
					// });
				}
			});
			// Area Chart

		}
		
		
		// Peity Graphs
		if($.isFunction($.fn.peity))
		{
			$("span.pie").peity("pie", {colours: ['#0e8bcb', '#57b400'], width: 150, height: 25});
			$(".panel span.line").peity("line", {width: 150});
			$("span.bar").peity("bar", {width: 150});
			
			var updatingChart = $(".updating-chart").peity("line", { width: 150 })

			setInterval(function() 
			{
				var random = Math.round(Math.random() * 10);
				var values = updatingChart.text().split(",");
				
				values.shift()
				values.push(random);
				
				updatingChart.text(values.join(",")).change();
				$("#peity-right-now").text(random + ' user' + (random != 1 ? 's' : ''));
				
			}, 1000)
		}
		
		
	});
	
})(jQuery, window);


			
function data(offset) {
	var ret = [];
	for (var x = 0; x <= 360; x += 10) {
		var v = (offset + x) % 360;
		ret.push({
			x: x,
			y: Math.sin(Math.PI * v / 180).toFixed(4),
			z: Math.cos(Math.PI * v / 180).toFixed(4),
		});
	}
	return ret;
}
 
 
function getRandomInt(min, max) 
{
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}