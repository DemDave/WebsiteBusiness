<table border='0' >
<?php

// Define constants or variables for values that may change later

define("SUNDAY", 0);
define("SATURDAY", 6);
$daysToHighlight = array(3,4,10,11,17,18,24,25);
$highlightColor = "bg-green";
$currentDayColor = "bg-blue";

// Get the current date
$date = getdate();

// Get the value of day, month, year
$currentDay = $date['mday'];
$currentMonth = $date['mon'];
$currentWeekday = $date['wday'];
$month = $date['month'];
$year = $date['year'];

// Create an array to store the weekdays of each day in the current month
$days = array();

// Loop backwards from the current day to the first day of the month
// and assign the corresponding weekday to each day
$dayCount = $currentWeekday;
$day = $currentDay;

while($day > 0) {
	$days[$day--] = $dayCount--;
	if($dayCount < SUNDAY)
		$dayCount = SATURDAY;
}

// Loop forward from the current day to the last day of the month
// and assign the corresponding weekday to each day
$dayCount = $currentWeekday;
$day = $currentDay;

// Use the checkdate() function to determine the number of days in the current month
$lastDay = date("t", mktime(0, 0, 0, $currentMonth, 1, $year));

while($day <= $lastDay) {
	$days[$day++] = $dayCount++;
	if($dayCount > SATURDAY)
		$dayCount = SUNDAY;
}

// Display the calendar header with the month and year
echo("<tr>");
echo("<th colspan='7' align='center'>$month $year</th>");
echo("</tr>");

// Display the calendar weekdays with different colors
echo("<tr>");
	echo("<td class='red bg-yellow'>Sun</td>");
	echo("<td class='bg-yellow'>Mon</td>");
	echo("<td class='bg-yellow'>Tue</td>");
	echo("<td class='bg-yellow'>Wed</td>");
	echo("<td class='bg-yellow'>Thu</td>");
	echo("<td class='bg-yellow'>Fri</td>");
	echo("<td class='bg-yellow'>Sat</td>");
echo("</tr>");

// Display the calendar days with different colors and links
$startDay = 0;
$d = $days[1];

echo("<tr>");
// Fill the empty cells before the first day of the month
while($startDay < $d) {
	echo("<td></td>");
	$startDay++;
}

// Use a function to generate the HTML code for each day cell
function displayDayCell($day, $currentDay, $daysToHighlight, $highlightColor, $currentDayColor) {
	// Check if the day is in the highlight array
	if (in_array($day, $daysToHighlight))
		$bg = $highlightColor;
	else
		$bg = "bg-white";
	// Check if the day is the current day
	if($day == $currentDay)
		echo("<td class='$currentDayColor'><a href='#' title='Detail of day'>$day</a></td>");
	else
		echo("<td class='$bg'><a href='#' title='Detail of day'>$day</a></td>");
}

// Loop through the days of the month and display them
for ($d=1;$d<=$lastDay;$d++) {
	displayDayCell($d, $currentDay, $daysToHighlight, $highlightColor, $currentDayColor);
	$startDay++;
	// Start a new row after Saturday
	if($startDay > SATURDAY && $d < $lastDay){
		$startDay = 0;
		echo("</tr>");
		echo("<tr>");
	}
}
echo("</tr>");
?>
</table>