<?php
    class AssetKeeperModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function getAvailableItemsCount()
        {   
            $this->db->where('deleted',0);
            return $this->db->get('inventory')->num_rows();
        }
        public function getAllData()
        {
            $this->db->where('deleted',0);
            return $this->db->get('inventory');
        }
        public function addNewItem($item,$remark)
        {
            $this->db->insert('inventory', $item) ? $this->session->set_flashdata('success',"Item Added successfully!") : $this->session->set_flashdata('errors',"Unsuccessfull...!");
            $this->db->insert('added_to_inv',['added_quantity'=>$item['quantity'],'inv_id'=>$this->db->insert_id(),'remark'=>$remark]);
        }
        public function getItemById($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('inventory');
        }
        public function issueItem($item_data)
        {
            $current_quantity=$this->getItemById($item_data['invID'])->row_array()['quantity'];

            if($current_quantity>=$item_data['usedquantity'])
            {
                $new_quantity=$current_quantity-$item_data['usedquantity'];
                $this->db->select('*');
		        $this->db->from('inventory');
                $this->db->set('quantity',$new_quantity);
                $this->db->where('id',$item_data['invID']);
                $this->db->update();

                $this->db->insert('used_inv',$item_data);
            }
            else
            {
                $this->session->set_flashdata('errors','Not enough quantity in inventory...');
            }
            $this->db->where('deleted',0);
            return $this->db->get('inventory');
        }
        public function getIssuedData()
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->join('used_inv', 'inventory.id = used_inv.invID');
            return $this->db->get();
        }
        public function getIssuedById($id)
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->join('used_inv', 'inventory.id = used_inv.invID');
            $this->db->where('used_inv.id',$id);
            return $this->db->get();
        }
        public function updateItemData($item_data)
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->set('name',$item_data['name']);
            $this->db->set('description',$item_data['description']);
            $this->db->set('quantity',$item_data['quantity']);
            $this->db->where('id',$item_data['id']);
            $this->db->update();
            
        }
        public function getItemUseHistory($id)
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->join('used_inv', 'inventory.id = used_inv.invID');
            $this->db->where('invID',$id);
            return $this->db->get();
        }
        public function getAllComplaints()
        {
            $this->db->select('complaint.*, department.dept_name');
		    $this->db->from('complaint');
		    $this->db->join('department', 'complaint.department_id = department.id');
            $this->db->order_by("complaint_id", "desc");
            return $this->db->get();
        }
        public function getComplaintById($complaint_id)
        {
            $this->db->select('complaint.*, department.dept_name');
		    $this->db->from('complaint');
		    $this->db->join('department', 'complaint.department_id = department.id');
            $this->db->where('complaint_id',$complaint_id);
            return $this->db->get();
        }
        public function getComplainantById($id)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id',$id);
            return $this->db->get();
        }
        public function getInvItemById($id)
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->where('deleted',0);
            $this->db->where('id',$id);
            return $this->db->get();
        }
        public function updateItemQuantity($id,$add_quantity,$remark)
        {
            $old_quantity=$this->getInvItemById($id)->row_array()['quantity'];
            $new_quantity=$old_quantity+$add_quantity;
            if($add_quantity>0)
            {
                $this->db->select('*');
                $this->db->from('inventory');
                $this->db->set('quantity',$new_quantity);
                $this->db->where('id',$id);
                $this->db->update();

                $this->db->insert('added_to_inv',['added_quantity'=>$add_quantity,'inv_id'=>$id,'remark'=>$remark]);
                $this->session->set_flashdata('success','Quantity updated successfully');
            } 
            else
            {
                $this->session->set_flashdata('errors','Quantity updation Unsuccessfull!');
            }
        }
        public function removeItemFromInv($id)
        {
            $this->createDate = date("Y-m-d H:i:s");

            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->where('id', $id);
            $this->db->set('created_at',$this->createDate);
            $this->db->set('deleted',1);
            $this->db->update() ? $this->session->set_flashdata('success',"Item removed successfully!") : $this->session->set_flashdata('errors',"Item cannot be deleted...!");
        }
        public function getItemAdditionHistory($id)
        {
            $this->db->where('inv_id',$id);
            return $this->db->get('added_to_inv');
        }
        public function getRestoreable()
        {
            $this->db->where('deleted',1);
            return $this->db->get('inventory');
        }
        public function restoreItem($id)
        {
            $this->db->select('*');
            $this->db->from('inventory');
            $this->db->where('id',$id);
            $this->db->set('deleted',0);
            $this->db->set('created_at',date("Y-m-d H:i:s"));
            $this->db->update() ? $this->session->set_flashdata('success',"Item restored successfully!") : $this->session->set_flashdata('errors',"Item can not be restored...!");
        }
    }
?>