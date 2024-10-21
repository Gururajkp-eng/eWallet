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


<div style="height: 300px;">
<div class="col-md-12">
	<!-- Modal -->
<div class="modal fade" id="transferAmountModal" tabindex="-1" role="dialog" aria-labelledby="transferAmountModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferAmountModalLabel">Amount Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="transferAmountForm" method="post" enctype="multipart/form-data">
      <div class="modal-body">
    <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Enter User Id :</label> 
    <div class="col-8">
      <div class="input-group">
        <input id="text" name="user_id" type="text" pattern="[0-9]+" class="form-control getUser" required="">
      </div>
    </div>
  </div> 
   <div class="form-group row">
    <label for="text" class="col-4 col-form-label">User Name :</label> 
    <div class="col-8">
      <div class="input-group">
        <input name="user_name" type="text" id="userName" class="form-control" readonly="">
      </div>
    </div>
  </div> 

  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Enter Amount:</label> 
    <div class="col-8">
      <div class="input-group">
        <input id="text" name="transfer_amt" type="text" pattern="[0-9]+" class="form-control" required="">
      </div>
    </div>
  </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Transfer</button> -->
    <input type="submit" name="submit" id="submit"  class="btn btn-primary" value="Submit">

      </div>
      </form>
    </div>
  </div>
</div>
	<form class="form-horizontal" id="addAmountForm" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label"  for="textinput">Amount</label>  
  <div class="col-md-4">
  <input id="amount" name="amount" type="text" pattern="[0-9]+" title="please enter number only" placeholder="Enter Amount" class="form-control input-md" required="">
  <input id="userid" name="userid" type="hidden" class="form-control input-md" >
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <div class="col-md-4">
  	<label class="col-md-4 control-label" for="button"></label>
    <!-- <button id="singlebutton" name="singlebutton" class="btn btn-primary">Button</button> -->
    <input type="submit" name="submit" id="submit"  class="btn btn-primary pull-left" value="Submit">
  </div>
</div>



</fieldset>
</form>

<div class="col-md-6">
<table style="margin-top: 30px;" id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Amount

      </th>
     
     <th>Action

      </th>
    </tr>
  </thead>
  <tbody>
<?php 
if(!empty($users_amt)){

foreach($users_amt as $val){?>

    <tr>
      <td><?php echo $val->amount; ?></td>
      
      <td>
      	<a href="javascript:void(0)" id="<?php echo $val->amount_id; ?>" class="btn btn-danger deleteAmount">Delete</a>
      	<button type="button" id="<?php echo $val->amount_id; ?>"  class="btn btn-primary" data-toggle="modal" data-target="#transferAmountModal">Transfer</button>
       
      </td>
     
    </tr>
<?php }}else{?>
<tr><td colspan="2" style="text-align: center;">Record not Found</td></tr>

<?php } ?>
  </tbody>

</table>
	</div>
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
 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
      
<script type="text/javascript">
	$(document).ready(function(){
		$("#addAmountForm").submit(function(e){
			e.preventDefault();
			var id  = $("#userid").val();
			if(id){
			var	siteurl = '<?php echo site_url('Welcome/update_amount');?>';
			}else{
			var	siteurl = '<?php echo site_url('Welcome/add_amount');?>';
			}
			$.ajax({
				type:'post',
				url:siteurl,
				data:new FormData($(this)[0]),
				async:false,
				contentType:false,
				processData:false,
				success:function(response){
					var res = jQuery.parseJSON(response);

					if(res==1){

						// alert("added successfully");
            toastr.success('Amount Added Successfully');

						$('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
						$("#addAmountForm")[0].reset();

						// location.reload();
					}else if(res==2){
             toastr.info('You cannot Create Amount more than Once!!');
          }
				}
			})
		});
	});

	$(document).on('click','.deleteAmount',function(){
		var id = $(this).attr('id');

		$.ajax({
			type:'post',
			url:'<?php echo site_url('Welcome/delete_user_amount');?>',
			data:{'id':id},
			async:false,
			success:function(response){
				 var res = jQuery.parseJSON(response);
				 if(res==1){
				 	toastr.success("deleted successfully");
				 	$('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
				 }
			}
		});
	});
$(document).on('keyup','.getUser',function(){
    var id = $(this).val();
console.log(id);
    $.ajax({
      type:'post',
      url:'<?php echo site_url('Welcome/get_user');?>',
      data:{'id':id},
      async:false,
      success:function(response){
         var res = jQuery.parseJSON(response);
         console.log(res);
         if(res){
         $("#userName").val(res.username);
        }else{
          $("#userName").val('');
        }
      }
    });
  });

  $(document).ready(function(){

    $("#transferAmountForm").submit(function(e){
      e.preventDefault();
     
      var siteurl = '<?php echo site_url('Welcome/transfer_amount');?>';
      
      $.ajax({
        type:'post',
        url:siteurl,
        data:new FormData($(this)[0]),
        async:false,
        contentType:false,
        processData:false,
        success:function(response){
          var res = jQuery.parseJSON(response);

          if(res== 'exceed'){

            // alert("added successfully");
            toastr.warning('The Entered Amount should not be Greater than Existing Amount..');

            // location.reload();
          }else if(res==1){
            $('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
            toastr.success('Transfered Successfully');
            $('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
            $("#transferAmountForm")[0].reset();
            $('#transferAmountModal').modal('toggle'); 


          }
        }
      })
    });
    });
  

</script>
