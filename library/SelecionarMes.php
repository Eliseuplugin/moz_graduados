<?php 
/**
* 
*/
class CalMonth{
	public static function CurrentMonth($month) {
		switch ($month) {
			case 1: $montname="janeiro"; break;
			case 2: $montname="fevereiro"; break;
			case 3: $montname="marco"; break;
			case 4: $montname="abril"; break;
			case 5: $montname="maio"; break;
			case 6: $montname="junho"; break;
			case 7: $montname="julho"; break;
			case 8: $montname="agosto"; break;
			case 9: $montname="setembro"; break;
			case 10: $montname="outubro"; break;
			case 11: $montname="novembro"; break;
			case 12: $montname="dezembro"; break;
		}
	}
	
}