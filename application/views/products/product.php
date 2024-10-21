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
            <!-- Left links -->

            <!-- Right elements -->
          
            <!-- Right elements -->
        </div>
        <h4 style="color: #fff;margin-right: 20px;"><?php echo ucfirst($_SESSION['username']);?></h4>
    <a href="<?php echo site_url('logout');?>" style="color: #fff;">Logout</a>
        <!-- Collapsible wrapper -->
    </div>
    
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
<!-- Button trigger modal -->
<!-- product Images -->
<div class="modal" id="productImageDisplayModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Images</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container product_img">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div style="height: 300px;">
<div class="col-md-12">
	<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="productForm" method="post" enctype="multipart/form-data">
      <div class="modal-body">
    <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Product Name :</label> 
    <div class="col-8">
      <div class="input-group">
        <input id="product_name_val" name="product_name" type="text" class="form-control" required="">
        <input id="product_id_val" name="product_id" type="hidden" class="form-control">
      </div>
    </div>
  </div> 
 
   <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Product Image :</label> 
    <div class="col-8">
      <div class="input-group">
        <input type="file" name="files[]" class="form-control" multiple>
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


<div class="col-md-6">
  <button class="btn btn-primary pull-right" style="width: 20%; color: white; margin-top: 20px; margin-bottom: 20px;" data-toggle="modal" data-target="#productModal" id="openProductModal">
    <i class="fa fa-plus-circle"></i><strong> Add new</strong>
</button>
<table style="margin-top: 30px;" id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Product Image</th>
      <th>Product Name</th>
      <th>Product ID</th>
      <th>Created Time</th>
     <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php 
  if(!empty($products)){
foreach($products as $val){ ?>

    <tr>
      <td>
        <?php if(!empty($val['p_image'][0])){?>
        <a href="javascript:void(0)" id="<?php echo $val['id']; ?>" class="displayImages"><img src="<?php echo base_url('/product_images'); ?>/<?php echo $val['p_image'][0]; ?>" width="150px"/></a>
      <?php }else{?>
        <a href="javascript:void(0)" id="<?php echo $val['id']; ?>"  pro_name="<?php echo $val['p_name']; ?>"data-toggle="modal" data-target="#productModal" class="btn btn-primary upload_img">Upload</a>
      <?php } ?>
      </td>
      <td><?php echo $val['p_name']; ?></td>
      <td><?php echo $val['p_id']; ?></td>
      <td><?php echo $val['p_created_time']; ?></td>
        <td>
        <a href="javascript:void(0)" id="<?php echo $val['id']; ?>" class="btn btn-danger deleteProduct">Delete</a>
        
       
      </td>
    </tr>
<?php }}else{ ?>
  <tr><td colspan="5" style="text-align: center;">Record not Found</td></tr>
<?php }?>
  </tbody>
  
</table>
	</div>
</div>

<!-- Footer -->
<footer class="bg-primary text-center text-white fixed-bottom">
    <div class="container p-4 pb-0">
        <section class="mb-4"></section>
    </div>
  
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
      <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

<script type="text/javascript">
	

  $(document).ready(function(){

    $("#productForm").submit(function(e){
      e.preventDefault();
     
      var siteurl = '<?php echo site_url('Welcome/add_product');?>';
      
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
            $("#product_id_val").val('');
            $('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
            toastr.success('Product added Successfully');
            $('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
            $("#productForm")[0].reset();
            $('#productModal').modal('toggle'); 


          }
        }
      })
    });
    });
  
  $(document).on('click','.deleteProduct',function(){
    var id = $(this).attr('id');
    swal({
  title: 'Are you sure?',
  text: 'This Product will not recover after Delete !!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#DD6B55',
  confirmButtonText: 'Yes!',
  cancelButtonText: 'No.'
}).then((result) => {
   if (result.value) {
   $.ajax({
      type:'post',
      url:'<?php echo site_url('Welcome/delete_product');?>',
      data:{'id':id},
      async:false,
      success:function(response){
         var res = jQuery.parseJSON(response);
         if(res==1){
          toastr.success("Deleted successfully");
          $('#dtBasicExample').load(document.URL +  ' #dtBasicExample');
         }
      }
    });
}

});
   
  });

  $(document).ready(function(){
$(document).on('click','.displayImages',function(){
    var id = $(this).attr('id');
     $.ajax({
      type:'post',
      url:'<?php echo site_url('Welcome/get_images');?>',
      data:{'id':id},
      async:false,
      success:function(response){
         var res = jQuery.parseJSON(response);
        var htm = '';
        htm +='<div class="card-group">'; 
      htm +='<div class="row">'; 
      $.each(res,function(fdx,vx){
        htm +='<div class="card col-md-4" style="margin-right:5px; margin-top:5px;">'; 
          htm +='<img class="card-img-top" src="<?php echo base_url('/product_images'); ?>/'+vx+'">'; 
        htm +='</div>';
  
   
  });
htm +='</div> ';
    htm +='</div>';
     $(".product_img").html(htm);
      }
    });
    $("#productImageDisplayModal").modal('toggle');
  });

$(document).on('click','.upload_img',function(){
 var id = $(this).attr('id');
 var product_name = $(this).attr('pro_name');
$("#product_name_val").val(product_name);
$("#product_id_val").val(id);


});
  $(document).on('click','#openProductModal',function(){
    $("#productForm")[0].reset();
  });

});


</script>
