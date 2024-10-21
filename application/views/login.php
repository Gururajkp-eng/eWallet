<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>E-Wallet System | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body class="login" style="background: #877fff;">	
	<section id="page">
			<header>
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div id="heading_text">
								
								<h2>E-Wallet System</h2>
							</div>
						</div>
					</div>
				</div>
			</header>
			<section id="login" class="visible">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="login-box-plain">

								<h2 class="bigintro">Sign Up</h2>
								<div class="divide-40"></div>
								<form role="form" id="signup_form" action="<?php echo site_url() ?>/welcome/signup" method="post">
								<?php if(!empty($signup_message)): ?>
								<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><h4>Successfully Registered.</h4></div>

								<?php endif; ?>
								<?php if(!empty($exist_message)): ?>
								<div class="alert alert-block alert-danger fade in"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><h4>This Email is already Registered.</h4></div>

								<?php endif; ?>
								
								
								  <div class="form-group">
									<label for="emailORusername">Username</label>
									<i class="fa fa-envelope"></i>
									<input type="text" class="form-control" name="emailORusername" id="emailORusername" required="">
								  </div>
								  <div class="form-group">
									<label for="email">Email</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" name="email" id="email" required="">
								  </div>
								  <div class="form-group"> 
									<label for="password">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" name="password" class="form-control" id="password" required="">
								  </div>
								  <div class="form-actions">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
									<button type="submit" class="btn btn-danger">Sign Up</button>
								  </div>
								</form>
							</div>
						</div>
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="login-box-plain">

								<h2 class="bigintro">Sign In</h2>
								<div class="divide-40"></div>
								<form role="form" id="loginform" action="<?php echo site_url() ?>/welcome/check" method="post">
								<?php if(!empty($message)): ?>
								<div class="alert alert-block alert-danger fade in">
											<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
											<h4><i class="fa fa-times"></i> Oh snap! You got an error!</h4>
												<p><?php echo isset($message)? $message:''; ?> </p>
												
										</div>
								<?php endif; ?>
								
								  <div class="form-group">
									<label for="emailORusername">Email</label>
									<i class="fa fa-envelope"></i>
									<input type="text" class="form-control" name="emailORusername" id="emailORusername" >
								  </div>
								  <div class="form-group"> 
									<label for="password">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" name="password" class="form-control" id="password" >
								  </div>
								  <div class="form-actions">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
									<button type="submit" class="btn btn-danger">Submit</button>
								  </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		
		
			
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("login");
			App.init(); 
		});
	</script>
	<script type="text/javascript">
		function swapScreen(id) {
			jQuery('.visible').removeClass('visible animated fadeInUp');
			jQuery('#'+id).addClass('visible animated fadeInUp');
		}
	</script>
	
</body>
</html>