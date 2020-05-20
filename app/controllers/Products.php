<?php
class Products extends Controller
{
  public function __construct()
  {


    // instantiate product
    $this->productModel = $this->model('Product');

    // instantiate brand
    $this->brandModel = $this->model('Brand');

    // instantiate category
    $this->categoryModel = $this->model('Category');

    $this->cartModel = $this->model('Cart');
    $this->cartLineModel = $this->model('CartLine');
  }

  public function index()
  {
    // Get products
    $products = $this->productModel->getProducts();

    // set data as products
    $data = [
      'products' => $products
    ];

    $this->view('products/index', $data);
  }

  // add new post
  public function add()
  {
    // this makes all forums only for logged in users
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    // Check for admin
    if (!$_SESSION['admin'] > 0) {
      redirect('pages');
    }
    $brands = $this->brandModel->getBrands();
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'name' => trim($_POST['name']),
        'quantity' => trim($_POST['quantity']),
        'price' => trim($_POST['price']),
        'description' => trim($_POST['description']),
        'image_link' => trim($_POST['image_link']),
        'brands' => $brands,
        'brand' => trim($_POST['brand']),
        'categories' => $categories,
        'category' => trim($_POST['category']),
        'name_err' => '',
        'quantity_err' => '',
        'price_err' => '',
        'description_err' => '',
        'image_link_err' => '',
        'brand_err' => '',
        'category_err' => ''
      ];

