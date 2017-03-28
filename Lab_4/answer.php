<?php
	$i = 0;
	$data = array();
	$file = fopen("data.txt", 'r');
	if ($file)
		while (!feof($file)) {
			$text = fgets($file);
			$data[$i] = $text;
			$i += 1;
		}        

	function CheckRequest() {
		global $data;
		$search = $_POST['value'];		
		$Result = $data;
		foreach ($Result as $var) {
			$p = split(";", $var);	

			if ($search == $p[1]) {
				$Result["Data"] = $p;		
				$Result["Check"] = true;
			}			
		}		
			
		echo json_encode($Result);	
	}
	
	if(isset($_POST['value']))
		CheckRequest();
	else
		echo json_encode($data);
?>