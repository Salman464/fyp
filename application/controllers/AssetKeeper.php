<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AssetKeeper extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->verifyLogin();
		$this->load->model('AssetKeeperModel');	
	}
    public function index()
	{
		$this->verifyLogin();
		$headData['title'] = "AssetKeeper Dashboard";
		$data['allcount'] = $this->AssetKeeperModel->getAvailableItemsCount();

			$this->load->view('asset_keeper/components/header', $headData);
			$this->load->view('asset_keeper/page_components/dashboard',$data);
			$this->load->view('asset_keeper/components/footer');

	}
	private function verifyLogin()
	{
		if (!( $this->session->userdata('logged_in') === TRUE && ($this->session->userdata('user_type') === '7' || $this->session->userdata('user_type') === '1'|| $this->session->userdata('user_type') === '4'))){
			redirect('Login');
		}
	}
	public function profile()
	{
		$this->verifyLogin();
			$headData['title'] = "Profile";
			$this->load->view('asset_keeper/components/header', $headData);
			 $this->load->view('asset_keeper/page_components/profile');
			 $this->load->view('asset_keeper/components/footer');
	}
	public function availableInventory()
	{
		$this->verifyLogin();
			$headData['title'] = "Assets Inventory";
			$this->load->view('asset_keeper/components/header', $headData);

			$data['items']=($this->AssetKeeperModel->getAllData())->result_array();
			$data['restoreable']=$this->AssetKeeperModel->getRestoreable()->result_array();

			 $this->load->view('asset_keeper/page_components/available',$data);
			 $this->load->view('asset_keeper/components/footer');
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
		redirect('AssetKeeper/availableInventory');
	}
	public function editItem($id)
	{
		$this->verifyLogin();
		$data['item']=$this->AssetKeeperModel->getItemById($id)->row_array();
		$headData['title'] = "Update Item";
		
		$this->load->view('asset_keeper/components/header', $headData);
		$this->load->view('asset_keeper/page_components/edit_inventory',$data);
		$this->load->view('asset_keeper/components/footer');	
	}
	public function deleteItem($id)
	{
		$this->verifyLogin();
		$data['item']=$this->AssetKeeperModel->getItemById($id)->row_array();
		$headData['title'] = "Utilize Asset";
		$data['complaints']=$this->AssetKeeperModel->getAllComplaints()->result_array();
		
		$this->load->view('asset_keeper/components/header', $headData);
		$this->load->view('asset_keeper/page_components/useFromInventory',$data);
		$this->load->view('asset_keeper/components/footer');
	}
	public function copyToIssued($id)
	{
		$this->verifyLogin();
		$quantity = $this->input->post('item_quantity');
		$useDesc = $this->input->post('item_useDesc');
		$complaint=$this->input->post('complaint_id');
		$item_data=['usedin'=>$useDesc,'usedquantity'=>$quantity,'complaint_id'=>$complaint,'invID'=>$id];
		$this->AssetKeeperModel->issueItem($item_data);
		redirect('AssetKeeper/availableInventory');	
	}
	public function updateItem($id)
	{
		$this->verifyLogin();
		$name = trim($this->input->post('item_name'));
		$description = trim($this->input->post('item_description'));
		$quantity = trim($this->input->post('item_quantity'));
		$itemData=['id'=>$id,'name'=>$name,'description'=>$description,'quantity'=>$quantity];

		$result['add']=$this->AssetKeeperModel->updateItemData($itemData);
		redirect('AssetKeeper/availableInventory');
	}
	public function usedDetails($id=0)
	{
		$this->verifyLogin();
		$headData['title'] = "Issued Item Details";
		$this->load->view('asset_keeper/components/header', $headData);
		$data['item']=$this->AssetKeeperModel->getIssuedById($id)->row_array();

		$this->load->view('asset_keeper/page_components/issued_item_details',$data);
		$this->load->view('asset_keeper/components/footer');
	}
	public function itemDetailsWithHistory($id)
	{
		$this->verifyLogin();
		$headData['title']="Item History";
		$data['item'] = $this->AssetKeeperModel->getItemById($id)->row_array();
		$data['history']=$this->AssetKeeperModel->getItemUseHistory($id)->result_array();
		$data['added']=$this->AssetKeeperModel->getItemAdditionHistory($id)->result_array();

		$this->load->view('asset_keeper/components/header', $headData);
		$this->load->view('asset_keeper/page_components/itemHistory',$data);
		$this->load->view('asset_keeper/components/footer');	
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
		redirect('AssetKeeper/availableInventory');
	}
	public function usedInComplaint($complaint_id)
	{
		$this->verifyLogin();
		$headData['title']="Complaint";
		$data['cmp'] = $this->AssetKeeperModel->getComplaintById($complaint_id)->row_array();
		$uid=$this->AssetKeeperModel->getComplaintById($complaint_id)->row_array()['user_id'];
		$data['complainant']=$this->AssetKeeperModel->getComplainantById($uid)->row_array();

		$this->load->view('asset_keeper/components/header', $headData);
		$this->load->view('asset_keeper/page_components/complaintDetails',$data);
		$this->load->view('asset_keeper/components/footer');
	}
	public function deleteEntire()
	{
		$this->verifyLogin();
		$id=trim($this->input->post('did'));
		$this->AssetKeeperModel->removeItemFromInv($id);
		redirect('AssetKeeper/availableInventory');
	}
	public function restoreDeleted($id)
	{
		$this->verifyLogin();
		$this->AssetKeeperModel->restoreItem($id);
		redirect('AssetKeeper/availableInventory');
	}
	public function backToAdmin()
	{
		if( $this->session->userdata('logged_in') === TRUE && $this->session->userdata('user_type') === '1'){
			redirect('Admin');
		}
		$this->index();
	}
	public function backToStore()
	{
		if( $this->session->userdata('logged_in') === TRUE && $this->session->userdata('user_type') === '4'){
			redirect('StoreMan');
		}
		$this->index();
	}
}
?>