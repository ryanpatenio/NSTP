<?php

session_start();

require_once("../include/initialize.php");



if($_POST["action"] == "single_fetch")

	{

		$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',stud.GENDER,stud.BDAY,stud.ADDRESS,stud.CONTACT,s.`STATUS`,gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.MID_TERM2,gr.END_TERM2,gr.FINAL2 from students s,stud_details stud,grades gr where s.IDNO=stud.IDNO and s.IDNO = gr.IDNO and s.STUD_ID = '".$_POST['student_id']."'");

		
		
		$cur = $mydb->executeQuery();

		if($cur)
		{
			// $result = mysqli_fetch_array($statement);
			$output = '
			<div class="row">
			';
			while($row = mysqli_fetch_array($cur))
			{
				if($row['STATUS']=='ongoing'){
					$stats = 'On Process';
					$color = 'green';
				}else if($row['STATUS']=='INC'){
					$stats = 'INC';
					$color = 'red';
				}else if($row['STATUS']=='DROP'){
					$stats = 'DROP';
					$color = 'red';
				}else if($row['STATUS']=='DONE'){
					$stats = 'PASSED';
					$color = 'green';
				}
				$output .= '
				<div class="col-md-3">
					<img src="../images/default2.jpeg" class="img-thumbnail" />
				</div>
				<div class="col-md-9">
					<table class="table">
						<tr>
							<th>Name:</th>
							<td>'.$row["name"].'</td>
						</tr>
						<tr>
							<th>GENDER: </th>
							<td><strong style="color:green;">'.$row["GENDER"].'</strong></td>
						</tr>
						<tr>
							<th>BIRTHDAY: </th>
							<td>'.date("d M Y",strtotime($row["BDAY"])).'</td>
						</tr>
						<tr>
							<th>ADDRESS: </th>
							<td>'.$row["ADDRESS"].'</td>
						</tr>
						<tr>
							<th>CONTACT: </th>
							<td>'.$row["CONTACT"].'</td>
						</tr>

						<tr>
							<th>STATUS: </th>
							<td style="color:'.$color.'">'.$stats.'</td>

						</tr>
						<tr >
							
							<th style = "color:red;">GRADES: </th>
							<td></td>
							
						</tr>
						<tr><th>FIRST SEM</th></tr>
						<tr>
							
							<td>MID TERM: '.$row["MID_TERM"].'</td>

							<td>END TERM:  '.$row["END_TERM"].'</td>
							<td>FINAL: '.$row["FINAL"].'</td>
						</tr>
						
						<tr><th>SECOND SEM</th>
						<td></td>
						</tr>

						<tr>
							
							<td>MID TERM: '.$row["MID_TERM2"].'</td>

							<td>END TERM:  '.$row["END_TERM2"].'</td>
							<td>FINAL: '.$row["FINAL2"].'</td>
						</tr>
							
						
					</table>
				</div>
				';

				
			}

				

		

			$output .= '</div>';
			echo $output;
		}
	}






 ?>