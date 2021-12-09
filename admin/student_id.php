<?php
include 'conn.php';																	// mysql connect
?>

<?php
$message="";
$status=0;


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <title>Student ID</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
	  
	   
	   <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
	  
	   <script type="text/javascript" src="js/code39.js"></script>

    <style type="text/css">
          .panel-transparent {
              background: none;
          }

          .panel-transparent .panel-heading{
               background: rgba(46, 51, 56, 0.8)!important;
          }

          .panel-transparent .panel-body{
              background: rgba(46, 51, 56, 0.8)!important;
          }

          body{
            background-position:center;
            background-attachment:fixed;
            background-size:100% 100%;
            
          }
          label {
                      color: #FFFFFF;
                      font-size:15px ;
          }
         
	

    .page {
          background: white;
          display: block;
          margin: 0 auto;
          margin-bottom: 0.5cm;
       
          width: 20cm;
            height: 10cm; 
        }

  #all{
  margin: 0 auto;
  }
    

    @media print {
        body, .page {
          margin: 0;
          box-shadow: 0;
        }
		
    }

    #bcpage{
          background: rgb(204,204,204); 
      
    }
      .ss {
      font-size: 24px;
      font-weight: bold;
      color: black;
    }
        .sdf {
  color: black;
  text-align: left;
  font-size:14px;
    }

      .p_table{
        background:white; 
        color: black;
		padding:0;
		margin-top:0;
      }

      .p_h1{
        color:black;
      }

      .msgcenter{
        text-align: center;
      }
    .snf{
		  color: #000;
		  font-size: 23px;
		  font-weight: bold;

    }
    #righal{
      text-align: justify;
      text-align-last:right;
    }
	 
	
	
	.sdf1{
		font-size:12px;
		font-weight:bold;
	}

    </style> 

     <script type="text/javascript">
        $(function () {
            $('#txtDate').datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true
            });
        });
    </script>

</head>
<?php
	if(isset($_GET['sid'])){
		$key=$_GET['sid'];
		
		$sql1="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
										  INNER JOIN course_master ON batch_master.course_key=course_master.course_key
										  INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
										  WHERE student_master.student_key='$key'";
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
			$y11=$row1['batch_mas_key'];
		}
		
		
?>
 <form name="f3" method="Post">
	<div class="row">
	
		<div class="col-md-12">
			<input type="submit" onclick="i2()" name="btn_finalprint1" value="Print Student Id" class="btn btn-primary btn-lg btn-block"/>
		</div>
	</div>
  </form>
  <br>
  <a href="student_reg.php?batch=<?php echo $y11; ?>"><button class="btn btn-danger btn-lg btn-block">No Print</button></a>
  <br>
  <div id="bcpage">
  <div id="all">
    <div class="page" id="page">
		<table width="88%" border="0" align="center" class="p_table">
			<tr>
				<td width="20%" height="79" align="center"><img src="images/mlogo.png" width="95" height="95"></td>
				<td width="3%"></td>
				<td width="75%">
					<div class="snf" align="center">Beliaththa Tecnological Institute</div>
					<div style="font-size: 21px;font-weight: bold;color:#000;" align="center">Beliatta- Sri Lanka</div>
				</td>
			</tr>
			
			
		</table>
		<br>
		<table width="88%" border="0" align="center" class="p_table">
			<tr>
				<td width="88%">
					<table width="100%">
							<tr>
								<td width="100%" align="center"><div style="font-size: 18px;font-weight: bold;color:#000;" align="center"><?php echo $y9; ?></div></td>
							</tr>
							<tr>
								<td width="100%" align="center"><div style="font-size: 18px;font-weight: bold;color:#000;" align="center"><?php echo $y8; ?></div></td>
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table width="88%" border="0" align="center" class="p_table">
			<tr>
				<td width="88%">
					<table width="100%">
							<tr>
								<td width="18%"><img src="studentphotosupload/<?php echo $y7; ?>" width="100%" height="120px" ></div></td>
								<td width="2%"></td>
								<td width="80%">
										<table width="100%">
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;">Batch</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%"><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y10; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;">Student ID</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%"><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y1; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;" >Full Name</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%" ><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y2; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;" >Initial Name</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%" ><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y3; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;" >Address</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%" ><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y6; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;" >NIC No</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%" ><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y5; ?></div></td>
											</tr>
											<tr>
												<td width="20%"><div style="font-size: 14px;font-weight: bold;color:#000;" >Date of Birth</div></td>
												<td width="5%"><div style="font-size: 14px;font-weight: bold;color:#000;">:</div></td>
												<td width="75%" ><div style="font-size: 12px;font-weight: bold;color:#000;"><?php echo $y4; ?></div></td>
											</tr>
										</table>
											
								</td>
							</tr>
							
					</table>
				</td>
			</tr>
		</table>
		<br>
		<div id="inputdata"><?php echo $y1;?></div>
	</div>
   </div>
	</div>
<?php
	}
?>	    
		
	
</body>
<script type="text/javascript">     
    function printDiv() {
      

        var printContents = document.getElementById('all').innerHTML;
        var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
	
	function get_object(id) {
	   var object = null;
		if (document.layers) {
			object = document.layers[id];
		} else if (document.all) {
			object = document.all[id];
		} else if (document.getElementById) {
			object = document.getElementById(id);
		}
	   return object;
	}
	get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML);
  </script>
<?php
mysqli_close($link);
?>
</html>