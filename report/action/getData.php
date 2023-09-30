<?php
session_start();
require('../../include/initialize.php');


if(isset($_POST['live_table'])){

	if(!empty($_POST['live_table'])){
		if(!empty($_POST['sm'])){


		$sy = $_POST['live_table'];
		$sem = $_POST['sm'];


		$data = getStudent($sy,$sem);

		foreach ($data as $res) {
			# code...

			echo '<tr>';

				echo '<td>'.$res['IDNO'].'</td>';
				echo '<td>'.$res['name'].'</td>';
				echo '<td>'.$res['SCHOOL_YEAR'].'</td>';
				echo '<td>'.$res['SEMESTER'].'</td>';

				echo '<td>

				<a href="view.php?IDNO='.$res['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


				</td>';


			echo '</tr>';


		}

	


		}else{
			//empty semester
			echo 'empty semester';
		}
	}else{
		//empty year
		echo 'empty year';
	}
// echo 'wala';

}

if(isset($_POST['fetching'])){

	if(!empty($_POST['fetching'])){

		if(!empty($_POST['sm2'])){


			$yr2 = $_POST['fetching'];
			$sm2 = $_POST['sm2'];

			$data2 = getStudent($yr2,$sm2);

		foreach ($data2 as $row) {
			# code...

			echo '<tr>';

				echo '<td>'.$row['IDNO'].'</td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['SCHOOL_YEAR'].'</td>';
				echo '<td>'.$row['SEMESTER'].'</td>';

				echo '<td>

				<a href="view.php?IDNO='.$row['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


				</td>';


			echo '</tr>';


		}

		}
	}


}



//for event listener of school year
if(isset($_POST['fetching2'])){

	if(!empty($_POST['fetching2'])){

		if(!empty($_POST['sm3'])){


			$yr3 = $_POST['fetching2'];
			$sm3 = $_POST['sm3'];

			$data3 = getStudent($yr3,$sm3);

		foreach ($data3 as $row2) {
			# code...

			echo '<tr>';

				echo '<td>'.$row2['IDNO'].'</td>';
				echo '<td>'.$row2['name'].'</td>';
				echo '<td>'.$row2['SCHOOL_YEAR'].'</td>';
				echo '<td>'.$row2['SEMESTER'].'</td>';

				echo '<td>

				<a href="view.php?IDNO='.$row2['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


				</td>';


			echo '</tr>';


		}

		}
	}


}




function getStudent($year,$sem){
	global $mydb;
	$mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,acad_year ac,students s where en.ACAD_ID = ac.ACAD_ID and en.IDNO = s.IDNO and ac.SCHOOL_YEAR = '".$year."' and ac.SEMESTER = '".$sem."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

 ?>