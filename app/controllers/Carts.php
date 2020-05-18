<?php
  class Categories extends Controller {
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

    // add new post
    // public function add(){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     // Sanitize POST array
    //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //     $data = [
    //       'name' => trim($_POST['name']),
    //       'name_err' => ''

    //     ];

    //     // Validate data
    //     if(empty($data['name'])){
    //       $data['name_err'] = 'Please enter name';
    //     }


    //     // Make sure no errors
    //     if(empty($data['name_err'])){
    //       // Validated
    //       if($this->cartModel->addCategory($data)){
    //         flash('post_message', 'Category Added');
    //         redirect('categories');
    //       } else {
    //         die('Something went wrong');
    //       }
    //     } else {
    //       // Load view with errors
    //       $this->view('categories/add', $data);
    //     }

    //   } else {
    //     $data = [
    //       'name' => '',
    //     ];
  
    //     $this->view('categories/add', $data);
    //   }
    // }

    // // very similar to add
    // public function edit($id){
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //   // Sanitize POST array
    //   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //   $data = [
    //     'id' => $id,
    //     'name' => trim($_POST['name']),
    //     'name_err' => ''

    //   ];

    //   // Validate data
    //   if(empty($data['name'])){
    //     $data['name_err'] = 'Please enter name';
    //   }


    //     // Make sure no errors
    //     if(empty($data['name_err'])){
    //         // Validated
    //         if($this->cartModel->updateCategory($data)){
    //           flash('post_message', 'Category edited');
    //           redirect('categories');
    //         } else {
    //           die('Something went wrong');
    //         }
    //       } else {
    //         // Load view with errors
    //         $this->view('categories/edit', $data);
    //       }

    //   // show edit page. not a post request
    //   } else {
    //     // Get existing category from model
    //     $category = $this->cartModel->getCategoryById($id);


    //     $data = [
    //       'id' => $id,
    //       'name' => $category->name,
    //     ];
  
    //     $this->view('categories/edit', $data);
    //   }
    // }

    // public function show($id){
    //   $category = $this->cartModel->getCategoryById($id);

    //   $data = [
    //     'category' => $category,
    //   ];

    //   $this->view('categories/show', $data);
    // }

    // public function delete($id){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //       // Check for admin
    //     if(!$_SESSION['admin'] > 0){
    //         redirect('pages/index');
    //     }


    //     if($this->cartModel->deleteCategory($id)){
    //       flash('post_message', 'Category Removed');
    //       redirect('categories');
    //     } else {
    //       die('Something went wrong');
    //     }
    //   } else {
    //     redirect('categories');
    //   }
    // }

  }