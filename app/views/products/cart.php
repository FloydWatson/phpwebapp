<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Cart</h1>
    </div>
    <div class="col-md-6">

    </div>
</div>
<!-- loop through products -->

<div class="card card-body mb-3">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sub Total</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['cart_lines'] as $cart_line) : ?>
                <tr>

                    <td><?php echo $cart_line['name']; ?></td>
                    <td><?php echo $cart_line['quantity']; ?></td>
                    <td>$<?php echo $cart_line['total']; ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            <tr>

                    <td></td>
                    <td></td>
                    <td>Order Total</td>
                    <td>$<?php echo $data['total']; ?></td>
                </tr>
        </tbody>
    </table>
   
    <hr>

    <div class="container">
        <form>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Region</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>Hawkes Bay</option>
                        <option>Not Hawkes Bay</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buy</button>
        </form>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>