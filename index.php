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
		// Get every brand's detail url
		$brand_url_detail = json_decode($brand_url_detail_json, true);
		// Get Data
		foreach($brand_url as $key1 => $value1){
			$tmp_json = file_get_contents($value1);
			$product = json_decode($tmp_json, true)['result']['productDetailList'];
			//echo json_encode($product);
			$tmp_array = array();
			foreach($product as $value2){
				$tmp = array();
				foreach($value2['relate_products'] as $value3){
					$tmp = array();
					$tmp['cpdt_name'] = $value2['cpdt_name'];
					$tmp['cpdt_num'] = $value3['cpdt_num'];
					$tmp['picpath'] = $value3['picpath'];
					$tmp['detail_url'] = $brand_url_detail[$key1].$value3['cpdt_num'];
					//array_push($tmp, $value3);
					$shoe_detail = json_decode(file_get_contents($brand_url_detail[$key1].$value3['cpdt_num']), true)['standard'];
					$size = array();
					foreach($shoe_detail as $value4){
						array_push($size, $value4['name']);
					}
					$tmp['size'] = $size;
					//array_push($tmp, $shoe_detail);
					
					array_push($tmp_array, $tmp);
				}
				//array_push($tmp_array, $value2['relate_products']);
			}
			//echo json_encode($tmp_array);
			file_put_contents(dirname(__FILE__)."/json/".$key1.".json", json_encode($tmp_array));
			//file_put_contents(dirname(__FILE__)."/json/".$key1.".json", "123<br>");
			//echo dirname(__FILE__)."/json/".$key1.".json<br>";
		}
		echo "執行完成，請重新整理。";
	}else{	
		$brand_url = json_decode($brand_url_json, true);
		foreach($brand_url as $key => $value){
			echo "<a href='./".$key.".php'>".$key."</a><br>";
		}
	}
	// Save TimeStamp
	file_put_contents(dirname(__FILE__)."/lastupdate.flag", time() - (time() % 86400) + 8*3600);
?>

