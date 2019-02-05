<?php
	// Global Setting
	date_default_timezone_set("Asia/Taipei");
	header("Content-Type:text/html; charset=utf-8");
	set_time_limit(0);

        $data_json = file_get_contents(dirname(__FILE__)."/json/Adidas.json");
	$data_array = json_decode($data_json, true);
	foreach($data_array as $key => $value){
		echo "<div style='width:300px;height:500px;margin:10px;float:left;'>";
		//echo json_encode($value);
		echo "<table width='100%' height='100%' border='1'>";
		echo "<tr><td colspan='4' align='center'>".$value['cpdt_name']."</td></tr>";
		echo "<tr><td colspan='4' align='center'><img style='width:280px;' src='".$value['picpath']."'/></td></tr>";
		echo "<tr>";
		$i = 0;
		foreach($value['size'] as $size_value){
			echo "<td align='center'>".$size_value."</td>";
			$i++;
			if($i%4 == 0){
				echo "</tr><tr>";
			}
		}
		echo "</tr></table>";
		echo "</div>";
	}
	//echo $data_json;
?>

