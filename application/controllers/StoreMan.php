<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StoreMan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model("RequestedComplaintmodel");
		$this->load->model('Users');
		$this->load->model('Email_model');
		$this->load->model('ComplainantModel');
		$this->load->model('AssetKeeperModel');
		$this->load->model('AdminModel');
		$this->load->model('ITAdminModel');

	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Store man Dashboard";
			$data['allReqs'] = $this->RequestedComplaintmodel->getAllReqsCount();
			$data['issuedReqs'] = $this->RequestedComplaintmodel->getAllReqsCountWhere(1);
			$data['pendingReqs'] = $this->RequestedComplaintmodel->getAllReqsCountWhere(0);
			$data['nAProducts'] = $this->RequestedComplaintmodel->getAllReqsCountWhere(2);
			$data['allcount'] = $this->AssetKeeperModel->getAvailableItemsCount();
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/dashboard', $data);
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function reqested_products()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Requested Products";
			$this->load->view('storeman/components/header', $headData);

			$data['asset'] = $this->RequestedComplaintmodel->getrequest();
			$data['pendingAssets'] = $this->RequestedComplaintmodel->getrequests(0);
			$data['issued'] = $this->RequestedComplaintmodel->getrequests(1);
			$data['nAAssets'] = $this->RequestedComplaintmodel->getrequests(2);
