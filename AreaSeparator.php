<?php

// Lee Cock 
// santeri1994kokkonen@gmail.com 
// 27.01.2019 

/* 
example: $ar1 = array ( 
	"4001" => array( 
		"omakoti" => 50, 
		"kerros" => 120, 
		"yritys" => 75, 
		), 
	"4003" => array( 
		"omakoti" => 200, 
		"kerros" => 75, 
		"yritys" => 10, 
		) 
	); 

$ar = array( 
	"4001" => 170, 
	"4003" => 210 
	); 

$obj = new AreaSeparator($ar1); 
$obj->separateAreas($ar); :: returns 4001->(omakoti->50,kerros->120,yritys->0), 4003->(omakoti->200,kerros->0,yritys->10) 

 */


class AreaSeparator { 
	
	private $area_list; 
	
	public function __construct(array $arealist = array()) { 
		$this->area_list = $arealist; 
	} 
	
	public function __destruct() {} 
		
	public function separateAreas(array $inputlist = array()) { 
		return $this->count($inputlist); 
	} 
	
	private function count(array $inputlist = array()) { 
		
		$wanted_array = array(); 
		$keys = array_keys($inputlist); 
		
		function getBinary(array $area_array = array(), $amount) { 
			
			$keys = array_keys($area_array); 
			$binary = array(); 
			
			for($i = 0; $i < count($keys); ++$i) { 
				$binary[$keys[$i]] = 0; 
			} 
			
			$sum = 0; 
			while ($sum != $amount) { 
				
				$sum = 0; 
				$counter = 0; 
				while(1) { 
					if ($binary[$keys[$counter]] == 0) { 
						$binary[$keys[$counter]] = 1; 
						break; 
					} else { 
						$binary[$keys[$counter]] = 0; 
						$counter++; 
					} 
				} 
				
				for($i = 0; $i < count($keys); ++$i) { 
					$sum = $sum + (intval($area_array[$keys[$i]]) * $binary[$keys[$i]]); 
				} 
			} 
			
			for($i = 0; $i < count($keys); ++$i) { 
				if ($binary[$keys[$i]] == 0) { 
					$area_array[$keys[$i]] = "0"; 
				} 
			} 
			
			return $area_array; 
		} 
		
		for($i = 0; $i < count($keys); ++$i) { 
			$wanted_array[$keys[$i]] = getBinary($this->area_list[$keys[$i]], $inputlist[$keys[$i]]); 
		} 
		
		return $wanted_array; 
	} 
}

?>
