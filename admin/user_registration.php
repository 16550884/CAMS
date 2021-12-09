<?php
//error_reporting(0);
include 'conn.php';	
include 'sessionhandaler.php';	
?>

<?php
$cur_dte=date("Y-m-d");
$message="";

	if(isset($_POST['btn_add'])) {
	  
		$nm1 = $_POST['txt_empname'];
		$nm2 = $_POST['txt_username'];
		$nm3 = $_POST['txt_email'];
		
	   
	  
		if($nm1=="" || $nm2=="" || $nm3==""){
			  $message = "Please Enter the relevant data.";
		} 
		//else if(!filter_var(FILTER_VALIDATE_EMAIL ,$nm3)){
		//	  $message = "Invalid email format";
		//}
		else{
			
	  
			$sql1="SELECT * FROM user_master WHERE user_nme='$nm2'";
			$result=mysqli_query($link,$sql1);
			if(mysqli_num_rows($result)==0){
			  
				$pw=MD5(9900);
				$sql4 = "INSERT INTO user_master(status,user_key,user_fullnme,user_nme,email,password,user_level,sys_regdte)
										VALUES (0,NULL,'$nm1','$nm2','$nm3','$pw','admin','$cur_dte')";
				if(mysqli_query($link,$sql4)){
					$to=$nm3;
					$subject='Classroom Managment System - User Registration';				//subject eka danna
					$headers  = 'From: nilmini2043@gmail.com' . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
					'Content-type: text/html; charset=utf-8';
					$msg="Dear  ".$nm1." here is your defualt password .\r\n"
							."Your Defualt Password is 9900. This password is Change your first login. This is an auto generated message. Do not reply to this email \r\n"
							."Thank You \r\n"
							."Classroom Managment System \r\n"
							."Technical Collage, Matara \r\n";	
					$mails=mail($to,$subject,$msg,$headers);
					if($mails){
						$message = "User Registration Successfully, -   Sent E-mail";
					}
					else{
						$message = "User Registration Successfully, -    Not Sent email ";
					}
					
				}
				else{
					$message = "Execute Error";
				}
			}	
			else{
					 $message = "This employer name is already used";
			}
		
		}
	}
	//$sql7="SELECT * FROM user_master WHERE status=0 and user_level='super_admin'";
		//$result7 = mysqli_query($link,$sql7);
		//if(
		$sql6="SELECT * FROM user_master WHERE status=0";
				$result6 = mysqli_query($link,$sql6);
				while($row6=mysqli_fetch_array($result6)){
						
						$e1="txt_userkey".$row6['user_key'];
						$e2="txt_leccontact".$row6['user_key'];
										
						
						$btn_remove1="btn_remove".$row6['user_key'];
								
					if(isset($_POST[$btn_remove1])){
							$t1=$_POST[$e1];
							
							echo "<script>
							if (window.confirm('Are you sure you want to delete this item?')) { 
								window.location.href='user_registration.php?sd=$t1';
							}
							</script>";
							
							
					}
					
					if(isset($_GET['sd'])){
							$sql10="UPDATE user_master SET status=1 WHERE user_key='$_GET[sd]' AND status=0";
							if(mysqli_query($link,$sql10)){
								
								$sql11="UPDATE user_master SET status=1 WHERE user_key='$_GET[sd]' AND status=0";
								mysqli_query($link,$sql11);
								echo "<script>
										alert('Successfully Deleted user Information');
											window.location.href='user_registration.php';
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
<body  class="bc" style="background-image: url('images/a2.jpg')">
        <!-- small navbar -->
        <?php include('navi.php') ?>

		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="row">
				<div class="col-lg-6">
				
				</div>
				<div class="col-lg-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Administrator Registration</div>
						</div>
					</section>
				</div>
			</div>
       
    	<div class="row">

            <div class="col-lg-10s">
            <div class="col-lg-6">
	
            </div>
            
                
			<div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-10">
							<?php
							if($message!==""){
								if($message=="User Registration Successfully"){
							?>
								<div class="alert alert-info">
								  <a class="close" data-dismiss="alert" href="#">&times;</a>
								  <strong><?php echo $message; ?></strong>
								</div>
							<?php
								}
								else{
							?>
								<div class="alert alert-danger">
									<a class="close" data-dismiss="alert" href="#">&times;</a>
								   <strong><?php echo $message; ?></strong>
								</div>
							<?php
								}
							}
							?>
                      <section class="panel panel-transparent">
                          
                          <div class="panel-body panel-transparent">
                              <form role="form" method="post">
									
									
									
									<div class="form-group">
                                        <label>Employee Name</label>
                                      <input type="text" class="form-control input-sm" name="txt_empname" placeholder="Please Enter Employee Name">
									</div>
									<div class="form-group">
                                        <label>E-mail Address</label>												
										<input type="email" class="form-control input-sm" name="txt_email" placeholder="Please Enter correct Email Address">

									</div>

									<div class="form-group">
                                        <label>User Name</label>
										<input type="text" class="form-control input-sm" name="txt_username"  placeholder="Please Enter User Name it should be simple enough to remember but hard to guess." required>
									</div>
 								  
                                  <button type="submit" name="btn_add" id="btn_add" class="btn btn-primary btn-lg text-center" >Add New Admin</button>
                              </form>

                          </div>
                      </section>

                  </div>
				</div>
			</div>


		</div>
		
		<?php
		if($ukey==1){
		?>
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
										<th width="50%"><font color="red">&lowast;</font>Full Name</th>
										<th width="30%"><font color="red">&lowast;</font>User Level</th>
										<th width="20%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
													
													$sql14="SELECT * FROM user_master WHERE  NOT user_key=1 AND status=0 AND user_level='admin'";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_userkey="txt_userkey".$row14['user_key'];
														$txt_userlevel="txt_userlevel".$row14['user_key'];
																												
														$btn_remove="btn_remove".$row14['user_key'];
														
														
														$sql5="SELECT * FROM user_master WHERE user_key='$row14[user_key]'";
														$result5 = mysqli_query($link,$sql5);
														while($row5=mysqli_fetch_array($result5)){
															 	$usernamesys=$row5['user_nme'];
														}
														
														echo "<tr>
																
																<td width='50%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_userkey." value=".$row14['user_key'].">
																".$row14['user_fullnme']."</td>
																<td width='30%'>".$row14['user_level']."</td>
																
																<td width='20%'>
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
		<?php
		}
		?>
   
	
	
<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
</body>
<?php
mysqli_close($link);
?>
</html>
