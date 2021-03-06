<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['smsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $uid=$_SESSION['smsuid'];
    $name=$_POST['name'];
  $mobno=$_POST['mobilenumber'];
  $emobno=$_POST['emobilenumber'];
  $Noofmember=$_POST['Noofmember'];
  $add=$_POST['add'];
  $sql="update tblallotment set Name=:name,ContactNumber=:mobilenumber,EContactnum=:emobilenumber,Noofmember=:Noofmember,Address=:add where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$name,PDO::PARAM_STR);
     $query->bindParam(':Noofmember',$Noofmember,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':emobilenumber',$emobno,PDO::PARAM_STR);
     $query->bindParam(':add',$add,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

    echo '<script>alert("Your profile has been updated")</script>';
 
  }
  ?>
<!doctype html>
<html lang="en">

<head>
<title>E-Society || User Profile</title>

<!-- VENDOR CSS -->
<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/vendor/animate-css/animate.min.css">
<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
<link rel="stylesheet" href="../assets/vendor/parsleyjs/css/parsley.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>
<body class="theme-blue">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../assets/images/thumbnail.png" width="48" height="48" alt="Mplify"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay" style="display: none;"></div>

<div id="wrapper">

   <?php include_once('includes/header.php');?>

  <?php include_once('includes/sidebar.php');?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>User Profile</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>User Profile</h2>
                        </div>
                        <div class="body">
                            <?php
$uid=$_SESSION['smsuid'];
$sql="SELECT * from  tblallotment where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <form id="basic-form" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php  echo $row->Name;?>" class="form-control" required='true'></div>
                                
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" name="mobilenumber" value="<?php  echo $row->ContactNumber;?>" class="form-control" maxlength='10' required='true'>
                                </div>
                                <div class="form-group">
                                    <label>Emergency Contact Number</label>
                                    <input type="text" name="emobilenumber" value="<?php  echo $row->EContactnum;?>"  class="form-control" maxlength='10' required='true'>
                                </div>
                                <div class="form-group">
                                   <label>Block</label>
                                    <input type="text" name="block" value="<?php  echo $row->Block;?>" class="form-control" readonly='true'>
                                </div>
                                <div class="form-group">
                                   <label>Flat Number</label>
                                    <input type="text" name="flatno" value="<?php  echo $row->FlatNum;?>" class="form-control" readonly='true'>
                                </div>
                                <div class="form-group">
                                   <label>No. of Member</label>
                                    <input type="text" name="Noofmember" value="<?php  echo $row->Noofmember;?>" class="form-control" required='true'>
                                </div>
                                <div class="form-group">
                                   <label>Address</label>
                                    <input type="text" name="add" value="<?php  echo $row->Address;?>" class="form-control" required='true'>
                                </div>
                                <div class="form-group">
                                    <label>Allotment Date</label>
                                 <input type="text" name="" value="<?php  echo $row->AllotmentDate;?>" readonly="true" class="form-control">
                                </div>
                               <?php $cnt=$cnt+1;}} ?> 
                                <br>
                                <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="../assets/vendor/parsleyjs/js/parsley.min.js"></script>
    
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/bundles/morrisscripts.bundle.js"></script>
<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
    });
    </script>
</body>
</html>

<?php }  ?>