      // Validate data
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      }
      if (empty($data['quantity'])) {
        $data['quantity_err'] = 'Please enter quantity';
      }
      if (empty($data['price'])) {
        $data['price_err'] = 'Please enter price';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Please enter description';
      }
      if (empty($data['image_link'])) {
        $data['image_link_err'] = 'Please enter image link';
      }
      if ($data['brand'] === 'Choose...') {
        $data['brand_err'] = 'Please enter brand';
      }
      if ($data['category'] === 'Choose...') {
        $data['category_err'] = 'Please enter category';
      }

      // Make sure no errors
      if (empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err']) && empty($data['image_link_err']) && empty($data['brand_err']) && empty($data['category_err'])) {
        // Validated

        $brand = $this->brandModel->getBrandByName($data['brand']);
        $category = $this->categoryModel->getcategoryByName($data['category']);

        $newProduct = [
          'name' => $data['name'],
          'quantity' => $data['quantity'],
          'price' => $data['price'],
          'description' => $data['description'],
          'image_link' => $data['image_link'],
          'brand_id' => $brand->id,
          'category_id' => $category->id
        ];
        if ($this->productModel->addProduct($newProduct)) {
          flash('post_message', 'Product Added');
          redirect('products');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('products/add', $data);
      }
    } else {
      $data = [
        'name' => '',
        'quantity' => '',
        'price' => '',
        'description' => '',
        'image_link' => '',
        'brand' => '',
        'brands' => $brands,
        'category' => '',
        'categories' => $categories
      ];

      $this->view('products/add', $data);
    }
  }

  // very similar to add
  public function edit($id)
  {
    // this makes all forums only for logged in users
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    // Check for admin
    if (!$_SESSION['admin'] > 0) {
      redirect('pages');
    }
    $brands = $this->brandModel->getBrands();
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
        'name' => trim($_POST['name']),
        'quantity' => trim($_POST['quantity']),
        'price' => trim($_POST['price']),
        'description' => trim($_POST['description']),
        'image_link' => trim($_POST['image_link']),
        'brands' => $brands,
        'brand' => trim($_POST['brand']),
        'categories' => $categories,
        'category' => trim($_POST['category']),
        'name_err' => '',
        'quantity_err' => '',
        'price_err' => '',
        'description_err' => '',
        'image_link_err' => '',
        'brand_err' => '',
        'category_err' => ''
      ];

      // Validate data
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      }
      if (empty($data['quantity'])) {
        $data['quantity_err'] = 'Please enter quantity';
      }
      if (empty($data['price'])) {
        $data['price_err'] = 'Please enter price';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Please enter description';
      }
      if (empty($data['image_link'])) {
        $data['image_link_err'] = 'Please enter image link';
      }
      if ($data['brand'] === 'Choose...') {
        $data['brand_err'] = 'Please enter brand';
      }
      if ($data['category'] === 'Choose...') {
        $data['category_err'] = 'Please enter category';
      }

      // Make sure no errors
      if (empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err']) && empty($data['image_link_err']) && empty($data['brand_err']) && empty($data['category_err'])) {
        // Validated

        $brand = $this->brandModel->getBrandByName($data['brand']);
        $category = $this->categoryModel->getcategoryByName($data['category']);

        $newProduct = [
          'id' => $id,
          'name' => $data['name'],
          'quantity' => $data['quantity'],
          'price' => $data['price'],
          'description' => $data['description'],
          'image_link' => $data['image_link'],
          'brand_id' => $brand->id,
          'category_id' => $category->id
        ];

        if ($this->productModel->updateProduct($newProduct)) {
          flash('post_message', 'Product edited');
          redirect('products');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('products/edit', $data);
      }

      // show edit page. not a post request
    } else {
      // Get existing product from model
      $product = $this->productModel->getProductById($id);
      $brand = $this->brandModel->getBrandById($product->brand_id);
      $category = $this->categoryModel->getCategoryById($product->category_id);

      $data = [
        'id' => $id,
        'name' => $product->name,
        'quantity' =>  $product->quantity,
        'price' =>  $product->price,
        'description' =>  $product->description,
        'image_link' =>  $product->image_link,
        'brand' => $brand->name,
        'brands' => $brands,
        'category' => $category->name,
        'categories' => $categories,
      ];

      $this->view('products/edit', $data);
    }
  }

  public function show($id)
  {
    $product = $this->productModel->getProductById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $postData = [
        'product' => $product,
        'line_quantity' => trim($_POST['line_quantity']),
        'line_quantity_err' => '',
      ];

      if (empty($postData['line_quantity'])) {
        $postData['line_quantity_err'] = 'Please enter line_quantity';
      }


      // check product exists here

      // check line_quantity here
      if (empty($postData['line_quantity_err'])) {
        $data = [
          'product_id' => $id,
          'quantity' => floatval($postData['line_quantity']), // add dynamic variable
          'cart_id' => $_SESSION['cart_id'],
          'line_total' => ($product->price * floatval($postData['line_quantity']))

          //'categories' => $categories
        ];

        $this->cartLineModel->addCartLine($data);

        redirect('products/cart');
      } else {
        $this->view('products/productView', $postData);
      }
    } else {
      $data = [
        'product' => $product,
        'line_quantity' => 0,
        'line_quantity_err' => ''
      ];

      $this->view('products/productView', $data);
    }
  }

  public function cart()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $this->cartLineModel->deleteCartLineByCartId($_SESSION['cart_id']);

      redirect('pages/purchase');
    } else {
      $cart_lines =  $this->cartLineModel->getCartLinesByCartId($_SESSION['cart_id']);

      $cart_lines_data = [];

      $total = 0;

      foreach ($cart_lines as $cartLine) {
        array_push($cart_lines_data, [
          'name' => $this->productModel->getProductById($cartLine->product_id)->name,
          'quantity' => $cartLine->quantity,
          'total' => $cartLine->line_total
        ]);
        $total += $cartLine->line_total;
      }

      $cart_data = [
        'cart_lines' => $cart_lines_data,
        'total' => $total
      ];

      $this->view('products/cart', $cart_data);
    }
  }

  public function delete($id)
  {
    // this makes all forums only for logged in users
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    // Check for admin
    if (!$_SESSION['admin'] > 0) {
      redirect('pages');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Check for admin
      if (!$_SESSION['admin'] > 0) {
        redirect('pages/index');
      }


      if ($this->productModel->deleteProduct($id)) {
        flash('post_message', 'Product Removed');
        redirect('products');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('products');
    }
  }
}
