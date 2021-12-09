
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");

	if(isset($_POST['btn_facaltyadd'])){
		$n1=$_POST['txt_facalty'];
		
		
		$sql1="SELECT * FROM facalty_master WHERE facalty_nme='$n1' AND status=0";
		$result1 = mysqli_query($link,$sql1);
		if(mysqli_num_rows($result1)==0){
			
			$sql2 = "INSERT INTO facalty_master (status,facalty_key,facalty_nme) VALUES 
											(0,NULL,'$n1')";
			if(mysqli_query($link,$sql2)){
				echo "<script>
						alert('Successfully Entered Department');
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
				alert('Already Added this information');
			</script>";
		}
	}
	
	$sql3="SELECT * FROM facalty_master WHERE status=0 ORDER BY facalty_key DESC";
	$result3 = mysqli_query($link,$sql3);
	while($row3=mysqli_fetch_array($result3)){
			
			$e1="txt_facaltykey".$row3['facalty_key'];
			$e2="txt_facaltynme".$row3['facalty_key'];
		
			
			//$btn_update1="btn_update".$row3['facalty_key'];
			$btn_edit="btn_edit".$row3['facalty_key'];
			$btn_del="btn_del".$row3['facalty_key'];
			
			
		
		
		if(isset($_POST[$btn_edit])){
				$t1=$_POST[$e1];
				
				$sql5="UPDATE facalty_master SET facalty_nme='$_POST[$e2]' WHERE facalty_key='$t1' AND status=0";
				if(mysqli_query($link,$sql5)){
					echo "<script>
							alert('Successfully Edit Faculty');
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
						</script>";
				}
		}
		
		if(isset($_POST[$btn_del])){
			$t1=$_POST[$e1];
			echo "<script>
				if (window.confirm('Are you sure you want to delete this item?')) { 
					window.location.href='facalty_info.php?sd=$t1';
				}
			</script>";
			
			
		}
		
	}
	
	if(isset($_GET['sd'])){
				
				$sql5="UPDATE facalty_master SET status=1 WHERE facalty_key='$_GET[sd]' AND status=0";
				if(mysqli_query($link,$sql5)){
					echo "<script>
							alert('Successfully Delete Faculty');
							window.location.href='facalty_info.php';
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
							window.location.href='facalty_info.php';
						</script>";
				}
	}
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Department Information</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Department Information</div>
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
							<form method="post" name="f1">
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Department Name :</label>   
									<input type="text" class="form-control input-sm" name="txt_facalty" required placeholder="Please Enter Department Name">
								</div> 
								
								<button class="btn btn-lg btn-primary btn-block" name='btn_facaltyadd' type="submit">Add</button>
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
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="80%"><font color="red">&lowast;</font>Department</th>
										<th width="20%">Action</th>
									</tr>
								</thead>
								<tbody>
									<form method="post" name="f2">
												<?php
													$sql14="SELECT * FROM facalty_master WHERE status=0 ORDER BY facalty_key DESC";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_fackey="txt_facaltykey".$row14['facalty_key']; //txt_facaltykey13
														$txt_facnme="txt_facaltynme".$row14['facalty_key'];
														
														$btn_edit="btn_edit".$row14['facalty_key'];
														$btn_del="btn_del".$row14['facalty_key'];
														
														$q1=$row14['facalty_key'];
														$q2=$row14['facalty_nme'];
														
														echo "<tr>
																
																<td width='20%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_fackey." value=".$q1.">
																<textarea class='form-control input-sm' style='height:40px;' name=".$txt_facnme.">".$q2."</textarea>
																
																</td>
																<td width='20%'>
																	<input type='submit' class='btn btn-sm btn-success' value='Edit' name=".$btn_edit.">
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_del." >
																</td>
															</tr>";
													}
													
													
												?>
									</form>
								</tbody>
							</table>
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
