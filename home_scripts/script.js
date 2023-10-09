$(document).ready(function() {
	//Get today's date (number and word)
	var today = new Date();
	var todayNumber = today.getDate();
	var todayWord = today.getDay();
	//max days in this month to stop in calendar
	var maxDaysThisMonth = new Date(today.getYear()+1900, today.getMonth()+1, 0).getDate();
	//set the IDs of each <td> according to their number in order
	//this is necessary for some reason, since to use .append() to add actual HTML rather than just plain text
	//    jQuery requires to select the elements with their ID rather than just get an array through $("td")
	//    and cycle through the elements of the array
	$('#table td').attr('id', function(i) {
		return (i+1);
	});
	//get index for the day name of the first day of the month
	var firstDay = new Date(today.getYear()+1900, today.getMonth(), 1).getDay();
	//add the number and the textarea for each box in the calendar
	//increase the number by 1 each iteration
	for (var i = 1; i <= maxDaysThisMonth; i++) {
		$("td#" + String(firstDay+i)).append(String(i));
		$("td#" + String(firstDay+i)).append("<br><textarea rows=4 id=\'ta" + i + "\' name=\'" + i + "\'></textarea>");
	}
	
	//use content and input into the boxes
	for (var key in content) {
        decoded = $('#ta' + key).html(content[key]).text(); 
	    $("#ta" + key).val(decoded); 
	}

	//add "current" class to the <td> with today's date
	$("td#" + String(todayNumber + firstDay)).addClass("current");
	//toggle "highlighted" class when a <td> is clicked
	$("td").click(function() {
		$(this).toggleClass("highlighted");
	});
});