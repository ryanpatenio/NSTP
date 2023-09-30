<?php


require("../include/initialize.php");

if(isset($_POST['nstp_id'])){



$mydb->setQuery("select s.SECT_ID, nst.NSTP_PROGRAM,s.SEC_NAME,s.YR_SECTION  from sections s,nstp_prog nst where s.NSTP_ID= nst.NSTP_ID and nst.NSTP_ID ='".$_POST['nstp_id']."'");

$cur = $mydb->executeQuery();


while($row = mysqli_fetch_array($cur)){?>

<option value="<?php echo $row['SECT_ID'] ?>"><?php  echo $row['SEC_NAME'].' '.$row['YR_SECTION']; ?></option>


<?php }


}


//this code is for getting fetch data from the database then display it in the edit modal form
if(isset($_POST['STUD_ID'])){
	$STUD_ID = $_POST['STUD_ID'];

	 $rotcData = new adminRotc();
    $res = $rotcData->displaySelStudent($STUD_ID);

    if($res){
    	echo json_encode($res);
    }else{
    	echo json_encode('Null');
    }
}

//this code is for updating students






 ?>