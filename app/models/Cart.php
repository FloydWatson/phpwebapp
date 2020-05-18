<?php
class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkUserHasCart()
    {
        $this->db->query('SELECT * FROM cart WHERE user_id = :id');
        $this->db->bind(':id', $_SESSION['user_id']);

        $row = $this->db->single();
        

        if($this->db->rowCount() > 0){
            $results = $this->getCartByUserId($_SESSION['user_id']);
        } else {
            $this->addCart($_SESSION['user_id']);
            $results = $this->getCartByUserId($_SESSION['user_id']);
        }
        return $results;
    }

    public function getCarts()
    {

        $this->db->query('SELECT * FROM cart');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addCart($id)
    {
        $this->db->query('INSERT INTO cart (`user_id`) VALUES(:id)');
        // Bind values
        $this->db->bind(':id', $id);



        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCart($data)
    {
        $this->db->query('UPDATE cart SET user_id = :user_id WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);



        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCartById($id)
    {
        $this->db->query('SELECT * FROM cart WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function getCartByUserId($id)
    {
        $this->db->query('SELECT * FROM cart WHERE user_id = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        return $results;
    }



    public function deleteCart($id)
    {
        $this->db->query('DELETE FROM cart WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
