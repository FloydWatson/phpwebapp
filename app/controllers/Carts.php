<?php
class Carts extends Controller
{
  public function __construct()
  {
    // this makes all forums only for logged in users
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    // instantiate category
    $this->cartModel = $this->model('Cart');
    $this->cartLineModel = $this->model('CartLine');
    $this->productModel = $this->model('Product');
  }

  public function index()
  {
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

  public function addCartLine($product_id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // check product exists here

      $product = $this->productModel->getProductById($product_id);
      // check quantity here

      $data = [
        'product_id' => $product_id,
        'quantity' => trim($_POST['quantity']), // add dynamic variable
        'cart_id' => $_SESSION['cart_id'],
        'line_total' => $product->price * trim($_POST['quantity'])

        //'categories' => $categories
      ];

      $this->cartLineModel->addCartLine($data);
    }
  }
}
