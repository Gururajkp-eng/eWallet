<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	    function __construct() {
        parent::__construct();
      
		$this->load->model('model');
    }
	public function index()
	{
		$data['message']=$this->session->flashdata('message');
		$data['signup_message']=$this->session->flashdata('signup_message');
		$data['exist_message']=$this->session->flashdata('exist_message');

		$this->load->view('login',$data);
	}

	//Checking User login Credential
	public function check(){

		// $usernameORemail=$this->input->post('emailORusername');
		$usernameORemail=$this->input->post('emailORusername');
		$password=$this->input->post('password');
		$hashedPassword=$this->model->getPassword($usernameORemail) ?:'';
		if($this->verifyHash($password,$hashedPassword) == TRUE)
               {
             
			$row=$this->model->getDetails($usernameORemail,$hashedPassword);
			$newdata = array(
	        'username'  => $row->username,
	        'password'     => $row->password,
	        'user_id'     => $row->id,
	        'email'=>$row->email
				);

			$this->session->set_userdata($newdata);
       		redirect('dashboard');
	    }
	     	
	    $this->session->set_flashdata('message','Unauthorized access invalid login details.');
	     redirect('/');
	   
	}
	public function signup(){

		$email=$this->input->post('email');
		$username=$this->input->post('emailORusername');
		$password=$this->input->post('password');
		$hashedPassword=$this->hash($password);
		$checkEmailExist = $this->db->select('email')->from('users')->where('email',$email)->get()->row();
		if(empty($checkEmailExist)){
	     $regData = array(
	     	'username'=>$username,
	     	'password'=>$hashedPassword,
	     	'email' => $email
	     );	
	   $result = $this->Model->signup($regData);
	    $this->session->set_flashdata('signup_message','Unauthorized access invalid login details.');
	   redirect('/');
	}else{
		$this->session->set_flashdata('exist_message','Email is already registered.');
	   redirect('/');
	}
	}

	//Loading Dashboard Page
	public function dashboard(){
		if($_SESSION['username']){
		$data['users_amt'] = $this->Model->getAll();
		$this->load->view('dashboard/dashboard',$data);
		}else{
			redirect('/');
		}
	}
	//user logout
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
		
	}

	//Hashing the user entered password
	public function hash($password)
   {
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
   }

   //verify password
   public function verifyHash($password,$vpassword)
   {
       if(password_verify($password,$vpassword))
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
   }

   //User adding amount
   public function add_amount(){
	
	$amount = $this->input->post('amount');
	$checkAmountExist = $this->db->select('amount')->from('user_wallet')->where('user_id',$_SESSION['user_id'])->get()->row();
	if(!empty($checkAmountExist)){
		$result = 2;
		echo json_encode($result);
	}else{
	$formArr = array('amount'=>$amount,'user_id'=>$_SESSION['user_id']);
	$result = $this->Model->add($formArr);
	echo json_encode($result);
	}
   }


   
   //Deleting User added amount
   public function delete_user_amount()
	{
		$id = $this->input->post('id');
		$res = $this->Model->delete_user_amt($id);
		echo json_encode($res);
	}
	public function get_user()
	{
		$id = $this->input->post('id');
		$res = $this->Model->get_user($id);
		echo json_encode($res);
	}

  

	public function transfer_amount(){
	
	$transfer_amt = $this->input->post('transfer_amt');
	$user_id = $this->input->post('user_id');

	$existingAmountOfSender = $this->db->select('amount')->from('user_wallet')->where('user_id',$_SESSION['user_id'])->get()->row();
	$existingAmountOfReceiver = $this->db->select('amount')->from('user_wallet')->where('user_id',$_SESSION['user_id'])->get()->row();
	if(!empty($existingAmountOfSender)){
		if($transfer_amt > $existingAmountOfSender->amount){
			$result = 'exceed';
			echo json_encode($result);
		}else{
			$principle_amt = $existingAmountOfSender->amount - $transfer_amt;
			$transferData = array('amount'=>$transfer_amt,'user_id'=>$user_id); 
			// $existingData = array('amount'=>$principle_amt,'sent_amount'=>$transfer_amt,'receiver_id'=>$user_id,'user_id'=>$_SESSION['user_id']);
			$existingData = array('amount'=>$principle_amt,'user_id'=>$_SESSION['user_id']);
			$result = $this->Model->update_principle_amount($existingData,$transferData,$user_id,$transfer_amt);
			echo json_encode($result);
		}
		
	}
   }
/*User Transactions*/
public function history()
	{
		
		if($_SESSION['username']){
		$data['trans'] = $this->Model->getAllTransactions();
		$this->load->view('dashboard/history',$data);
		}else{
			redirect('/');
		}
			
	}


	/* Product Functionalities*/

	public function products()
	{
		
		if($_SESSION['username']){
		$data['products'] = $this->Model->getAllProducts();
		$this->load->view('products/product',$data);
		}else{
			redirect('/');
		}
			
	}
public function get_images()
	{
		$id = $this->input->post('id');
		$productResult = $this->Model->get_all_images($id);
		
		echo json_encode($productResult);
	}
	//Add Product
	public function add_product()
	{

	$product_name = $this->input->post('product_name');
	$product_id_primary = $this->input->post('product_id');

	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
	$datetime = date('Y-m-d H:i:s');
	$this->load->helper('string');
	$targetDir = "product_images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    $filesData = array();
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    $insertValuesSQL .= "'".$fileName."',"; 
                    array_push($filesData,$fileName);
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
        $productArray = array(
        	'product_name'=>$product_name,
        	'product_id'=>random_string('alnum',5),
        	'product_image'=>implode(',', $filesData),
        	'created_at'=>$datetime,
        	'updated_at'=>$datetime,
        	'user_id'=>$_SESSION['user_id']
        );
    }else{
    	$productArray = array(
        	'product_name'=>$product_name,
        	'product_id'=>random_string('alnum',5),
        	'product_image'=>'',
        	'created_at'=>$datetime,
        	'updated_at'=>$datetime,
        	'user_id'=>$_SESSION['user_id']
        );
    }
	
       
		 $result = $this->Model->add_or_update_product($productArray,$product_id_primary);

		echo json_encode($result);

	
	}

	public function delete_product()
	{
		$id = $this->input->post('id');
		$res = $this->Model->delete_product($id);
		echo json_encode($res);
	}
}
