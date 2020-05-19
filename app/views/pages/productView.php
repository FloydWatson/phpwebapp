<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="product-view-container">

        <div class="product-view-image">
            <img class="product-img" src="<?php echo $data['product']->image_link; ?>" alt="." />
        </div>
        <div class="product-view-details">
            <div class="product-view-title">
                <h1><?php echo $data['product']->name; ?></h1>

            </div>

            <div class="product-view-add-cart">
                <form class="product-view-select-box" action="<?php echo URLROOT; ?>/carts/addcartline/<?php echo $data['product']->id; ?>" method="post">
                    <div class="form-group col-md-6">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" value="<?php echo $data['quantity']; ?>">
                    </div>

                    <div class="form-group  flex-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> <small>add to cart</small></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="product-view-description">
            <p><?php echo $data['product']->description; ?></p>
        </div>
    </div>
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>