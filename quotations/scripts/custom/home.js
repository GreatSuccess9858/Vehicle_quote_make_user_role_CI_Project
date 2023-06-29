
$(document).ready(function() {
	var ctx = $("#myChart").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		

	var myLineChart = new Chart(ctx).Line(data_graph, {});

	var options = {
	  }


	var ctx = $("#memberTypesChart").get(0).getContext("2d");
	var myDoughnutChart = new Chart(ctx).Doughnut(social_data,options);

	var legend = myDoughnutChart.generateLegend();
	 $('#membersTypeChatArea').addClass("clearfix").append(legend);
});
