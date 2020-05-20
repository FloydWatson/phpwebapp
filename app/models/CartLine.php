<?php
  class CartLine {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCartLines(){

      $this->db->query('SELECT * FROM cart_line');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addCartLine($data){
      $this->db->query('INSERT INTO cart_line (product_id, quantity, cart_id, line_total) VALUES(:product_id, :quantity, :cart_id, :line_total)');
      // Bind values
      $this->db->bind(':product_id', $data['product_id']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':cart_id', $data['cart_id']);
      $this->db->bind(':line_total', $data['line_total']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateCartLine($data){
      $this->db->query('UPDATE cart_line SET product_id = :product_id, quantity = :quantity, cart_id = :cart_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':product_id', $data['product_id']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':cart_id', $data['cart_id']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getCartLineById($id){
      $this->db->query('SELECT * FROM cart_line WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getCartLinesByCartId($id){
      $this->db->query('SELECT * FROM cart_line WHERE cart_id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }



    public function deleteCartLine($id){
      $this->db->query('DELETE FROM cart_line WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteCartLineByCartId($id){
      $this->db->query('DELETE FROM cart_line WHERE cart_id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    
  }