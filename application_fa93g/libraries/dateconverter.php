<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	Class DateConverter {
		
		public function __construct()
		{
			
		}
		
		private $bs = array(
			0=>array(2000,30,32,31,32,31,30,30,30,29,30,29,31),
			1=>array(2001,31,31,32,31,31,31,30,29,30,29,30,30),
			2=>array(2002,31,31,32,32,31,30,30,29,30,29,30,30),
			3=>array(2003,31,32,31,32,31,30,30,30,29,29,30,31),
			4=>array(2004,30,32,31,32,31,30,30,30,29,30,29,31),
			5=>array(2005,31,31,32,31,31,31,30,29,30,29,30,30),
			6=>array(2006,31,31,32,32,31,30,30,29,30,29,30,30),
			7=>array(2007,31,32,31,32,31,30,30,30,29,29,30,31),
			8=>array(2008,31,31,31,32,31,31,29,30,30,29,29,31),
			9=>array(2009,31,31,32,31,31,31,30,29,30,29,30,30),
			10=>array(2010,31,31,32,32,31,30,30,29,30,29,30,30),
			11=>array(2011,31,32,31,32,31,30,30,30,29,29,30,31),
			12=>array(2012,31,31,31,32,31,31,29,30,30,29,30,30),
			13=>array(2013,31,31,32,31,31,31,30,29,30,29,30,30),
			14=>array(2014,31,31,32,32,31,30,30,29,30,29,30,30),
			15=>array(2015,31,32,31,32,31,30,30,30,29,29,30,31),
			16=>array(2016,31,31,31,32,31,31,29,30,30,29,30,30),
			17=>array(2017,31,31,32,31,31,31,30,29,30,29,30,30),
			18=>array(2018,31,32,31,32,31,30,30,29,30,29,30,30),
			19=>array(2019,31,32,31,32,31,30,30,30,29,30,29,31),
			20=>array(2020,31,31,31,32,31,31,30,29,30,29,30,30),
			21=>array(2021,31,31,32,31,31,31,30,29,30,29,30,30),
			22=>array(2022,31,32,31,32,31,30,30,30,29,29,30,30),
			23=>array(2023,31,32,31,32,31,30,30,30,29,30,29,31),
			24=>array(2024,31,31,31,32,31,31,30,29,30,29,30,30),
			25=>array(2025,31,31,32,31,31,31,30,29,30,29,30,30),
			26=>array(2026,31,32,31,32,31,30,30,30,29,29,30,31),
			27=>array(2027,30,32,31,32,31,30,30,30,29,30,29,31),
			28=>array(2028,31,31,32,31,31,31,30,29,30,29,30,30),
			29=>array(2029,31,31,32,31,32,30,30,29,30,29,30,30),
			30=>array(2030,31,32,31,32,31,30,30,30,29,29,30,31),
			31=>array(2031,30,32,31,32,31,30,30,30,29,30,29,31),
			32=>array(2032,31,31,32,31,31,31,30,29,30,29,30,30),
			33=>array(2033,31,31,32,32,31,30,30,29,30,29,30,30),
			34=>array(2034,31,32,31,32,31,30,30,30,29,29,30,31), 
			35=>array(2035,30,32,31,32,31,31,29,30,30,29,29,31),
			36=>array(2036,31,31,32,31,31,31,30,29,30,29,30,30),
			37=>array(2037,31,31,32,32,31,30,30,29,30,29,30,30),
			38=>array(2038,31,32,31,32,31,30,30,30,29,29,30,31),
			39=>array(2039,31,31,31,32,31,31,29,30,30,29,30,30),
			40=>array(2040,31,31,32,31,31,31,30,29,30,29,30,30),
			41=>array(2041,31,31,32,32,31,30,30,29,30,29,30,30),
			42=>array(2042,31,32,31,32,31,30,30,30,29,29,30,31),
			43=>array(2043,31,31,31,32,31,31,29,30,30,29,30,30),
			44=>array(2044,31,31,32,31,31,31,30,29,30,29,30,30),
			45=>array(2045,31,32,31,32,31,30,30,29,30,29,30,30),
			46=>array(2046,31,32,31,32,31,30,30,30,29,29,30,31),
			47=>array(2047,31,31,31,32,31,31,30,29,30,29,30,30),
			48=>array(2048,31,31,32,31,31,31,30,29,30,29,30,30),
			49=>array(2049,31,32,31,32,31,30,30,30,29,29,30,30),
			50=>array(2050,31,32,31,32,31,30,30,30,29,30,29,31),
			51=>array(2051,31,31,31,32,31,31,30,29,30,29,30,30),
			52=>array(2052,31,31,32,31,31,31,30,29,30,29,30,30),
			53=>array(2053,31,32,31,32,31,30,30,30,29,29,30,30),
			54=>array(2054,31,32,31,32,31,30,30,30,29,30,29,31),
			55=>array(2055,31,31,32,31,31,31,30,29,30,29,30,30),
			56=>array(2056,31,31,32,31,32,30,30,29,30,29,30,30),
			57=>array(2057,31,32,31,32,31,30,30,30,29,29,30,31),
			58=>array(2058,30,32,31,32,31,30,30,30,29,30,29,31),
			59=>array(2059,31,31,32,31,31,31,30,29,30,29,30,30),
			60=>array(2060,31,31,32,32,31,30,30,29,30,29,30,30),
			61=>array(2061,31,32,31,32,31,30,30,30,29,29,30,31),
		    62=>array(2062,30,32,31,32,31,31,29,30,29,30,29,31),
			63=>array(2063,31,31,32,31,31,31,30,29,30,29,30,30),
			64=>array(2064,31,31,32,32,31,30,30,29,30,29,30,30),
			65=>array(2065,31,32,31,32,31,30,30,30,29,29,30,31),
			66=>array(2066,31,31,31,32,31,31,29,30,30,29,29,31),
			67=>array(2067,31,31,32,31,31,31,30,29,30,29,30,30),
			68=>array(2068,31,31,32,32,31,30,30,29,30,29,30,30),
			69=>array(2069,31,32,31,32,31,30,30,30,29,29,30,31),
			70=>array(2070,31,31,31,32,31,31,29,30,30,29,30,30),
			71=>array(2071,31,31,32,31,31,31,30,29,30,29,30,30),
			72=>array(2072,31,32,31,32,31,30,30,29,30,29,30,30),
			73=>array(2073,31,32,31,32,31,30,30,30,29,29,30,31),
			74=>array(2074,31,31,31,32,31,31,30,29,30,29,30,30),
			75=>array(2075,31,31,32,31,31,31,30,29,30,29,30,30),
			76=>array(2076,31,32,31,32,31,30,30,30,29,29,30,30),
			77=>array(2077,31,32,31,32,31,30,30,30,29,30,29,31),
			78=>array(2078,31,31,31,32,31,31,30,29,30,29,30,30),
			79=>array(2079,31,31,32,31,31,31,30,29,30,29,30,30),
			80=>array(2080,31,32,31,32,31,30,30,30,29,29,30,30),
			81=>array(2081, 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			82=>array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			83=>array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
			84=>array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
			85=>array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
			86=>array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			87=>array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
			88=>array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
			89=>array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			90=>array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30)
			);
	 	
	 	private $nep_date = array('year'=>'', 'month'=>'', 'date'=>'', 'day'=>'','nmonth'=>'','num_day'=>'');
	 	private $eng_date = array('year'=>'', 'month'=>'', 'date'=>'', 'day'=>'','emonth'=>'','num_day'=>'');
	 	public $debug_info = "";
	
	
		/**
		 * Calculates wheather english year is leap year or not
		 *
		 * @param integer $year
		 * @return boolean
		 */
		public function is_leap_year($year)
		{
			$a = $year;
			if ($a%100==0)
			{
			 if($a%400==0)
			 {
				return true;
			 } else {
			 	return false;
			 }
				
			} else { 
				if ($a%4==0)
				{
					return true;
				} else {
					return false;
				}
			}
		}
	
		private function get_nepali_month($m){
			$n_month = false;
			
			switch($m){
				case 1:
					$n_month = "Baishak";
					break;
					
				case 2:
					$n_month = "Jestha";
					break;
					
				case 3:
					$n_month = "Ashad";
					break;
					
				case 4:
					$n_month = "Shrawn";
					break;
					
				case 5:
					$n_month = "Bhadra";
					break;
				
				case 6:
					$n_month = "Ashwin";
					break;
				
				case 7:
					$n_month = "kartik";
					break;
				
				case 8:
					$n_month = "Mangshir";
					break;
				
				case 9:
					$n_month = "Poush";
					break;
				
				case 10:
					$n_month = "Magh";
					break;
				
				case 11:
					$n_month = "Falgun";
					break;
				
				case 12:
					$n_month = "Chaitra";
					break;
			}	
			return  $n_month;
		}
	
		private function get_english_month($m){
			$eMonth = false;
			switch($m){
				case 1:
					$eMonth = "January";
					break;
				case 2:
					$eMonth = "February";
					break;
				case 3:
					$eMonth = "March";
					break;
				case 4:
					$eMonth = "April";
					break;
				case 5:
					$eMonth = "May";
					break;
				case 6:
					$eMonth = "June";
					break;
				case 7:
					$eMonth = "July";
					break;
				case 8:
					$eMonth = "August";
					break;
				case 9:
					$eMonth = "September";
					break;
				case 10:
					$eMonth = "October";
					break;
				case 11:
					$eMonth = "November";
					break;
				case 12:
					$eMonth = "December";
			}
			return $eMonth;	
		}
	
		private function get_day_of_week($day){		
			switch($day){
				case 1:
					$day = "Sunday";
					break;
					
				case 2:
					$day = "Monday";
					break;
					
				case 3:
					$day = "Tuesday";
					break;
				
				case 4:
					$day = "Wednesday";
					break;
				
				case 5:
					$day = "Thursday";
					break;
				
				case 6:
					$day = "Friday";
					break;
				
				case 7:
					$day = "Saturday";
					break;
			}
			return $day;
		}
	
	
		private function is_range_eng($yy, $mm, $dd){
			if($yy<1944 || $yy>2033){
				$this->debug_info = "Supported only between 1944-2022";
				return false;
			}
				
			if($mm<1 || $mm >12){
				$this->debug_info = "Error! value 1-12 only";
				return false;
			}
				
			if($dd<1 || $dd >31){
				$this->debug_info = "Error! value 1-31 only";			
				return false;
			}	
			
			return true;
		}
	
		private function is_range_nep($yy, $mm, $dd){		
			if($yy<2000 || $yy>2089){
				$this->debug_info="Supported only between 2000-2089";
				return false;
			}
			
			if($mm<1 || $mm >12) {
				$this->debug_info="Error! value 1-12 only";
				return false;
			}
			
			if($dd<1 || $dd >32){
				$this->debug_info="Error! value 1-31 only";	
				return false;
			}		
			
			return true;
		}	
		
		
		/**
		 * currently can only calculate the date between AD 1944-2033...
		 *
		 * @param unknown_type $yy
		 * @param unknown_type $mm
		 * @param unknown_type $dd
		 * @return unknown
		 */
		
		public function eng_to_nep($yy,$mm,$dd){
			if ($this->is_range_eng($yy, $mm, $dd) == false){
				return false;
			} else {			
				
				// english month data.
			 	$month = array(31,28,31,30,31,30,31,31,30,31,30,31);
			 	$lmonth = array(31,29,31,30,31,30,31,31,30,31,30,31);
				
				$def_eyy = 1944;									//spear head english date...
				$def_nyy = 2000; $def_nmm = 9; $def_ndd = 17-1;		//spear head nepali date...
				$total_eDays=0; $total_nDays=0; $a=0; $day=7-1;		//all the initializations...
				$m = 0; $y = 0; $i =0; $j = 0;
				$numDay=0;
				
				// count total no. of days in-terms of year
				for($i=0; $i<($yy-$def_eyy); $i++){	//total days for month calculation...(english)
					if($this->is_leap_year($def_eyy+$i)==1)
						for($j=0; $j<12; $j++)
							$total_eDays += $lmonth[$j];
					else
						for($j=0; $j<12; $j++)
							$total_eDays += $month[$j];
				}
				
				// count total no. of days in-terms of month					
				for($i=0; $i<($mm-1); $i++){		
					if($this->is_leap_year($yy)==1)
						$total_eDays += $lmonth[$i];
					else
						$total_eDays += $month[$i];
				}
				
				// count total no. of days in-terms of date
				$total_eDays += $dd;
				
				
				$i = 0; $j = $def_nmm;					
				$total_nDays = $def_ndd;
				$m = $def_nmm;
				$y = $def_nyy;
				
				// count nepali date from array
				while($total_eDays != 0) {
			        $a = $this->bs[$i][$j];
					$total_nDays++;						//count the days
					$day++;								//count the days interms of 7 days
					if($total_nDays > $a){
						$m++;
						$total_nDays=1;
						$j++;
					}
					if($day > 7)
						$day = 1;
					if($m > 12){
						$y++;
						$m = 1;
					}
				    if($j > 12){
						$j = 1; $i++;
					}
					$total_eDays--;
				}
				
				$numDay=$day;
				
				$this->nep_date["year"] = $y;
				$this->nep_date["month"] = $m;
				$this->nep_date["date"] = $total_nDays;
				$this->nep_date["day"] = $this->get_day_of_week($day);
				$this->nep_date["nmonth"] = $this->get_nepali_month($m);
				$this->nep_date["num_day"] = $numDay;
				return $this->nep_date;
			}
		}
		
		
		/**
		 * currently can only calculate the date between BS 2000-2089
		 *
		 * @param unknown_type $yy
		 * @param unknown_type $mm
		 * @param unknown_type $dd
		 * @return unknown
		 */
		public function nep_to_eng($yy,$mm,$dd){
			
			$def_eyy = 1943	; $def_emm=4 ; $def_edd=14-1;		// init english date.
			$def_nyy = 2000; $def_nmm = 1; $def_ndd = 1;		// equivalent nepali date.
			$total_eDays=0; $total_nDays=0; $a=0; $day=4-1;		// initializations...
			$m = 0; $y = 0; $i=0;
			$k = 0;	$numDay = 0;
			
			$month = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
 			$lmonth = array(0,31,29,31,30,31,30,31,31,30,31,30,31);
			
			if($this->is_range_nep($yy, $mm, $dd)===false){
				return false;
				
			} else {
				
				// count total days in-terms of year
				for($i=0; $i<($yy-$def_nyy); $i++){	
					for($j=1; $j<=12; $j++){
						$total_nDays += $this->bs[$k][$j];
					}
					$k++;
				}
				
				// count total days in-terms of month			
				for($j=1; $j<$mm; $j++){
					$total_nDays += $this->bs[$k][$j];
				}
				
				// count total days in-terms of dat
				$total_nDays += $dd;			
				
				//calculation of equivalent english date...
				$total_eDays = $def_edd;
				$m = $def_emm;
				$y = $def_eyy;
				while($total_nDays != 0){
					if($this->is_leap_year($y))
					{
						$a = $lmonth[$m];
					}
					else
					{
						$a = $month[$m];
					}
					$total_eDays++;
					$day++;
					if($total_eDays > $a){
						$m++;
						$total_eDays = 1;
						if($m > 12){
							$y++;
							$m = 1;
						}	
					}
					if($day > 7)
						$day = 1;
					$total_nDays--;	
				}
				$numDay = $day;
				
				$this->eng_date["year"] = $y;
				$this->eng_date["month"] = $m;
				$this->eng_date["date"] = $total_eDays;
				$this->eng_date["day"] = $this->get_day_of_week($day);
				$this->eng_date["emonth"] = $this->get_english_month($m);
				$this->eng_date["num_day"] = $numDay;
				
				return $this->eng_date;
				
			}
		}
	
	};