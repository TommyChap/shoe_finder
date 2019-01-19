<?php
	// Global Setting
	date_default_timezone_set("Asia/Taipei");
	header("Content-Type:text/html; charset=utf-8");
	set_time_limit(0);

	// Get all brand's url of shoes and shoes detail.
        $brand_url_json = file_get_contents(dirname(__FILE__)."/Brand.json");
        $brand_url_detail_json = file_get_contents(dirname(__FILE__)."/BrandDetail.json");
	$last_update_time = file_get_contents(dirname(__FILE__)."/lastupdate.flag");
	if((time() - intval($last_update_time)) > 86400){
		// Get every brand's url
		$brand_url = json_decode($brand_url_json, true);
		foreach($brand_url as $key => $value){
			$tmp_json = file_get_contents($value);
			echo $key."=".$tmp_json."<br>";
		}
		// Get every brand's detail url
		$brand_url_detail = json_decode($brand_url_detail_json, true);
		foreach($brand_url_detail as $key => $value){
			echo $key."=".$value."<br>";
		}
	}
		// Save TimeStamp
		file_put_contents(dirname(__FILE__)."/lastupdate.flag", time() - (time() % 86400) + 8*3600);
?>

