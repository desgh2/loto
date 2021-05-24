<?php 
	
namespace App\Classes;
	
class Helper
{

	public static function timer($value)
	{
		$dtF = new \DateTime('@');
    	$dtT = new \DateTime("@$value");
    	return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
	}

	public static function jackpot($value)
	{
		$count = strlen($value);
		$m = ' млн';
		$mm = ' млрд';
		if($count == 7) {
			echo substr($value, 0, 1).$m;
		}
		if($count == 8) {
			echo substr($value, 0, 2).$m;
		}
		if($count == 9) {
			echo substr($value, 0, 3).$m;
		}
		if($count == 10) {
			echo substr($value, 0, 1).$mm;
		}
		if($count == 11) {
			echo substr($value, 0, 2).$mm;
		}
		if($count == 12) {
			echo substr($value, 0, 3).$mm;
		}
		
		
	}
	    
}
