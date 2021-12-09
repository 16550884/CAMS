
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';

?>

<?php
$cur_dte=date("Y-m-d");

		if(isset($_GET['batch'])){
			$r1=$_GET['batch'];
			
			if($r1==null){
				header("location:dashboard.php");
			}
			else{
				$sql1="SELECT * FROM batch_master WHERE batch_mas_key='$r1' AND status=0";
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

$message1="";

$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
}

$target_dir = "studentphotosupload/";

	if(isset($_POST['btn_addstuinfo'])){
		
		$n1=$_POST['txt_fullnme'];
		$n2=$_POST['txt_initialnme'];
		$n3=$_POST['txt_nicno'];
		$n4=$_POST['txt_dteofbirth'];
		$n5=$_POST['txt_address'];
		$n6=$_POST['txt_indexno'];
		$n7=$_POST['txt_niclet'];
		$n8=$_POST['txt_contactno'];
		$n9=$_POST['txt_contactno1'];
		$n10=$_POST['txt_emailaddress'];
		
		$nic=$n3."".$n7;
		
		if($n1=="" || $n2=="" ||  $n3=="" || $n4=="" || $n5=="" || $n6=="" || $n7=="" ){
			$message1="Please Enter the All Field";

		}	
		else if(!preg_match('/^[a-zA-Z- ]*$/', $n1)){
			$message1="Full name entry is allowed only for text and white space";
		}
				
		else if(!preg_match('/^[0-9]{10}+$/', $n8)){
			$message1="Invalid Mobile No";
		}
		else if(!preg_match('/^[0-9]{10}+$/', $n9)){
			$message1="Invalid Guardian Mobile No";
		}
		
		else if($n7=='X' && !preg_match('/^[0-9]{9}+$/', $n3)){
			
			$message1="Invalid National Identitiy Card No";
		}
		else if($n7=='V' && !preg_match('/^[0-9]{9}+$/', $n3)){
			
			$message1="Invalid National Identitiy Card No";
		}
		else if($n7=='Other' && !preg_match('/^[0-9]{12}+$/', $n3)){
			
			$message1="Invalid National Identitiy Card NoInvalid ID No";
		}
		else{
			if($n7=='Other'){
				$n8=$n3;
			}
			else{
				$n8=$n3."".$n7;
							
			}
			
		$sql6="SELECT * FROM batch_master WHERE batch_mas_key='$r1' AND status=0";
		$result6 = mysqli_query($link,$sql6);
		while($row6=mysqli_fetch_array($result6)){
			$batchcode=$row6['batch_code'];
		}
		
		
		
		$sql15="SELECT * FROM student_master WHERE student_id='$n6' AND status=0";
		$result15 = mysqli_query($link,$sql15);
		if(mysqli_num_rows($result15)>0){
			echo "<script>
					alert('Duplicate Index No');
				</script>";
			
		}
		else{
		
				$sql10="SELECT * FROM student_master WHERE batch_key='$r1' AND nic_no='$n3' AND status=0";
				$result10 = mysqli_query($link,$sql10);
				if(mysqli_num_rows($result10)>0){
					echo "<script>
							alert('Duplicate NIC No');
						</script>";
					
				}
				else{
				
					$sql1="SELECT * FROM student_master WHERE batch_key='$r1' AND dob='$n4' AND nic_no='$nic' AND initial_nme='$n2' AND status=0";
					$result1 = mysqli_query($link,$sql1);
					if(mysqli_num_rows($result1)==0){
						
						$sql2 = "INSERT INTO student_master (status,student_key,batch_key,student_id,student_fullnme,initial_nme,dob,nic_no,address,contact_no,contact_no1,email_address,act_person) VALUES 
														    (0,NULL,'$r1','$n6','$n1','$n2','$n4','$nic','$n5','$n8','$n9','$n10','$ukey')";
						if(mysqli_query($link,$sql2)){
							
							$sql8="SELECT * FROM student_master WHERE batch_key='$r1' AND dob='$n4' AND nic_no='$nic' AND initial_nme='$n2' AND status=0";
							$result8 = mysqli_query($link,$sql8);
							while($row8=mysqli_fetch_array($result8)){
								$stuaf_key=$row8['student_key'];
							}
							
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
									$target_new = $target_dir ."stu_".$stuaf_key.".".$imageFileType;
									if (file_exists($target_new)) {
										$mrt1=  "Sorry, file already exists.";
									
									}
									else{
										if (move_uploaded_file($_FILES["upload_personalimg"]["tmp_name"], $target_new)) {
											
											$stuimg="stu_".$stuaf_key.".".$imageFileType;
												$sql3="UPDATE student_master SET student_img='$stuimg' WHERE student_key='$stuaf_key'";
												if(mysqli_query($link,$sql3)){
														$mrt1=  "Successfully Added Image.";											//documents_details table is not empty
												}
											
										}
									}
								}
							
							echo "<script>
									alert('Successfully Entered Student Information $mrt1');
									window.location.href='student_id.php?sid=$stuaf_key';
								</script>";
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
		}
		}
	}
	
	
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Registration</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
			<div class="row">
                <div class="col-md-6">
				
				</div>
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Student Registration</div>
							<div style="font-size:16px;font-weight:bold;"align="center">
							<?php
							$sql9="SELECT * FROM batch_master INNER JOIN course_master ON batch_master.course_key=course_master.course_key
										  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
										  WHERE batch_master.batch_mas_key='$r1'";
							$result9 = mysqli_query($link,$sql9);
							while($row9=mysqli_fetch_array($result9)){
							?>
								<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $row9['facalty_nme']." - ".$row9['course_nme']." - ".$row9['batch_code'];?></h2>
							
							<?php
							}
							?>
							</div>
						</div>
					</section>
				</div>
			</div>
			
				<?php
			if($message1!=null){
			?>
			<div class="row">
                <div class="col-md-6">
				
				</div>
				<div class="col-md-5">
				
					<section class="panel panel-transparent" style="background-color:red">
						<div class="panel-body panel-transparent" style="background-color:red">
							<div style="font-size:16px;font-weight:bold;"align="center"><?php echo $message1; ?></div>
							
						</div>
					</section>
				
				</div>
			</div>
			<?php
			}
			?>
		
			
			<div class="row">
                <div class="col-md-6">
				</div>
				
				
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f1" enctype="multipart/form-data">
									
									<div class="form-group">
										<label>Index No</label>
										<input type="text" class="form-control input-sm" name="txt_indexno" placeholder="Please Enter Index No" required >
									</div>
									
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control input-sm" name="txt_fullnme" placeholder="Please Enter Full Name" required >
									</div>
									<div class="row">	
									<div class="col-md-9">
									<div class="form-group">
										<label>Initial With Name</label>
										<input type="text" class="form-control input-sm" name="txt_initialnme" placeholder="Please Enter Initial With Name">
									</div>
									</div>
									<div class="col-md-3">
										<label>Date of Birth</label>
										<input type="date" class="form-control input-sm" name="txt_dteofbirth" required placeholder="Please Enter Date of Birth">
									</div>
									</div>
									<div class="row">	
									<div class="col-md-9">									
									<div class="form-group">
										<label>NIC No</label>
										<input type="text" class="form-control input-sm" name="txt_nicno" maxlength="12" placeholder="Please Enter NIC No">
									</div>
									</div>
									<div class="col-md-3">
									
									<div class="form-group">
										<label>NIC Letter</label>
										<select name="txt_niclet" class="form-control input-sm">
											<option value='' disabled selected hidden>Please Choose.............</option>
											<option value='V'>V</option>
											<option value='X'>X</option>
											<option value='Other'>Other</option>
										</select>
									</div>	
									</div>
									</div>
									
									<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control input-sm" name="txt_address" placeholder="Please Enter Address">
									</div>
									<div class="row">	
									<div class="col-md-6">	
									<div class="form-group">
										<label>Contact Number</label>
										<input type="text" class="form-control input-sm" name="txt_contactno" placeholder="Please Enter contact Number">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label>Guardian_Contact</label>
										<input type="text" class="form-control input-sm" name="txt_contactno1" placeholder="Please Enter Guardian Contact Number">
									</div>
									</div>
									</div>
									<div class="form-group">
										<label>E-mail Address</label>
										<input type="text" class="form-control input-sm" name="txt_emailaddress" placeholder="Please Enter E-mail Address">
									</div>
									<div class="form-group">
										<label>Upload Photos</label>
										<input type="file" class="form-control input-sm" name="upload_personalimg" required>
									</div>
									<button type="submit" name="btn_addstuinfo" class="btn btn-primary btn-lg btn-block">Student Register</button>
									
								</form>
						</div>
					</section>
				</div>
			</div>
	
		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1">
							
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<h4></h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="8%"><font color="red">&lowast;</font>Student ID</th>
										<th width="26%"><font color="red">&lowast;</font>Full Name</th>
										<th width="15%"><font color="red">&lowast;</font>Initial Name</th>
										<th width="30%"><font color="red">&lowast;</font>Address</th>
										<th width="8%"><font color="red">&lowast;</font>NIC No</th>
										<th width="8%"><font color="red">&lowast;</font>Date of Birth</th>
										<th width="5%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									
												<?php
													
													$sql14="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
																					  INNER JOIN course_master  ON batch_master.course_key=course_master.course_key
																					  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
																					  WHERE student_master.batch_key='$r1'
																					  AND student_master.status=0";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														echo "<tr>
																
																<td width='8%'>".$row14['student_id']."</td>
																<td width='26%'>".$row14['student_fullnme']."</td>
																<td width='15%'>".$row14['initial_nme']."</td>
																<td width='30%'>".$row14['address']."</td>
																<td width='8%'>".$row14['nic_no']."</td>
																<td width='8%'>".$row14['dob']."</td>
																<td width='5%'>
																	<a href='editstuinfo.php?std=".$row14['student_key']."'><button class='btn btn-sm btn-success'>Change</button></a>
																</td>
															</tr>";
													}
													
													
												?>
									
								</tbody>
							</table>
						</div>
					</section>
				</div>
			</div>
		</div>
		
		
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
			<script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
			<script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    </body>
</html>
