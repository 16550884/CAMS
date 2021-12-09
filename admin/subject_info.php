
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';

?>

<?php
$cur_dte=date("Y-m-d");

		if(isset($_GET['cs']) && isset($_GET['yr'])){
			
		}
		else{
			header("location:dashboard.php");
		}
?>

<?php
$cur_dte=date("Y-m-d");


	if(isset($_POST['btn_addsubinfo'])){
		
		$n1=$_POST['txt_subjectnme'];

		$sql1="SELECT * FROM subject_master WHERE course_key='$_GET[cs]' AND year_key='$_GET[yr]' AND subject_name='$n1' AND status=0";
		$result1 = mysqli_query($link,$sql1);
		if(mysqli_num_rows($result1)==0){
			
			$sql2 = "INSERT INTO subject_master (status,subject_key,course_key,year_key,subject_name,act_person) VALUES 
											(0,NULL,'$_GET[cs]','$_GET[yr]','$n1','$ukey')";
			if(mysqli_query($link,$sql2)){
				
					
				
				echo "<script>
						alert('Successfully Entered Subject');
						window.location.href='subject_info.php?cs=$_GET[cs]&yr=$_GET[yr]';
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
				alert('Already Added this Subject');
			</script>";
		}
	}
	
	$sql6="SELECT * FROM subject_master WHERE status=0";
	$result6 = mysqli_query($link,$sql6);
	while($row6=mysqli_fetch_array($result6)){
		$e1="txt_subkey".$row6['subject_key'];
		
		$btn_remove1="btn_remove".$row6['subject_key'];
		
		if(isset($_POST[$btn_remove1])){
				
				
				$t1=$_POST[$e1];
				
				echo "<script>
				if (window.confirm('Are you sure you want to delete this item?')) { 
					window.location.href='subject_info.php?cs=$_GET[cs]&yr=$_GET[yr]&sd=$t1';
				}
				</script>";
		}
		
	}
	
	if(isset($_GET['sd'])){
				
				
				$sql10="UPDATE subject_master SET status=1,act_person='$ukey' WHERE subject_key='$_GET[sd]' AND status=0";
				if(mysqli_query($link,$sql10)){
					
					echo "<script>
							alert('Successfully Deleted Subject');
							window.location.href='subject_info.php?cs=$_GET[cs]&yr=$_GET[yr]';
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
						</script>";
				}
	}
	
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Subject Add</title>
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
							<?php
							$sql9="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
										  WHERE course_master.course_key='$_GET[cs]'";
							$result9 = mysqli_query($link,$sql9);
							while($row9=mysqli_fetch_array($result9)){
							?>
								<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $row9['facalty_nme']." - ".$row9['course_nme'];?></h2>
							
							<?php
							}
							?>
							<?php
							$sql10="SELECT * FROM year_master WHERE year_key='$_GET[yr]'";
							$result10 = mysqli_query($link,$sql10);
							while($row10=mysqli_fetch_array($result10)){
							?>
								<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $row10['year_nme'];?></h2>
							<?php
							}
							?>
						</div>
					</section>
				</div>
			</div>
			
			
			<div class="row">
                <div class="col-md-6">
				
				</div>
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f1" enctype="multipart/form-data">
									<div class="form-group">
										<label>Subject Name</label>
										<input type="text" class="form-control input-sm" name="txt_subjectnme" placeholder="Please Enter Subject Name" required >
									</div>
									<button type="submit" name="btn_addsubinfo" class="btn btn-primary btn-lg btn-block">Add Subject</button>
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
							<form method="post" name="f2">
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="90%"><font color="red">&lowast;</font>Subject Name</th>
										<th width="10%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									
												<?php
													
													$sql14="SELECT * FROM subject_master WHERE course_key='$_GET[cs]' AND year_key='$_GET[yr]' AND status=0";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_subkey="txt_subkey".$row14['subject_key'];
														
														$btn_remove="btn_remove".$row14['subject_key'];
														
														echo "<tr>
																
																<td width='90%'>
																	<input type='hidden' class='form-control input-sm' name=".$txt_subkey." value=".$row14['subject_key'].">
																	".$row14['subject_name']."</td>
																<td width='10%'>
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_remove.">
																</td>
															</tr>";
													}
													
													
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
