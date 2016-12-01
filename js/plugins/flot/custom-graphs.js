$(function(){
var data = [{
	label: "Revenue",
	data: 43},
	{
		label: "Non-Revenue",
		data: 57
	}
];
var plotObj = $.plot($("#flot-pie-chart"), data, {
	series{
		pie: {
			show: true
		}
	},
	grid:{
		hoverable: true
	},
	tooltip: true,
	tooltipOpts: {
		content: "%p.0%, %s",
		shifts{
			x: 20,
			y: 0
		},
		defaultTheme: false
	}
});
});
