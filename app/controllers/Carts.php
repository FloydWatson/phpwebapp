<?php
  class Carts extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }

      // instantiate category
      $this->cartModel = $this->model('Cart');
      $this->cartLineModel = $this->model('CartLine');
    }

    public function index(){
      // Get categories
      //$categories = $this->cartModel->getCategories();
      $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
      $cartLines = $this->cartLinewModel->getCartLinesByCartId($cart->id);

      // set data as categories
      $data = [
          'cart' => $cart,
          'cartLines' => $cartLines
        //'categories' => $categories
      ];

      //$this->view('categories/index', $data);
    }

    public function addCartLine($product_id){

        // check quantity here

        $data = [
          'product_id' => $product_id,
          'quantity' => 1, // add dynamic variable
          'cart_id' => $_SESSION['cart_id']
          
        //'categories' => $categories
      ];

      $this->cartLineModel->addCartLine($data);


    }

   

  }