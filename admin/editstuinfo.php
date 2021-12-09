
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';

?>

<?php
$cur_dte=date("Y-m-d");

		if(isset($_GET['std'])){
			$r1=$_GET['std'];
			
			if($r1==null){
				header("location:dashboard.php");
			}
			else{
				$sql1="SELECT * FROM student_master WHERE student_key='$r1' AND status=0";
				$result1 = mysqli_query($link,$sql1);
				if(mysqli_num_rows($result1)==0){
					header("location:dashboard.php");
				}
				else{
					$status=1;
				}
			}
		}
		else{
			header("location:dashboard.php");
		}
?>

<?php
$cur_dte=date("Y-m-d");

		$sql4="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
										  INNER JOIN course_master  ON batch_master.course_key=course_master.course_key
										  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
										  WHERE student_master.student_key='$r1'";
		$result4 = mysqli_query($link,$sql4);
		while($row4=mysqli_fetch_array($result4)){
			$s1=$row4['batch_key'];
		}
	
	$target_dir = "studentphotosupload/";

	if(isset($_POST['btn_editstuinfo'])){
		
		$n1=$_POST['txt_nicno'];
		$n2=$_POST['txt_dteofbirth'];
		$n3=$_POST['txt_address'];
		
		$sql1="SELECT * FROM student_master WHERE batch_key='$s1' AND dob='$n2' AND nic_no='$n3' AND status=0";
		$result1 = mysqli_query($link,$sql1);
		if(mysqli_num_rows($result1)==0){
			
			$sql2 = "UPDATE student_master SET dob='$n2',nic_no='$n1',address='$n3' WHERE student_key='$r1'";
			if(mysqli_query($link,$sql2)){
				
				$sql5="SELECT * FROM student_master WHERE student_key='$r1' AND student_img IS NOT NULL";
				$result5 = mysqli_query($link,$sql5);
				if(mysqli_num_rows($result5)>0){
					echo "<script>
						alert('Successfully Entered Student Information.s');
						window.location.href='student_id.php?sid=$r1';
					</script>";
				}
				else{
					$target_file = $target_dir . basename($_FILES["upload_personalimg"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$check = getimagesize($_FILES["upload_personalimg"]["tmp_name"]);
					// Check file size
					if ($_FILES["upload_personalimg"]["size"] > 5000000) {
						
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg"
					&& $imageFileType !== "gif") {
						
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
							$mrt1= "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
					} else {
						$target_new = $target_dir ."stu_".$r1.".".$imageFileType;
						if (file_exists($target_new)) {
							$mrt1=  "Sorry, file already exists.";
						
						}
						else{
							if (move_uploaded_file($_FILES["upload_personalimg"]["tmp_name"], $target_new)) {
								
								$stuimg="stu_".$r1.".".$imageFileType;
									$sql3="UPDATE student_master SET student_img='$stuimg' WHERE student_key='$r1'";
									if(mysqli_query($link,$sql3)){
											$mrt1=  "Successfully Added Image.";											//documents_details table is not empty
									}
								
							}
						}
					}
				
					echo "<script>
						alert('Successfully Entered Student Information $mrt1');
						window.location.href='student_id.php?sid=$r1';
					</script>";
				}
			}
			else{
				echo "<script>
						alert('Execute Error');
					</script>";
			}
			
		}
		else{
			echo "<script>
				alert('Already Added this Student Information');
			</script>";
		}
	}
	
	if(isset($_POST['btn_delstuinfo'])){
		
		$sql7 = "UPDATE student_master SET status=1 WHERE student_key='$r1'";
		if(mysqli_query($link,$sql7)){
			echo "<script>
						alert('Successfully Entered Student Information');
						window.location.href='student_reg.php?batch=$s1';
				</script>";
		}
	}
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Edit Information</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
	  
		<style>
		.srf{
			font-weight:bold;
			font-size:15px;
		}
		</style>
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
	   
	<?php
	if(isset($_GET['std'])){
		
		$sql1="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
										  INNER JOIN course_master  ON batch_master.course_key=course_master.course_key
										  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
										  WHERE student_master.student_key='$r1'";
		$result1 = mysqli_query($link,$sql1);
		while($row1=mysqli_fetch_array($result1)){
			$y1=$row1['student_id'];
			$y2=$row1['student_fullnme'];
			$y3=$row1['initial_nme'];
			$y4=$row1['dob'];
			$y5=$row1['nic_no'];
			$y6=$row1['address'];
			$y7=$row1['student_img'];
			$y8=$row1['course_nme'];
			$y9=$row1['facalty_nme'];
			$y10=$row1['batch_code'];
		}
	?>
			
			<div class="row">
                <div class="col-md-2">
				
				</div>
				<div class="col-md-8">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f1" enctype="multipart/form-data">
									
									<table border="0" width="100%">
										<tr>
											<td rowspan="6" width="20%"><img src="studentphotosupload/<?php echo $y7; ?>" width="100%" height="120px"></td>
											<td width="2%" ></td>
											<td width="15%" class="srf">Student ID </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y1; ?></td>
										</tr>
										<tr>
											<td width="2%" ></td>
											<td width="15%" class="srf">Facalty Name </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y9; ?></td>
										</tr>
										<tr>
											<td width="2%"></td>
											<td width="15%" class="srf">Course Name </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y8; ?></td>
										</tr>
										<tr>
											<td width="2%"></td>
											<td width="15%" class="srf">Batch </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y10; ?></td>
										</tr>
										<tr>
											<td width="2%"></td>
											<td width="15%" class="srf">Full Name </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y2; ?></td>
										</tr>
										<tr>
											<td width="2%"></td>
											<td width="15%" class="srf">Initial Name </td>
											<td width="5%" class="srf">:</td>
											<td width="58%" class="srf"><?php echo $y3; ?></td>
										</tr>
									</table>
									<div class="form-group">
										<label>NIC No</label>
										<input type="text" class="form-control input-sm" name="txt_nicno" placeholder="Please Enter NIC No" value="<?php echo $y5;?>">
									</div>
									<div class="form-group">
										<label>Date of Birth</label>
										<input type="text" class="form-control input-sm txtDate" name="txt_dteofbirth" placeholder="Please Enter Date of Birth" value="<?php echo $y4;?>">
									</div>
									<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control input-sm" name="txt_address" placeholder="Please Enter Address" value="<?php echo $y6;?>">
									</div>
									
									<?php
									$sql6="SELECT * FROM student_master WHERE student_key='$r1' AND student_img IS NOT NULL";
									$result6 = mysqli_query($link,$sql6);
									if(mysqli_num_rows($result6)==0){
									?>
										<div class="form-group">
											<label>Upload Photos</label>
											<input type="file" class="form-control input-sm" name="upload_personalimg" required>
										</div>
									<?php
									}
									?>
									
									<button type="submit" name="btn_editstuinfo" class="btn btn-primary btn-lg btn-block">Edit Student Info</button>
								</form>
									<br>
								<form role="form" method="post" name="f2">
									<button type="submit" name="btn_delstuinfo" class="btn btn-danger btn-lg btn-block">Delete Student Info</button>
								</form>
								
						</div>
					</section>
				</div>
			</div>
			
	<?php
	}
	?>
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
		
		
    </body>
</html>
