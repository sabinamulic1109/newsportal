<?php

	function ip_info2($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
		$output = NULL;
		if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ($deep_detect) {
				if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
		}
		$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
		$continents = array(
			"AF" => "Africa",
			"AN" => "Antarctica",
			"AS" => "Asia",
			"EU" => "Europe",
			"OC" => "Australia (Oceania)",
			"NA" => "North America",
			"SA" => "South America"
		);
		if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
			$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
			if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
				switch ($purpose) {
					case "location":
						$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode
						);
						break;
					case "address":
						$address = array($ipdat->geoplugin_countryName);
						if (@strlen($ipdat->geoplugin_regionName) >= 1)
							$address[] = $ipdat->geoplugin_regionName;
						if (@strlen($ipdat->geoplugin_city) >= 1)
							$address[] = $ipdat->geoplugin_city;
						$output = implode(", ", array_reverse($address));
						break;
					case "city":
						$output = @$ipdat->geoplugin_city;
						break;
					case "state":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "region":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "country":
						$output = @$ipdat->geoplugin_countryName;
						break;
					case "countrycode":
						$output = @$ipdat->geoplugin_countryCode;
						break;
				}
			}
		}
		return $output;
	}


	$date = date('Y-m-d');
	$ipadresa = $_SERVER['REMOTE_ADDR'];
	
	/* $oglasiid je ona varijabla koja je u oglasi.php dobivena preko GET metode */
	
	$sql = "SELECT * from tblvisitoglasi where oglasiid = $oglasiid and date ='$date' and ipaddress = '$ipadresa'"; 
	$result = mysqli_query ($con,$sql);
	$count=mysqli_num_rows($result);
	$posjete = array();	
	if($result == true){
		while($row = mysqli_fetch_array($result)){
			$posjete[] = $row;
		}
	}

	if(count($posjete) == 0 ){
		$country = ip_info2($ipadresa, "Country"); 
		$state =  ip_info2($ipadresa, "State"); 
		$city = ip_info2($ipadresa, "City");
		
		$unos = "INSERT INTO tblvisitoglasi(date, ipaddress, oglasiid, country, city, state) 
				VALUES ('$date','$ipadresa','$oglasiid','$country','$city','$state')";
		$result = mysqli_query ($con,$unos);
		if($result == true){
			$sql = "SELECT visits FROM oglasi WHERE id =  $oglasiid"; 
			$result = mysqli_query ($con,$sql);
			$spremi = array();	
			while($row = mysqli_fetch_array($result)){
				$spremi[] = $row;
			}
			$counter = $spremi[0]['visits'] + 1;
			$sql = "UPDATE oglasi SET visits=$counter WHERE id = $oglasiid";
			$result = mysqli_query ($con,$sql);
		}
	}else{
		
	}

?>