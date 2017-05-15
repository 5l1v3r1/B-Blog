<?php

/*
Created by : Jalali
modified by : Mohammad Dayyan
1387/5/15
*/

function mds_date($format, $when="now", $persianNumber = 1)
{
	///chosse your timezone
	$TZhours=0;
	$TZminute=0;
	$need="";
	$result1="";
	$result="";
	if($when=="now"){
		$year=date("Y");
		$month=date("m");
		$day=date("d");
		list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
		$when=mktime(date("H")+$TZhours,date("i")+$TZminute,date("s"),date("m"),date("d"),date("Y"));
	}else{
		//$when=0;
		$when+=$TZhours*3600+$TZminute*60;
		$date=date("Y-m-d",$when);
		list( $year, $month, $day ) = preg_split ( '/-/', $date );

		list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
		}

	$need= $when;
	$year=date("Y",$need);
	$month=date("m",$need);
	$day=date("d",$need);
	$i=0;
	$subtype="";
	$subtypetemp="";
	list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	while($i<strlen($format))
	{
		$subtype=substr($format,$i,1);
		if($subtypetemp=="\\")
		{
			$result.=$subtype;
			$i++;
			continue;
		}

		switch ($subtype)
		{

			case "A":
				$result1=date("a",$need);
				if($result1=="pm") $result.= "بعد از ظهر";
				else $result.="قبل از ظهر";
				break;

			case "a":
				$result1=date("a",$need);
				if($result1=="pm") $result.= "ب.ظ";
				else $result.="ق.ظ";
				break;
			case "d":
				if($Dday<10)$result1="0".$Dday;
				else 	$result1=$Dday;
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "D":
				$result1=date("D",$need);
				switch ($result1) {
					case 'Sat':
						$result1="ش";
						break;
					case 'Sun':
						$result1="ى";
						break;
					case 'Mon':
						$result1="د";
						break;
					case 'Tue':
						$result1="س";
						break;
					case 'Wed':
						$result1="چ";
						break;
					case 'Thu':
						$result1="پ";
						break;
					case 'Fri':
						$result1="ج";
						break;
				}
				$result.=$result1;
				break;
			case"F":
				$result.=monthname($Dmonth);
				break;
			case "g":
				$result1=date("g",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "G":
				$result1=date("G",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
				case "h":
				$result1=date("h",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "H":
				$result1=date("H",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "i":
				$result1=date("i",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "j":
				$result1=$Dday;
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "l":
				$result1=date("l",$need);
				switch ($result1) {
					case 'Saturday':
						$result1="شنبه";
						break;
					case 'Sunday':
						$result1="يكشنبه";
						break;
					case 'Monday':
						$result1="دوشنبه";
						break;
					case 'Tuesday':
						$result1="سه شنبه";
						break;
					case 'Wednesday':
						$result1="چهارشنبه";
						break;
					case 'Thursday':
						$result1="پنجشنبه";
						break;
					case 'Friday':
						$result1="جمعه";
						break;
				}
				$result.=$result1;
				break;
			case "m":
				if($Dmonth<10) $result1="0".$Dmonth;
				else	$result1=$Dmonth;
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "M":
				$result.=short_monthname($Dmonth);
				break;
			case "n":
				$result1=$Dmonth;
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "s":
				$result1=date("s",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "S":
				$result.="ام";
				break;
			case "t":
				$result.=lastday ($month,$day,$year);
				break;
			case "w":
				$result1=date("w",$need);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "y":
				$result1=substr($Dyear,2,4);
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "Y":
				$result1=$Dyear;
				if($persianNumber==1) $result.=Convertnumber2farsi($result1);
				else $result.=$result1;
				break;
			case "U" :
				$result.=mktime();
				break;
			case "Z" :
				$result.=days_of_year($Dmonth,$Dday,$Dyear);
				break;
			case "L" :
				list( $tmp_year, $tmp_month, $tmp_day ) = mds_to_gregorian(1384, 12, 1);
				echo $tmp_day;
				/*if(lastday($tmp_month,$tmp_day,$tmp_year)=="31")
					$result.="1";
				else
					$result.="0";
					*/
				break;
			default:
				$result.=$subtype;
		}
		$subtypetemp=substr($format,$i,1);
	$i++;
	}
	return $result;
}

function make_time($hour="",$minute="",$second="",$Dmonth="",$Dday="",$Dyear="")
{
	if(!$hour && !$minute && !$second && !$Dmonth && !$Dmonth && !$Dday && !$Dyear)
		return mktime();
	if ($Dmonth > 11) die("Incorrect month number");
	list( $year, $month, $day ) = mds_to_gregorian($Dyear, $Dmonth, $Dday);
	$i=mktime($hour,$minute,$second,$month,$day,$year);
	return $i;
}

///Find num of Day Begining Of Month ( 0 for Sat & 6 for Sun)
function mstart($month,$day,$year)
{
	list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	list( $year, $month, $day ) = mds_to_gregorian($Dyear, $Dmonth, "1");
	$timestamp=mktime(0,0,0,$month,$day,$year);
	return date("w",$timestamp);
}

//Find Number Of Days In This Month
function lastday ($month,$day,$year)
{
	$Dday2="";
	$jdate2 ="";
	$lastdayen=date("d",mktime(0,0,0,$month+1,0,$year));
	list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	$lastdatep=$Dday;
	$Dday=$Dday2;
	while($Dday2!="1")
	{
		if($day<$lastdayen)
		{
			$day++;
			list( $Dyear, $Dmonth, $Dday2 ) = gregorian_to_mds($year, $month, $day);
			if($jdate2=="1") break;
			if($jdate2!="1") $lastdatep++;
		}
		else
		{
			$day=0;
			$month++;
			if($month==13)
			{
					$month="1";
					$year++;
			}
		}

	}
	return $lastdatep-1;
}

//Find days in this year untile now
function days_of_year($Dmonth, $Dday, $Dyear)
{
	$year="";
	$month="";
	$year="";
	$result="";
	if($Dmonth=="01")
		return $Dday;
	for ($i=1;$i<$Dmonth || $i==12;$i++)
	{
		list( $year, $month, $day ) = mds_to_gregorian($Dyear, $i, "1");
		$result+=lastday($month,$day,$year);
	}
	return $result+$Dday;
}

//translate number of month to name of month
function monthname($month)
{
	switch ($month) {
		case '01':
			return 'فروردین';
			break;
		case '02':
			return 'اردیبهشت';
			break;
		case '03':
			return 'خرداد';
			break;
		case '04':
			return 'تیر';
			break;
		case '05':
			return 'مرداد';
			break;
		case '06':
			return 'شهریور';
			break;
		case '07':
			return 'مهر';
			break;
		case '08':
			return 'آبان';
			break;
		case '09':
			return 'آذر';
			break;
		case '10':
			return 'دی';
			break;
		case '11':
			return 'بهمن';
			break;
		case '12':
			return 'اسفند';
			break;
	}
}

function short_monthname($month)
{
	switch ($month) {
		case '01':
			return 'فرو';
			break;
		case '02':
			return 'ارد';
			break;
		case '03':
			return 'خرد';
			break;
		case '04':
			return 'تير';
			break;
		case '05':
			return 'مرد';
			break;
		case '06':
			return 'شهر';
			break;
		case '07':
			return 'مهر';
			break;
		case '08':
			return 'آبا';
			break;
		case '09':
			return 'آذر';
			break;
		case '10':
			return 'دی';
			break;
		case '11':
			return 'بهم';
			break;
		case '12':
			return 'اسف';
			break;
	}
}

//converts the numbers into the persian's number
function Convertnumber2farsi($string)
{
	$num = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
	$stringtemp="";
	$len=strlen($string);
	for($sub=0;$sub<$len;$sub++)
	{
		if( substr($string,$sub,1)>=0 AND substr($string,$sub,1)<=9 )
			$stringtemp.= $num[substr($string,$sub,1)];
		else
			$stringtemp.= substr($string,$sub,1);
	}
	return $stringtemp;
}///end conver to number in persian

function is_kabise($year)
{
	if($year%4==0 && $year%100!=0)
		return true;
	return false;
}

function mcheckdate($month,$day,$year)
{
	$m_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
	if($month<=12 && $month>0)
	{
		if($m_days_in_month[$month-1]>=$day && $day>0)
			return 1;
		if(is_kabise($year))
			echo "Asdsd";
		if(is_kabise($year) && $m_days_in_month[$month-1]==31)
			return 1;
	}
	return 0;
}

function mtime()
{
	return mktime()	;
}

function mgetdate($timestamp="")
{
	if($timestamp=="")
		$timestamp=mktime();

	return array(
		0=>$timestamp,
		"seconds"=>mds_date("s",$timestamp),
		"minutes"=>mds_date("i",$timestamp),
		"hours"=>mds_date("G",$timestamp),
		"mday"=>mds_date("j",$timestamp),
		"wday"=>mds_date("w",$timestamp),
		"mon"=>mds_date("n",$timestamp),
		"year"=>mds_date("Y",$timestamp),
		"yday"=>days_of_year(mds_date("m",$timestamp),mds_date("d",$timestamp),mds_date("Y",$timestamp)),
		"weekday"=>mds_date("l",$timestamp),
		"month"=>mds_date("F",$timestamp),
	);
}

function div($a,$b)
{
    return (int) ($a / $b);
}

function gregorian_to_mds ($g_y, $g_m, $g_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $m_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);





   $gy = $g_y-1600;
   $gm = $g_m-1;
   $gd = $g_d-1;

   $g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400);

   for ($i=0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
      /* leap and after Feb */
      $g_day_no++;
   $g_day_no += $gd;

   $m_day_no = $g_day_no-79;

   $j_np = div($m_day_no, 12053); /* 12053 = 365*33 + 32/4 */
   $m_day_no = $m_day_no % 12053;

   $jy = 979+33*$j_np+4*div($m_day_no,1461); /* 1461 = 365*4 + 4/4 */

   $m_day_no %= 1461;

   if ($m_day_no >= 366) {
      $jy += div($m_day_no-1, 365);
      $m_day_no = ($m_day_no-1)%365;
   }

   for ($i = 0; $i < 11 && $m_day_no >= $m_days_in_month[$i]; ++$i)
      $m_day_no -= $m_days_in_month[$i];
   $jm = $i+1;
   $jd = $m_day_no+1;

   return array($jy, $jm, $jd);
}

function mds_to_gregorian($m_y, $j_m, $m_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $m_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);



   $jy = $m_y-979;
   $jm = $j_m-1;
   $jd = $m_d-1;

   $m_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4);
   for ($i=0; $i < $jm; ++$i)
      $m_day_no += $m_days_in_month[$i];

   $m_day_no += $jd;

   $g_day_no = $m_day_no+79;

   $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
   $g_day_no = $g_day_no % 146097;

   $leap = true;
   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
   {
      $g_day_no--;
      $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
      $g_day_no = $g_day_no % 36524;

      if ($g_day_no >= 365)
         $g_day_no++;
      else
         $leap = false;
   }

   $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
   $g_day_no %= 1461;

   if ($g_day_no >= 366) {
      $leap = false;

      $g_day_no--;
      $gy += div($g_day_no, 365);
      $g_day_no = $g_day_no % 365;
   }

   for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
      $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
   $gm = $i+1;
   $gd = $g_day_no+1;

   return array($gy, $gm, $gd);
}

?>
