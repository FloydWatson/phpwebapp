<?php
  class Product {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getProducts(){
      //$this->db->query('SELECT * FROM posts');
      $this->db->query('SELECT * FROM products');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addProduct($data){
      $this->db->query('INSERT INTO products (name, quantity, price, description, image_link, brand_id, category_id) VALUES(:name, :quantity, :price, :description, :image_link, :brand_id, :category_id)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':image_link', $data['image_link']);
      $this->db->bind(':brand_id', $data['brand_id']);
      $this->db->bind(':category_id', $data['category_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateProduct($data){
      $this->db->query('UPDATE products SET name = :name, quantity = :quantity, price = :price, description = :description, image_link = :image_link, brand_id = :brand_id, category_id = :category_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':image_link', $data['image_link']);
      $this->db->bind(':brand_id', $data['brand_id']);
      $this->db->bind(':category_id', $data['category_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getProductById($id){
      $this->db->query('SELECT * FROM products WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getProductByCategoryId($id){
      $this->db->query('SELECT * FROM products WHERE category_id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }

    public function getProductByBrandId($id){
      $this->db->query('SELECT * FROM products WHERE brand_id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }


    public function deleteProduct($id){
      $this->db->query('DELETE FROM products WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getProductBySearch($text){


      $this->db->query('SELECT * FROM products WHERE description LIKE :text AND price BETWEEN :min AND :max ');
      $this->db->bind(':text', '%'.$text['text_search'].'%');
      $this->db->bind(':min', $text['min_price_search'] === '' ? 0 : $text['min_price_search']);
      $this->db->bind(':max', $text['max_price_search'] === '' ? 99999999 : $text['max_price_search']);

      $results = $this->db->resultSet();

      return $results;
    }
  }