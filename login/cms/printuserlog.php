<?php 
	include('../config.php');
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=document_name.doc");

		$output = '<html>';
		$output .="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		$output .= "<head><style>
					*{font-family: Arial,sans-serif;text-align:center;	}
					body{background-color:#fff;	}
					h2{text-align:center;text-transform:uppercase;	}
					.tim{text-transform:uppercase;}
					 th, td {border-collapse: collapse;}
					table{width:100%;border-radius: 10px;box-shadow: 0px 5px 10px rgba(0,0,0,0.2);text-align:center;position:relative;left:50%;transform:translateX(-50%);margin-bottom:20px;border-collapse: collapse;}
					th{background-color: #941046;color: #fff;text-transform: uppercase;padding: 12px;	}
					td{border-top: 1px solid black;padding: 5px;	}
					</style>
				</head>";
		$output .= "<body>";				
		$output .= "<h2>User Log</h2>";
		$output.='<table>
						  <tr>
							<th>User</th>
							<th>Action</th>
							<th>Date</th>					
					</tr>';
		/* Finished tasks in this week */
		$sql = "SELECT * from userlog order by id desc"; 
		$logs = array();
		$result = mysqli_query ($con,$sql); 

		while($row = mysqli_fetch_array($result)){
			$logs[] = $row;
		}
		foreach($logs as $log){
			$output.='
					  <tr>
						<td>'.$log['user'].'</td>
						<td>'.$log['action'].'</td>
						<td>'.$log['date'].'</td>
				</tr>';
		}
		if ($result->num_rows > 0){
			$output.='</table>';
		}
		$output .= "<hr>";
			
		$output .= "</body>";
		$output .= '</html>';	
		
		
		$file_name = 'userlog.doc';
		
		$destination_path = basename($file_name);
		$fp = fopen($destination_path,"wb");
		fwrite($fp,$output);
		fclose($fp);
		$vrati = array("state"=> 'true', "path" => $destination_path, "name" => $file_name );		
		echo json_encode($vrati);
		
		?>