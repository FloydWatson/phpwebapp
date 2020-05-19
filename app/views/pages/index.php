<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-3" style="width: 18rem;">
    <h4>Categories</h4>

    <hr>
    <?php foreach ($data['categories'] as $category) : ?>


      <a href="#"><?php echo $category->name; ?></a>
      <hr>

    <?php endforeach; ?>
    <h4>Brands</h4>
    <hr>
    <?php foreach ($data['brands'] as $brand) : ?>


      <a href="#"><?php echo $brand->name; ?></a>
      <hr>

    <?php endforeach; ?>
  </div>
  <div class="col">

    <div class="jumbotron jumbotron-flud text-center">
      <div class="container">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
      </div>
    </div>


    <div class="home-grid-area">
      <?php foreach ($data['products'] as $product) : ?>

        <div class="card">
          <img class="card-img-top" src="<?php echo $product->image_link; ?>" alt="momJeans" />
          <div class="card-body">
            <h5 class="card-title"><?php echo $product->name; ?></h5>
            <p class="card-text"><?php echo $product->description; ?></p>
            <?php if (isset($_SESSION['user_id'])) : ?>
             
              <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" class="btn btn-primary">Add to cart</a>
            <?php else : ?>

              <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" class="btn btn-primary">Login to add to cart</a>
            <?php endif; ?>
          </div>
        </div>


      <?php endforeach; ?>
    </div>

  </div>


  <?php require APPROOT . '/views/inc/footer.php'; ?>