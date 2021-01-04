<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {

    function get($id= null)
    {
        $this->db->from('t_stock');
        if($id != null){
            $this->db->where('stock_id',$id);
        }
        $query = $this->db->get();
        return $query;

    }
    //in

    function get_stock_in()
    {
        $this->db->select(' p_item.barcode ,  p_item.name as item_name , p_item.item_id,
        qty, date, detail,stock_id,
        supplier.name as supplier_name ');
        $this->db->from('t_stock');
        $this->db->join('p_item', 't_stock.item_id = p_item.item_id');
        $this->db->join('supplier', 't_stock.supplier_id = supplier.supplier_id','left');
        $this->db->where('type','in');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }
    
    function add_stock_in($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier_id'] =='' ? null :$post['supplier_id'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('t_stock', $params);
    }

    function del($id)
    {
        $this->db->where('stock_id',$id);
        $this->db->delete('t_stock');
    }

    //out
    function get_stock_out()
    {
        $this->db->select(' p_item.barcode ,  p_item.name as item_name , p_item.item_id,
        qty, date, detail,stock_id,
        supplier.name as supplier_name ');
        $this->db->from('t_stock');
        $this->db->join('p_item', 't_stock.item_id = p_item.item_id');
        $this->db->join('supplier', 't_stock.supplier_id = supplier.supplier_id','left');
        $this->db->where('type','out');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }
    
    function add_stock_out($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier_id'] =='' ? null :$post['supplier_id'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('t_stock', $params);
    }



}