//			print_r($data);
//			die();

			$this->load->view('storeman/page_contents/requested_products', $data);
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_request_product($asset_id)
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {

			$headData['title'] = $asset_id . " #: Product Details";

			$data['asset'] = $this->RequestedComplaintmodel->view_request($asset_id);
			foreach ($data as $p) {
				$data['complaint'] = $p;
			}
			$data['complaint'] = $this->RequestedComplaintmodel->view_complaint($data['complaint']['complaint_id']);
			$data['product']=$this->AssetKeeperModel->getAllData()->result_array();
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/view_request_product', $data);
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	function updateAmount()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Store man Dashboard";
			$asset_id = $this->input->post('asset_id');
			$amount = $this->input->post('amount');
			$this->RequestedComplaintmodel->updateAmount($asset_id, $amount);
		} else {
			echo "Access Denied!";
		}
	}

	function updateProductStatus()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			
			$asset_id = $this->input->post('asset_id');
			$status = $this->input->post('stat');
			$old_status = $this->input->post('old_stat');
			$complaint_id = $this->input->post('complaint_id');
			if($status==2){
			 	$this->RequestedComplaintmodel->sendToTreasurer(['complaint_id'=>$complaint_id,'asset_id'=>$asset_id]);
			}
			else{
				$item_id = $this->input->post('item_id');
				$useDesc = $this->input->post('usage');
				$quantity = $this->input->post('quantity');
				$av_quantity=$this->AssetKeeperModel->getInvItemById($item_id)->row_array()['quantity'];
				if(!($quantity>$av_quantity))
				{
					$item_data=['usedin'=>$useDesc,'usedquantity'=>$quantity,'complaint_id'=>$complaint_id,'invID'=>$item_id];
					$this->AssetKeeperModel->issueItem($item_data);
					$this->session->set_flashdata('success','Required product issued successfully...');
				}
				else
				{
					$status=$old_status;
					$this->session->set_flashdata('errors','Not enough quantity in inventory...');
				}
				
			}
			

			if ($this->Users->getDeptOfComplaint($asset_id)['department_id'] == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Asset status has been updated against asset Id.$asset_id.</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Asset status has been updated against asset Id.$asset_id.</p>
				<a href=" . site_url('Admin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			}

			$subject1 = "Asset id: " . $asset_id . " status updated";
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			$this->RequestedComplaintmodel->updateAssetStatus($asset_id, $status);
			

		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Profile";
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/profile');
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$feedback = $this->input->post('feedback');


			$this->ComplainantModel->addFeedback([
				'complaint_id' => $complaint_id,
				'feedback' => $feedback
			]);
			$department_id = $this->ComplainantModel->getComplaintDept($complaint_id);
			if ($department_id == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			}

			$subject1 ="Complaint ID: ".$complaint_id." Feedback";
			if ($department_id == 8) {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint Feedback has been Given against Complaint ID: $complaint_id</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			} else {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint Feedback has been Given against Complaint ID: $complaint_id</p>
				<a href=" . site_url('Admin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			}
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('StoreMan/view_complaint/'.$complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_history()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Complaint History";
			$user_id = $this->session->userdata('user_id');
			$data['complaints'] = $this->ComplainantModel->allComplaints($user_id);
			$data['pendingComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 0);
			$data['InProcessComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 1);
			$data['ReqAssetComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 2);
			$data['Resolved'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Resolved");
			$data['Rejected'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Rejected");
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/complaint_history', $data);
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_complaint($complaint_id)
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = $complaint_id . "#: Complaint Details";

			$data['complaint_details'] = $this->ComplainantModel->complaintDetails($complaint_id);
			$data['asset_details'] = $this->ComplainantModel->getAssetDetails($complaint_id);
			$data['complaint_timeline'] = $this->ComplainantModel->complaintTimeline($complaint_id);
			$data['complaint_feedback'] = $this->ComplainantModel->getComplaintFeedbackDetails($complaint_id);
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/view_complaint', $data);
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function register_complaint()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			$headData['title'] = "Create Complaint";
			$this->load->view('storeman/components/header', $headData);
			$this->load->view('storeman/page_contents/register_complaint');
			$this->load->view('storeman/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function regComplaint()
	{
		if ($this->session->userdata('user_type') === '4' || $this->session->userdata('user_type') === '1') {
			//$department_id = $this->input->post('dept_name', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$description = $this->input->post('details');
			$result=exec("python CMS_MODEL.py $description");
			
			
			if($result=="Electrical")
			{
				$department_id=1;
			}
			else if($result=="Furniture")
			{
				$department_id=2;
			}
			else if($result=="HVAC")
			{
				$department_id=3;
			}
			else if($result=="Plumbing")
			{
				$department_id=4;
			}
			else if($result=="Mechanical")
			{
				$department_id=5;
			}
			else if($result=="Civil")
			{
				$department_id=6;
			}
			else if($result=="Surveillance")
			{
				$department_id=7;
			}
			else if($result=="IT")
			{
				$department_id=8;
			}

			if ($department_id == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			}
			

			$comp_id = $this->ComplainantModel->addComplaint([
				"user_id" => $this->session->userdata('user_id'),
				"department_id" => $department_id,
				"subject" => $subject,
				"description" => $description
			]);
			

			date_default_timezone_set('Asia/Karachi');
			$date=date("Y-m-d h:i:s",strtotime('+1 day'));
			// echo $department_id.'==='.$subject.'==='.$description.'==='.$date;
			// die();
			if($department_id==8)
			{
				if($this->ITAdminModel->getAutoStat()['status']==1)
				{
					$this->AdminModel->updateTime($date, $comp_id);
					$technician=$this->AdminModel->getTechniciansDetails($comp_id);

					if(sizeof($technician)!=0)
					{
						
						$smallest=$technician[0];
						foreach ($technician as $t) 
						{
							if($this->AdminModel->workingOnComplaintsCount($t->technician_id) < $smallest)
							{
								$smallest=$t;
							}
						}
						$technician=$smallest;
						
						$this->AdminModel->assignTechnician($comp_id, ($technician->technician_id));
					}
				}
			}
			else
			{
				if($this->AdminModel->getAutoStat()['status']==1)
				{
					
					$this->AdminModel->updateTime($date, $comp_id);
					$technician=$this->AdminModel->getTechniciansDetails($comp_id);

					if(sizeof($technician)!=0)
					{
						$technician=$technician[array_rand($technician)];
						$this->AdminModel->assignTechnician($comp_id, ($technician->technician_id));
					}		
				}
			}

			$subject1 = $comp_id . ": " . $subject;
			if ($department_id == 8) {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint has been registered against .$comp_id. Id</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $comp_id . ">View Complaint</a>";
			} else {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint has been registered against .$comp_id. Id</p>
				<a href=" . site_url('Admin/view_complaint/') . $comp_id . ">View Complaint</a>";
			}
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('StoreMan/view_complaint/'.$comp_id);

		} else {
			echo "Access Denied!";
		}
	}
	public function assetsInv()
	{
		$headData['title'] = "Inventory";
		$data['allcount'] = $this->AssetKeeperModel->getAvailableItemsCount();
		$this->load->view('storeman/components/header', $headData);
		$this->load->view('storeman/page_contents/dashboardInventory',$data);
		$this->load->view('storeman/components/footer');
	}

	//Inventory

	private function verifyLogin()
	{
		if (!( $this->session->userdata('logged_in') === TRUE && ($this->session->userdata('user_type') === '1'|| $this->session->userdata('user_type') === '4'))){
			redirect('Login');
		}
	}
	public function availableInventory()
	{
		$this->verifyLogin();
			$headData['title'] = "Assets Inventory";
			$this->load->view('storeman/components/header', $headData);

			$data['items']=($this->AssetKeeperModel->getAllData())->result_array();
			$data['restoreable']=$this->AssetKeeperModel->getRestoreable()->result_array();

			 $this->load->view('storeman/page_contents/available',$data);
			 $this->load->view('storeman/components/footer');
	}
	public function addNewItem()
	{
		$this->verifyLogin();
		$name = substr(trim($this->input->post('item_name')),0,49);
		$description = substr(trim($this->input->post('item_description')),0,254);
		$quantity = substr(trim($this->input->post('item_quantity')),0,10);
		$remark=substr(trim($this->input->post('item_remark')),0,49);
		$itemData=['name'=>$name,'description'=>$description,'quantity'=>$quantity,'created_at'=>date("Y-m-d H:i:s")];

		$this->AssetKeeperModel->addNewItem($itemData,$remark);
		redirect('StoreMan/availableInventory');
	}
	public function editItem($id)
	{
		$this->verifyLogin();
		$data['item']=$this->AssetKeeperModel->getItemById($id)->row_array();
		$headData['title'] = "Update Item";
		
		$this->load->view('storeman/components/header', $headData);
		$this->load->view('storeman/page_contents/edit_inventory',$data);
		$this->load->view('storeman/components/footer');	
	}
	public function deleteItem($id)
	{
		$this->verifyLogin();
		$data['item']=$this->AssetKeeperModel->getItemById($id)->row_array();
		$headData['title'] = "Utilize Asset";
		$data['complaints']=$this->AssetKeeperModel->getAllComplaints()->result_array();
		
		$this->load->view('storeman/components/header', $headData);
		$this->load->view('storeman/page_contents/useFromInventory',$data);
		$this->load->view('storeman/components/footer');
	}
	public function copyToIssued($id)
	{
		$this->verifyLogin();
		$quantity = $this->input->post('item_quantity');
		$useDesc = $this->input->post('item_useDesc');
		$complaint=$this->input->post('complaint_id');
		$item_data=['usedin'=>$useDesc,'usedquantity'=>$quantity,'complaint_id'=>$complaint,'invID'=>$id];
		$this->AssetKeeperModel->issueItem($item_data);
		redirect('StoreMan/availableInventory');	
	}
	public function updateItem($id)
	{
		$this->verifyLogin();
		$name = trim($this->input->post('item_name'));
		$description = trim($this->input->post('item_description'));
		$quantity = trim($this->input->post('item_quantity'));
		$itemData=['id'=>$id,'name'=>$name,'description'=>$description,'quantity'=>$quantity];

		$result['add']=$this->AssetKeeperModel->updateItemData($itemData);
		redirect('StoreMan/availableInventory');
	}
	public function usedDetails($id=0)
	{
		$this->verifyLogin();
		$headData['title'] = "Issued Item Details";
		$this->load->view('storeman/components/header', $headData);
		$data['item']=$this->AssetKeeperModel->getIssuedById($id)->row_array();

		$this->load->view('storeman/page_contents/issued_item_details',$data);
		$this->load->view('storeman/components/footer');
	}
	public function itemDetailsWithHistory($id)
	{
		$this->verifyLogin();
		$headData['title']="Item History";
		$data['item'] = $this->AssetKeeperModel->getItemById($id)->row_array();
		$data['history']=$this->AssetKeeperModel->getItemUseHistory($id)->result_array();
		$data['added']=$this->AssetKeeperModel->getItemAdditionHistory($id)->result_array();

		$this->load->view('storeman/components/header', $headData);
		$this->load->view('storeman/page_contents/itemHistory',$data);
		$this->load->view('storeman/components/footer');	
	}
	public function updateQuantity()
	{
		$this->verifyLogin();
		$id=trim($this->input->get('iid'));
		$quantity=trim($this->input->get('update_quantity'));
		$remark=$this->input->get('remark');
		if(empty($remark)){
			$remark='No Remarks...';
		}
		$this->AssetKeeperModel->updateItemQuantity($id,$quantity,$remark);
		redirect('StoreMan/availableInventory');
	}
	public function usedInComplaint($complaint_id)
	{
		$this->verifyLogin();
		$headData['title']="Complaint";
		$data['cmp'] = $this->AssetKeeperModel->getComplaintById($complaint_id)->row_array();
		$uid=$this->AssetKeeperModel->getComplaintById($complaint_id)->row_array()['user_id'];
		$data['complainant']=$this->AssetKeeperModel->getComplainantById($uid)->row_array();

		$this->load->view('storeman/components/header', $headData);
		$this->load->view('storeman/page_contents/complaintDetails',$data);
		$this->load->view('storeman/components/footer');
	}
	public function deleteEntire()
	{
		$this->verifyLogin();
		$id=trim($this->input->post('did'));
		$this->AssetKeeperModel->removeItemFromInv($id);
		redirect('StoreMan/availableInventory');
	}
	public function restoreDeleted($id)
	{
		$this->verifyLogin();
		$this->AssetKeeperModel->restoreItem($id);
		redirect('StoreMan/availableInventory');
	}
	public function toAdmin()
	{
		redirect('Admin');
	}

}
?>