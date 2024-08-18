<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\products;

$_product = new products();
$categories = $_product->getCategories();
$items = $_product->getItems();
$warehouses = $_product->getWarehouses();
$colors = $_product->getColors();
$sizes = $_product->getSizes();
$units = $_product->getUnits();
$product = $_product->edit();

?>
<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}
?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-5">Edit Product</h3>

            <form method="post" action="update.php" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <input type="hidden" class="form-control" name="id" value="<?= $product['id']; ?>" id="inputID">
                </div>

                <div class="mb-3 row">
                    <label for="inputPicture" class="col-sm-3 col-form-label">Image:</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="picture" id="inputPicture">
                        <img src="<?= $webroot ?>public/uploads/<?= $product['picture']; ?>"
                            alt="Can't find Product Image" class="img-fluid" height="200" width="300">

                        <input type="hidden" name="old_picture" value="<?= $product['picture']; ?>">
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="productName" class="col-sm-3 col-form-label">Product Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="product" value="<?= $product['product']; ?>"
                            id="productName" placeholder="Enter product name">
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="purchase_price" class="col-sm-3 col-form-label">Purchase Price:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0" class="form-control" name="purchase_price"
                            value="<?= $product['purchase_price']; ?>" id="purchase_price"
                            placeholder="Enter purchase price">
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="price" class="col-sm-3 col-form-label">Selling Price:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0" class="form-control" name="price" value="<?= $product['price']; ?>"
                            id="price" placeholder="Enter Selling price">
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="quantity" class="col-sm-3 col-form-label">Quantity:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0" class="form-control" name="quantity"
                            value="<?= $product['quantity']; ?>" id="quantity" placeholder="Enter quantity">
                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label for="inputColor" class="col-sm-3 col-form-label">Colors:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="color" id="inputColor"  value="<?= $color['color']; ?>">
                            <option value=<?= $product['color_id']; ?>> <?= $product['color']; ?></option>
                            <?php foreach ($colors as $color) { ?>
                                <?php if ($color['is_active'] == 1): ?>

                                    <option value="<?php echo $color['id']; ?>"><?php echo $color['color'] ?></option>

                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="inputSize" class="col-sm-3 col-form-label">Sizes:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="size" id="inputSize">
                            <option value="<?php echo $product['size_id'] ?>"> <?php echo $product['size'] ?> </option>
                            <?php foreach ($sizes as $size) { ?>
                                <?php if ($size['is_active'] == 1): ?>

                                    <option value="<?php echo $size['id']; ?>"><?php echo $size['size'] ?></option>

                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="form-group mb-3 row">
                    <label for="inputUnits" class="col-sm-3 col-form-label">Units:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="unit" id="inputUnits">
                            <option value="<?php echo $product['unit_id'] ?>"> <?php echo $product['unit'] ?> </option>
                            <?php foreach ($units as $unit) { ?>
                                <?php if ($unit['is_active'] == 1): ?>

                                    <option value="<?php echo $unit['id']; ?>"><?php echo $unit['unit'] ?></option>

                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="form-group mb-3 row">
                    <label for="inputItem" class="col-sm-3 col-form-label">Items:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="item" id="inputItem">
                        <option value="<?php echo $product['item_id'] ?>"> <?php echo $product['item'] ?> </option>
                            <?php foreach ($items as $item) { ?>
                                <?php if ($item['is_active'] == 1): ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['item'] ?></option>
                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="inputCategory" class="col-sm-3 col-form-label">Category:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="category" id="inputCategory">
                        <option value="<?php echo $product['category_id'] ?>"> <?php echo $product['category'] ?> </option>
                            <?php foreach ($categories as $category) { ?>
                                <?php if ($category['is_active'] == 1): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['category'] ?>
                                    </option>
                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="form-group mb-3 row">
                    <label for="inputWarehouse" class="col-sm-3 col-form-label">Warehouse:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="warehouse" id="inputWarehouse">
                            <option value="<?php echo $product['warehouse_id'] ?>"> <?php echo $product['warehouse'] ?> </option>
                            <?php foreach ($warehouses as $warehouse) { ?>
                                <?php if ($warehouse['is_active'] == 1): ?>

                                    <option value="<?php echo $warehouse['id']; ?>"><?php echo $warehouse['warehouse'] ?>
                                    </option>

                                <?php endif; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="mb-3 row form-check">
                    <div class="col-sm-10">
                        <?php if ($product['is_active'] == 0): ?>
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="inputIsActive">
                        <?php else: ?>
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" checked
                                id="inputIsActive">
                        <?php endif; ?>

                    </div>
                    <label for="inputIsActive" class="col-sm-3 form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>

        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>