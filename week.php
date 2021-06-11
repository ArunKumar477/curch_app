<?php


function getWeeks( $month, $year ){

	$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$no_of_weeks = (ceil(intval($no_of_days_in_month)/7));

	$week_inc = 0;
	$curr_month_year = $month.'-'.$year;

	$week_arr = array();
	for( $i = 1; $i <= $no_of_weeks; $i++ ){

	    if($week_inc + 7 > $no_of_days_in_month){
	        break;
	    }

	    $week_arr[$i]['start'] = ($week_inc+1)."-".$curr_month_year;
	    $week_arr[$i]['end'] = ($week_inc+7)."-".$curr_month_year;
	    $week_inc += 7;
	}

	return $week_arr;
}

var_dump(getWeeks( '02','2017'));

?>