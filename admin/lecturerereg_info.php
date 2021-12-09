
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';
error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
?>

<?php
$cur_dte=date("Y-m-d");

$message1="";

	if(isset($_POST['btn_addlecinfo'])){
		
		$n1=$_POST['txt_fullnme'];
		$n2=$_POST['txt_initialnme'];
		$n3=$_POST['txt_nicno'];
		$n4=$_POST['txt_contactno'];
		$n5=$_POST['txt_email'];
		$n6=$_POST['txt_usernme'];
		//$n7=$_POST['sele_nicletter'];
		
		
		
		//$nic=$n3."".$n7;
		if($n1=="" || $n2=="" ||  $n3=="" || $n4=="" || $n5=="" || $n6=="" ){
			$message1="Please Enter the All Field";

		}
		else if(!preg_match('/^[a-zA-Z- ]*$/', $n1)){
			$message1="Full name entry is allowed only for text and white space";
		}
		else if(!preg_match('/^[0-9]{10}+$/', $n4)){
			$message1="Invalid Mobile No";
		}
		else if(!preg_match('/^[0-9]{12}+$/', $n3)){
			
			$message1="Invalid National Identitiy Card No";
		}
		
		else if(!preg_match('/^[0-9]{9}+$/', $n3){
			
		//	$message1="Invalid National Identitiy Card No";
		}
				
		else{
			//if(){
			//	$n8=$n3;
			}
			else{
			//	$n8=$n3."".$n7;
							
			}
			
			$sql1="SELECT * FROM lecture_master WHERE nic_no='$n8' AND status=0";
			$result1 = mysqli_query($link,$sql1);
			if(mysqli_num_rows($result1)==0){
				
				$sql4="SELECT * FROM user_master WHERE user_nme='$n6' AND status=0";
				$result4 = mysqli_query($link,$sql4);
				if(mysqli_num_rows($result4)==0){
						
						
						
						$sql2 = "INSERT INTO lecture_master (status,lecturemas_key,lecture_fullnme,lecture_nme,contact_no,nic_no,email_address,act_person) VALUES 
														(0,NULL,'$n1','$n2','$n4','$n8','$n5','$ukey')";
						if(mysqli_query($link,$sql2)){
							
							$sql12="SELECT * FROM lecture_master WHERE lecture_fullnme='$n1' AND lecture_nme='$n2' AND contact_no='$n4' AND status=0";
							$result12 = mysqli_query($link,$sql12);
							while($row12=mysqli_fetch_array($result12)){
								$lecos_key=$row12['lecturemas_key'];
							}
							
							$sql3="INSERT INTO user_master (status,user_key,user_fullnme,user_nme,email,password,user_level,lec_key,sys_regdte) VALUES
															(0,NULL,'$n1','$n6','$n5','8af95fe2ab1a54b488ef8efb3f3b0797','lec','$lecos_key','$cur_dte')";
							mysqli_query($link,$sql3);
							
							
							$to=$n5;
							$subject='Classroom Managment System - User Registration';				//subject eka danna
							$msg="Dear  ".$n2." \r\n"
									."Your Defualt Password is 9900. This password is Change your first login \r\n"
									."Thank You \r\n"
									."Classroom Managment System \r\n";	
							$headers  = 'From: nilmini2043@gmail.com' . "\r\n" .
										'MIME-Version: 1.0' . "\r\n" .
										'Content-type: text/html; charset=utf-8';
							$mails=mail($to,$subject,$msg,$headers);
							if($mails){
								echo "<script>
									alert('Successfully Entered Lecturer Information and Email Sent');
									window.location.href='lecturerereg_info.php';
								</script>";
							}
							else{
									echo "<script>
									alert('Successfully Entered Lecturer Information and Email Not Sent');
									window.location.href='lecturerereg_info.php';
								</script>";
							}
				
						}
						else{
							
								$message1="Execute Error";
						}
				}
				else{
					$message1="Sorry, Duplicate User Name. Try Again";
				}
				
			}
			else{
				
				$message1="Already Added this Lecturer Information";
			}
		}
	}
		
			
			$sql6="SELECT * FROM lecture_master WHERE status=0";
			$result6 = mysqli_query($link,$sql6);
			while($row6=mysqli_fetch_array($result6)){
					
					$e1="txt_leckey".$row6['lecturemas_key'];
					$e2="txt_leccontact".$row6['lecturemas_key'];
					$e3="txt_lecmail".$row6['lecturemas_key'];
					$e4="txt_unsys".$row6['lecturemas_key'];
				
					
					$btn_update1="btn_change".$row6['lecturemas_key'];
					$btn_remove1="btn_remove".$row6['lecturemas_key'];
					
				if(isset($_POST[$btn_update1])){	
					$t1=$_POST[$e1];
					$t2=$_POST[$e2];
					$t3=$_POST[$e3];
					$t4=$_POST[$e4];
				
							
					$sql7="UPDATE lecture_master SET contact_no='$t2',email_address='$t3' WHERE lecturemas_key='$t1'";
					if(mysqli_query($link,$sql7)){
							$sql8="SELECT * FROM user_master WHERE user_nme='$t4' AND status=0";
							$result8 = mysqli_query($link,$sql8);
							if(mysqli_num_rows($result8)==0){
								
								$sql9="UPDATE user_master SET user_nme='$t4' WHERE lec_key='$t1'";
								mysqli_query($link,$sql9);
								
								echo "<script>
									alert('Successfully Change Lecturer Information');
								</script>";
							}
							else{
								echo "<script>
									alert('Duplicate User Name. Try Againn');
								</script>";
							}			
					}
					else{
							echo "<script>
									alert('Execute Error');
								</script>";
					}
					
				}
				
				if(isset($_POST[$btn_remove1])){
						$t1=$_POST[$e1];
						
						echo "<script>
						if (window.confirm('Are you sure you want to delete this item?')) { 
							window.location.href='lecturerereg_info.php?sd=$t1';
						}
						</script>";
						
						
				}
				
				if(isset($_GET['sd'])){
						$sql10="UPDATE lecture_master SET status=1 WHERE lecturemas_key='$_GET[sd]' AND status=0";
						if(mysqli_query($link,$sql10)){
							
							$sql11="UPDATE user_master SET status=1 WHERE lec_key='$_GET[sd]' AND status=0";
							mysqli_query($link,$sql11);
							echo "<script>
									alert('Successfully Deleted Lecturer Information');
										window.location.href='lecturerereg_info.php';
								</script>";
						}
						else{
							echo "<script>
									alert('Execute Error');
								</script>";
						}
				}			
			
			}
		
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Lecturer Registration</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Lecturer Registration</div>
							
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
							<form role="form" method="post" name="f1">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control input-sm" name="txt_fullnme" placeholder="Please Enter Full Name" required >
									</div>
									
									<div class="form-group">
										<label>Initial With Name</label>
										<input type="text" class="form-control input-sm" name="txt_initialnme" placeholder="Please Enter Initial With Name" required>
									</div>
									
									<div class="form-group">
										<label>System User Name</label>
										<input type="text" class="form-control input-sm" name="txt_usernme" placeholder="Please Enter System User Name" required>
									</div>
									
									<div class="form-group">
										<label>NIC No</label>
										
										<div class="row">
											<div class="col-md-8">
												<input type="text" class="form-control input-sm" name="txt_nicno" maxlength="12" placeholder="Please Enter NIC No" required>
											</div>
											<div class="col-md-4">

												<!--<select class="form-control input-sm" name="sele_nicletter" required>
													<option value='' disabled selected hidden>Please Choose.............</option>
													<option value='X'>X</option>
													<option value='V'>V</option>
													<option value='Other'>Other</option>
												</select>
											
											</div> -->
										</div>
									</div>
									
									<div class="form-group">
										<label>Contact No</label>
										<input type="text" class="form-control input-sm" name="txt_contactno" maxlength="10" placeholder="Please Enter Contact No" maxlength="10">
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<input type="email" class="form-control input-sm" name="txt_email" placeholder="Please Enter Email Address">
									</div>
									
									<button type="submit" name="btn_addlecinfo" class="btn btn-primary btn-lg btn-block">Lecturer Registration</button>
									
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
					<section class="panel panel-transparent" >
						<div class="panel-body panel-transparent">
							<form method="post" name="f2">
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="20%"><font color="red">&lowast;</font>Full Name</th>
										<th width="15%"><font color="red">&lowast;</font>Initial Name</th>
										<th width="10%"><font color="red">&lowast;</font>NIC No</th>
										<th width="10%"><font color="red">&lowast;</font>System User Name</th>
										<th width="10%"><font color="red">&lowast;</font>Contact No</th>
										<th width="16%"><font color="red">&lowast;</font>Email Address</th>
										<th width="19%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									
												<?php
													
													$sql14="SELECT * FROM lecture_master WHERE status=0";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_leckey="txt_leckey".$row14['lecturemas_key'];
														$txt_leccontact="txt_leccontact".$row14['lecturemas_key'];
														$txt_lecmail="txt_lecmail".$row14['lecturemas_key'];
														$txt_unsys="txt_unsys".$row14['lecturemas_key'];
														
														$btn_remove="btn_remove".$row14['lecturemas_key'];
														$btn_change="btn_change".$row14['lecturemas_key'];
														
														$sql5="SELECT * FROM user_master WHERE lec_key='$row14[lecturemas_key]'";
														$result5 = mysqli_query($link,$sql5);
														while($row5=mysqli_fetch_array($result5)){
															 	$usernamesys=$row5['user_nme'];
														}
														
														echo "<tr>
																
																<td width='20%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_leckey." value=".$row14['lecturemas_key'].">
																".$row14['lecture_fullnme']."</td>
																<td width='15%'>".$row14['lecture_nme']."</td>
																<td width='10%'>".$row14['nic_no']."</td>
																<td width='10%'><input type='text' name=".$txt_unsys." class='form-control input-sm' value=".$usernamesys."></td>
																<td width='12%'><input type='text' name=".$txt_leccontact." class='form-control input-sm' value=".$row14['contact_no']."></td>
																<td width='18%'><input type='text' name=".$txt_lecmail." class='form-control input-sm' value=".$row14['email_address']."></td>
																<td width='15%'>
																	<input type='submit' class='btn btn-sm btn-success'  value='Change' name=".$btn_change.">
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_remove."><br>
																</td>
															</tr>";
													}
													
													//<input type='submit' class='btn btn-sm' style='background-color:#ooooo'  value='Change' name=".$btn_change.">
												?>
									
								</tbody>
							</table>
							</form>
						</div>
					</section>
				</div>
			</div>
		</div>
		
		
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
		
		
    </body>
</html>
