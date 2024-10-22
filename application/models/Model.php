<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {


	public function signup($formArr)
	{
		
		$res = $this->db->insert('users',$formArr);
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	public function add($formArr)
	{
		
		$res = $this->db->insert('user_wallet',$formArr);
		if($res){
			return 1;
		}else{
			return 0;
		}
	}

	public function update_principle_amount($existingData,$transferData,$user_id,$transfer_amt)
	{
		$query = $this->db->query("select user_id,amount from user_wallet where user_id = $user_id");
	    if($query->num_rows() > 0)
	    {	
	    	$tranferAmt = $transferData['amount'];
	    	$existingAmtOfSender = $query->row()->amount;
	    	$updateReceiverWallet = $transferData['amount'] + $query->row()->amount;
	    	$transferData['amount'] = $updateReceiverWallet;
	      	$addTranferedData =  $this->db->where('user_id', $user_id)->update('user_wallet', $transferData);

	    }
	    else
	    {
	       $addTranferedData = $this->db->insert('user_wallet',$transferData);
	    }

		if($addTranferedData){
			$res = $this->db->where('user_id',$_SESSION['user_id'])->update('user_wallet',$existingData);
		
		if($res){
			date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
			$datetime = date('Y-m-d H:i:s');
			$transData = array(
				'sender_id'=>$_SESSION['user_id'],
				'receiver_id'=>$user_id,
				'sent_amt' => $transfer_amt,
				'sent_date_time'=>$datetime,
				'existing_amount'=>$existingData['amount']..
			);
			
		 $this->db->insert('transactions',$transData);
		$existingAmountOfSender = $this->db->select('amount')->from('user_wallet')->where('user_id',$_SESSION['user_id'])->get()->row();
		
		$convertStrToInt = (int)$existingAmountOfSender->amount;
		if($convertStrToInt == 0){
			/*Deleting User in wallet table if user has no amount value*/
			$this->db->where('user_wallet.user_id',$_SESSION['user_id'])->delete('user_wallet');
		}
			return 1;
		
		}else{
			return 0;
		}
		

	}
	}

	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('user_wallet');
		$this->db->where('user_id', $_SESSION['user_id']);
		$this->db->order_by('amount_id','desc');
		 $data = $this->db->get();
		 return $data->result();
		
	}
	public function get_user($id)
	{
		$this->db->select('id,username');
		$this->db->from('users');
		$this->db->where('id',$id);
		$this->db->where('id !=',$_SESSION['user_id']);
		 $data = $this->db->get();
		 return $data->row();	
	}
	
	
	public function delete_user_amt($id)
	{
		
		$res = $this->db->where('amount_id',$id)->delete('user_wallet');
		if($res){
			return 1;
		}else{
			return 0;
		}
	}


	/*Login*/

	public function getPassword($usernameORemail){
		$sql = "SELECT password FROM users WHERE email = ? ";
		$query=$this->db->query($sql, array($usernameORemail));
		if($query->num_rows()==1){
			return $query->row()->password;
		}
		return false;
	}
	public function getDetails($usernameORemail,$password){
	$sql = "SELECT * FROM users WHERE email = ? and password = ?";
		$query=$this->db->query($sql, array($usernameORemail, $password));
		if($query->num_rows()==1){
			return $query->row();
		}
		return false;
	}

	
	public function getAllTransactions()
	{
		$this->db->select('transactions.sent_amt,transactions.existing_amount,transactions.sent_date_time,users.username');
		$this->db->from('transactions');
		$this->db->join('users','users.id=transactions.receiver_id');
		$this->db->where('transactions.sender_id', $_SESSION['user_id']);
		// $this->db->order_by('amount_id','desc');
		 $data = $this->db->get();
		 $transactionOfUser = $data->result();
		
		 $userTransactionHistory = array();
		foreach($transactionOfUser as $val){
			$dateTime = new DateTime($val->sent_date_time);
			$date = $dateTime->format('n.j.Y');
			$time = $dateTime->format('H:i');
				 
			$transaction_data['sent_amount'] = $val->sent_amt;
			$transaction_data['existing_amount'] = $val->existing_amount;
			$transaction_data['username'] = $val->username;
			$transaction_data['date'] = $date;
			$transaction_data['time'] = $time;
			
			array_push($userTransactionHistory,$transaction_data);
		}
		
		return $userTransactionHistory;
		
	}

		public function add_or_update_product($formArr,$product_id_primary)
	{
		if(!empty($product_id_primary)){
		$res =$this->db->where('id',$product_id_primary)->update('products',$formArr);
		}else{
		$res = $this->db->insert('products',$formArr);	
		}
		if($res){
			return 1;
		}else{
			return 0;
		}
	}

	public function getAllProducts()
	{

		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('user_id', $_SESSION['user_id']);
		$this->db->order_by('id','desc');
		 $data = $this->db->get();
		$prodData =  $data->result();
		
		 $productsData = array();
		 foreach($prodData as $val){
		 	$dateTime = new DateTime($val->created_at);
			$time = $dateTime->format('H:i');
		 	$pData['p_image'] = explode(',', $val->product_image);
		 	$pData['p_name'] = $val->product_name;
		 	$pData['p_id'] = $val->product_id;
		 	$pData['p_created_time'] = $time;
		 	$pData['id'] = $val->id;
		 	array_push($productsData,$pData);
		 }
		
		return $productsData;
	}


	public function delete_product($id)
	{
		
		$res = $this->db->where('id',$id)->delete('products');
		if($res){
			return 1;
		}else{
			return 0;
		}
	}

	public function get_all_images($id)
	{

		$this->db->select('products.product_image');
		$this->db->from('products');
		$this->db->where('id', $id);
		 $data = $this->db->get();
		$prodData =  $data->row();
		 $pData = explode(',', $prodData->product_image);

		return $pData;
	}
}
