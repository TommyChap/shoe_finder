<?php
	// Global Setting
	date_default_timezone_set("Asia/Taipei");
	header("Content-Type:text/html; charset=utf-8");
	set_time_limit(0);

        $data_json = file_get_contents(dirname(__FILE__)."/../json/Adidas.json");
	$data_array = json_decode($data_json, true);
	$j = 0;
	foreach($data_array as $key => $value){
		$j++;
		echo "<div id='shoe_div_".$j."' style='width:300px;height:550px;margin:10px;float:left;'>";
		//echo json_encode($value);
		echo "<table width='100%' height='100%' border='1'>";
		echo "<tr><td colspan='4' align='center' height='25px'><input type='checkbox' id='shoe_checkbox_".$j."' checked onclick=\"function go(){document.getElementById('shoe_div_".$j."').style.display='none';} go(); return false;\"></td></tr>";
		echo "<tr><td colspan='4' align='center' height='30px'>".$value['cpdt_name']."</td></tr>";
		echo "<tr><td colspan='4' align='center' height='300px'><img style='width:280px;height:280px;' src='".$value['picpath']."'/></td></tr>";
		echo "<tr>";
		$i = 0;
		foreach($value['size'] as $size_value){
			echo "<td align='center' height='28px'>".$size_value."</td>";
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

