<?php 
	/**
	* 
	*/
	class Convert
	{
		protected $CI;

		function __construct()
		{
			$this->CI =& get_instance();
			// $this->CI->load->library('convert');
		}
	
		// function GregorianToHijriah($GYear, $GMonth, $GDay) {
		// 	$y = $GYear;
		// 	$m = $GMonth;
		// 	$d = $GDay;
		// 	$jd = GregoriantoJD($m, $d, $y);
		// 	$l = $jd - 1948440 + 10632;
		// 	$n = (int) (( $l - 1 ) / 10631);
		// 	$l = $l - 10631 * $n + 354;
		// 	$j = ( (int) (( 10985 - $l ) / 5316)) * ( (int) (( 50 * $l) / 17719)) + (
		// 	(int) ( $l / 5670 )) * ( (int) (( 43 * $l ) / 15238 ));
		// 	$l = $l - ( (int) (( 30 - $j ) / 15 )) * ( (int) (( 17719 * $j ) / 50)) - (
		// 	(int) ( $j / 16 )) * ( (int) (( 15238 * $j ) / 43 )) + 29;
		// 	$m = (int) (( 24 * $l ) / 709 );
		// 	$d = $l - (int) (( 709 * $m ) / 24);
		// 	$y = 30 * $n + $j - 30;
			 
		// 	$Hijriah['year'] = $y;
		// 	$Hijriah['month'] = $m;
		// 	$Hijriah['day'] = $d;
			 
		// 	return $Hijriah;
		// }

		function Days($Y, $M, $D){
		   if ($M < 3){ 
		   	$Y -= 1; 
		   	$M +=12;
		   }
		   $Y = $Y - 2000;
		   $d1 = floor(365.25 * $Y);
		   $d2 = floor(30.6001 * ($M + 1));
		   $A = floor($Y / 100);
		   $B = floor($Y / 400);
		   $hari = $d1 + $d2 - $A + $B + $D + 196;
		   return $hari;
	 	}
		function DaysHijri($Y, $M, $D){
			$_lunarY = 354.367068;
			$d1 = floor((29.5 * $M) - 28.999);
		  	$Y = $Y - 1420;
		  	$d2 = floor($_lunarY * $Y);
		  	$hari = $d1 + $d2 + $D;
		  	return $hari;
		}

		function GregorianToHijriah($Hyear, $Hmounth, $Hday){
			$_lunarY = 354.367068;
			$nday = $this->Days($Hyear, $Hmounth, $Hday);
		    $tahun = floor($nday/$_lunarY) + 1420;
		    $bulan = 1;
		    $harike = 1;
		  
		    while($this->DaysHijri($tahun, $bulan, 1) <= $nday){$tahun++;}
		    $tahun--;
		  
		    while($this->DaysHijri($tahun, $bulan, 1) <= $nday){$bulan++;}
		    $bulan--;
		  
		    $harike = 1 + $nday - $this->DaysHijri($tahun, $bulan, 1);
		    if($bulan == 13){
		    	$bulan = 12; 
		    	$harike += 29;
		    }	  
		    $tanggal['day'] = $harike;
		    $tanggal['month'] = $bulan;
		    $tanggal['year'] = $tahun;
		    return $tanggal;
		}

		function toGregorian($Hyear, $Hmounth, $Hday){
			$_solarY = 365.2425;
			$nday = $this->DaysHijri($Hyear, $Hmounth, $Hday);
			// print_r(DaysHijri($tahun, $bulan, $hari));
			//print_r($nday."<br>");
			$nday1 = $nday - 258;
			// print_r($nday1." ");
			$tahun = floor($nday1 / $_solarY) + 2000;
			$bulan = 1;
			$harike = 1;
			$day = $this->Days($tahun, $bulan, 1);
			// print_r($this->Days($tahun, $bulan, 1)." ");
			// print_r($nday);

			while ($this->Days($tahun, $bulan, 1) <= $nday) {
				$tahun++;
				
			}
			$tahun--;

			while ($this->Days($tahun, $bulan, 1) <= $nday) {
				$bulan++;
			}

			$bulan--;

			// while ( Days($tahun, $bulan, 1) <= $nday) {
				
			// }

			$harike= 1 + $nday - $this->Days($tahun, $bulan, 1);
			// print_r($this->Days($tahun, $bulan, 1)." ");
			// print_r($harike." ");
			// print_r($nday." ");
			// if ($bulan == 13) {
			// 	$bulan = 12;
			// 	$harike += 29
			// }

			$tanggal['day'] = $harike;
			$tanggal['month'] = $bulan;
			$tanggal['year'] = $tahun;
			return $tanggal;

			// print_r($tanggal['day']);
			// print_r($tanggal['month']);
			// print_r($tanggal['year']);
		}
	}
 ?>