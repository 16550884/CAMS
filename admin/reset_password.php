<?php
include 'conn.php';
include 'sessionhandaler.php';
?>

<?php
      $quary8 ="SELECT * FROM user_master WHERE  NOT user_key=1";                    // Supplier Details Load Combobox
      $result8 = mysqli_query($link ,$quary8);
      $option6="";
      while($row8=mysqli_fetch_array($result8)){
                                                 
            $option6 = $option6."<option>$row8[user_nme]</option>";                                                                           //combobox Load to Item Code
      }

  if(isset($_POST['cmb_usernme'])){
    $quary1 ="SELECT * FROM user_master WHERE user_nme='$_POST[cmb_usernme]'";
    $result1 = mysqli_query($link ,$quary1);
    while($row2=mysqli_fetch_array($result1)){
          $un=$row2['user_nme'];
          $en=$row2['user_fullnme'];
          $ul=$row2['user_level'];
          $email=$row2['email'];
    }

  }

  if(isset($_POST['btn_resetpw'])){
      $username=$_POST['txt_usernme'];
      $defa="9900";
      $pnw=MD5($defa);
	  
	$sql1 ="SELECT * FROM user_master WHERE user_nme='$username'";
    $result1 = mysqli_query($link ,$sql1);
    while($row1=mysqli_fetch_array($result1)){
          $un1=$row1['user_nme'];
          $en1=$row1['user_fullnme'];
          $ul1=$row1['user_level'];
          $email1=$row1['email'];
    }
      
      $sql9="UPDATE user_master SET password='$pnw' WHERE user_nme='$username'";
      if(mysqli_query($link, $sql9)){
          
		  $to=$email1;
							$subject='Classroom Managment System - User Registration';				//subject eka danna
							$msg="Dear  ".$en1." \r\n"
									."Your Defualt Password is 9900. This password is Change your first login \r\n"
									."Thank You \r\n"
									."Classroom Managment System \r\n";	
							$headers  = 'From: nilmini2043@gmail.com' . "\r\n" .
										'MIME-Version: 1.0' . "\r\n" .
										'Content-type: text/html; charset=utf-8';
							$mails=mail($to,$subject,$msg,$headers);
							if($mails){
								 $message=" Reset Password and mail Send";
							}
							else{
									 $message=" Reset Password and mail not Send";
							}
				
		  
		
      }

  }

?>

<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
 <head>
        <title>Reset Password</title>
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
     <br>  
     <br>  
     <br>  
	<div class="row">
				<div class="col-lg-6">
				
				</div>
				<div class="col-lg-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Reset Password</div>
						</div>
					</section>
				</div>
			</div>
<div id="container">
    	


		<div class="row">

			<div class="col-lg-6">

			</div>
            
                
			<div class="col-lg-5">
                        <div class="row">
                  <div class="col-lg-12">
                      <section class="panel panel-transparent">
                          
                          <div class="panel-body panel-transparent">
                              <form role="form" method="post">

                                  <div class="form-group">
                                        <label>Select User</label>
                                        <select class="form-control" name="cmb_usernme" onchange="this.form.submit();"> 
                                            <?php
                                                  echo "<option value='' disabled selected hidden>Please Choose...</option>";
                                                  echo $option6;
                                            ?>
                                        </select>
                                  </div>

                                 
                              </form>

                          </div>
                      </section>

                  </div>
              </div>
			</div>
		</div>


	
            
   <?php
      if(isset($_POST['cmb_usernme'])){
   ?>        
		<div class="row">

            <div class="col-lg-6">

            </div>
			<div class="col-lg-5">
                <div class="row">
					<div class="col-lg-12">
						<section class="panel panel-primary panel-transparent">
                          
							<div class="panel-body">
								<form role="form" method="post">
                                  <input type="hidden" name="txt_usernme" value=<?php if(isset($_POST['cmb_usernme'])){echo $_POST['cmb_usernme'];} ?>>
                                    <div class="alert alert-success" align="center">
                                        <label style="font-size:20px">User Name: <?php echo $un; ?></label><br>
										<label style="font-size:20px">Employee Name: <?php echo $en; ?></label><br>
										<label style="font-size:20px">User Level: <?php echo $ul; ?></label><br>
                                    </div>
                                 
                                  <button type="submit" name="btn_resetpw" class="btn btn-primary btn-lg btn-block">Reset Password</button>
								</form>

							</div>
						</section>

					</div>
				</div>
			</div>
		</div>
 <?php
    }
 ?>   

</div>

		<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
		
			<link rel="stylesheet" type="text/css" href="datatable/dataTables.min.css" />
				<script type="text/javascript" src="datatable/dataTables.min.js"></script> 	
</body>
<?php
mysqli_close($link);
?>
</html>
