<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

require_once XOOPS_ROOT_PATH."/class/xoopsform/formselect.php";
require_once XOOPS_ROOT_PATH."/class/xoopsform/formelementtray.php";
require_once XOOPS_ROOT_PATH."/class/xoopsform/formlabel.php";

class XoopsFormSelectTime extends XoopsFormElementTray
{

	function XoopsFormSelectTime($caption, $name, $value=array(), $format="%y-%m-%d %h:%i")
	{
		
		if( !is_array( $value ) ){
			$value['year']  = date('Y');
			$value['month'] = date('m');
			$value['day']   = date('d');
			$value['hour']  = date('H');
			$value['min']   = date('i');
			$value['sec']   = date('s');
		}
		
		if( count( $value ) < 6 ){
			$value['year']  = isset( $value['year'] )  ? $value['year']  : date('Y');
			$value['month'] = isset( $value['month'] ) ? $value['month'] : date('m');
			$value['day']   = isset( $value['day'] )   ? $value['day']   : date('d');
			$value['hour']  = isset( $value['hour'] )  ? $value['hour']  : date('H');
			$value['min']   = isset( $value['min'] )   ? $value['min']   : date('i');
			$value['sec']   = isset( $value['sec'] )   ? $value['sec']   : date('s');
		}
		
		$value['year']  = intval($value['year']);
		$value['month'] = intval($value['month']);
		$value['day']   = intval($value['day']);
		$value['hour']  = intval($value['hour']);
		$value['min']   = intval($value['min']);		
		$value['sec']   = intval($value['sec']);		
		
		$this->XoopsFormElementTray($caption, '');

		$thsy = date('Y');
		$year_select  = new XoopsFormSelect('', $name.'[year]', $value['year']);
		$year_select  ->addOptionArray(array($thsy-8=>$thsy-8, $thsy-7, $thsy-6, $thsy-5, $thsy-4, $thsy-3, $thsy-2, $thsy-1, $thsy, $thsy+1));
		$month_select = new XoopsFormSelect('', $name.'[month]', $value['month']);
		$month_select ->addOptionArray(array(1=>1,2,3,4,5,6,7,8,9,10,11,12));
		$day_select   = new XoopsFormSelect('', $name.'[day]', $value['day']);
		$day_select   ->addOptionArray(array(1=>1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31));
		$hour_select  = new XoopsFormSelect('', $name.'[hour]', $value['hour']);
		$hour_select  ->addOptionArray(array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23));
		$sixty_option = array();
		for ($i=0; $i<60; $i++) $sixty_option[] = $i;
		
		$min_select   = new XoopsFormSelect('', $name.'[min]', $value['min']);
		$min_select   ->addOptionArray($sixty_option);			
		$sec_select   = new XoopsFormSelect('', $name.'[sec]', $value['sec']);
		$sec_select   ->addOptionArray($sixty_option);
		
		$format = preg_replace('/%y/i', $year_select->render(), $format );
		$format = preg_replace('/%m/i', $month_select->render(), $format );
		$format = preg_replace('/%d/i', $day_select->render(), $format );
		$format = preg_replace('/%h/i', $hour_select->render(), $format );
		$format = preg_replace('/%i/i', $min_select->render(), $format );
		$format = preg_replace('/%s/i', $sec_select->render(), $format );

		$base_label   = new XoopsFormLabel('', $format);

		$this->addElement($base_label);
	}
}
?>