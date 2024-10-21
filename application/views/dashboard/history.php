<!DOCTYPE html>
<html>
<head>
	<title>E-wallet System</title>
	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>
<body>
	<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <h5 class="pt-1">E-Wallet System</h5>
        </a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/history') ?>">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/products') ?>">Products</a>
                </li>
                
            </ul>
          
        </div>
        <h4 style="color: #fff;margin-right: 20px;"><?php echo ucfirst($_SESSION['username']);?></h4>
    <a href="<?php echo site_url('logout');?>" style="color: #fff;">Logout</a>
        <!-- Collapsible wrapper -->
    </div>
    
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
<!-- Button trigger modal -->




<div style="height: 300px;">
<div class="col-md-12">
	<!-- Modal -->

<table style="margin-top: 30px;" id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>SL NO</th>
      <th>Receiver Name</th>
      <th>Sent Amount</th>
      <th>Remaining Amount</th>
      <th>Date</th>
      <th>Time</th>
    
    </tr>
  </thead>
  <tbody>
<?php
  if(!empty($trans)){
 $i = 1; foreach($trans as $val){?>

    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $val['username']; ?></td>
      <td><?php echo $val['sent_amount']; ?></td>
      <td><?php echo $val['existing_amount']; ?></td>
      <td><?php echo $val['date']; ?></td>
      <td><?php echo $val['time']; ?></td>
    </tr>
<?php }}else{ ?>
  <tr><td colspan="6" style="text-align: center;">History not Found</td></tr>
<?php } ?>
  </tbody>

</table>
	
</div>

<!-- Footer -->
<footer class="bg-primary text-center text-white fixed-bottom">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
           
        </section>
        <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©Copyright:
        <a class="text-white" href="#">E-Wallet System</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
	
</body>
</html>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>

