<?php

	// function debug($array , $exit = true) {
	// 	ob_end_flush();
	// 	echo '<pre>';
	// 	print_r($array);
	// 	echo '</pre>';
	// 	ob_start();

	// 	if($exit) exit;
	// }

	function uuid() {
		return sprintf (
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	function get_theme_path($path, $theme){
		
		return url()->full() . '/assets/front/themes/'. $theme . '/' . $path;
	}

	function tempId() {
		return '_tmp_' . uuid();
	}

	function getIp() {
		return Request::ip();
	}

	function getAgentName() {
		$browserName = Agent::browser();
		$version = explode('.', Agent::version($browserName));
		$browserVersion = $version[0];
		$browserPlatform = Agent::platform();

		return $browserName . ' ' . $browserVersion . ' ' . '(' . $browserPlatform . ')';
	}

	function getAgent() {
		return getIp() . ' ' . getAgentName();
	}

	function isEthAddress($address) {
		if (preg_match('/^0x[a-fA-F0-9]{40}$/',$address)) {
			return true;
		}
		return false;
	}

	function isChecksumEthAddress($address) {
		$address = str_replace('0x','',$address);
		$addressHash = hash('sha3',strtolower($address));
		$addressArray=str_split($address);
		$addressHashArray=str_split($addressHash);

		for($i = 0; $i < 40; $i++ ) {
			if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) || (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])) {
				return false;
			}
		}

		return true;
	}

	function calculateTransactionGas($gasUsed, $gasPrice) {
		return ((floatval($gasUsed) * floatval($gasPrice)) / pow(10, 18));
	}

	function wei2eth($wei) {
		return bcdiv($wei,'1000000000000000000',18);
	}

	function numberFormat($bigNum) {
		$explrestunits = "" ;

		$bigNum = explode('.', $bigNum);
		$num = $bigNum[0];

		if(strlen($num) > 3) {
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3);
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
			$expunit = str_split($restunits, 2);
			
			for($i=0; $i<sizeof($expunit); $i++) {
				if($i==0) {
					$explrestunits .= (int)$expunit[$i]."'";
				} else {
					$explrestunits .= $expunit[$i]."'";
				}
			}

			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}

		if(isset($bigNum[1])) {
			return $thecash . '.' . $bigNum[1];
		}

		return $thecash;
	}

	function toTimestampWithCurentTime($date) {
	    //$date = Date('d-m-Y',strtotime($date));
	    $date = new \DateTime($date);
	    $now = new \DateTime('now');
	    $today = new \DateTime(date('Y-m-d'));
	    $time = $today->diff($now);

	    $date->add($time);
	    return $date->format('Y-m-d H:i:s');
	}

	function toTimestampWithOutTime($date) {
	    //$date = Date('d-m-Y',strtotime($date));
	    $date = new \DateTime($date);

	    return $date->format('Y-m-d 00:00:00');
	}

	//  5th Dec 2016 10:17:37 AM
	function toNiceDateAndTime($date) {

	    return date('jS M Y h:i:s A', strtotime($date));
	}

	// 07, Dec 2016
	function toDayMonthYear($date) {

	    return date('d, M Y', strtotime($date));
	}

	// Dec
	function onlyMonth($date) {

	    return date('M', strtotime($date));
	}

	// 07
	function onlyDay($date) {

	    return date('d', strtotime($date));
	}

	// Novermber 10, 2017
	function toMonthDayYear($date) {

	    return date('F d,  Y', strtotime($date));
	}

	// 14-02-2016
	function todmy($date) {

	    return date('d/m/Y', strtotime($date));
	}

	// 02-14-2016
	function tomdy($date) {

	    return date('m-d-Y', strtotime($date));
	}

	// 02-14-2016
	function tomdy_new($date) {

	    return date('m/d/Y', strtotime($date));
	}

	// Dec 06
	function toMMDD($date) {

	    return date('M d', strtotime($date));
	}

	//Thursday 05:00 AM
	function ToDayAndTime($date) {

	    return date('l  h:i A', strtotime($date));
	}

	function toTimestamp($date) {

	    $date = date('Y-m-d H:i:s', strtotime($date));

	    return $date;
	}

	function onlyYear($date) {

	    return date('Y', strtotime($date));
	}

	function getRandomString($n = 10) { 
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString; 
	}
