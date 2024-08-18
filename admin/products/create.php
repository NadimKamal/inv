<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}


include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");
use App\products;

$_product = new products();
$categories = $_product->getCategories();
$items = $_product->getItems();
$warehouses = $_product->getWarehouses();
$colors = $_product->getColors();
$sizes = $_product->getSizes();
$units = $_product->getUnits();

?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8">
                <h3 class="text-center mb-5">Add New Product</h3>

                <form method="post" action="store.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="inputPicture" class="form-label">Image:</label>
                                <input type="file" class="form-control" name="picture" id="inputPicture">
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" name="product" id="productName"
                                    placeholder="Enter product name">
                            </div>

                            <div class="mb-3">
                                <label for="purchase_price" class="form-label">Purchase Price:</label>
                                <input type="number" min="0" class="form-control" name="purchase_price"
                                    id="purchase_price" placeholder="Enter purchase price">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Selling Price:</label>
                                <input type="number" min="0" class="form-control" name="price" id="price"
                                    placeholder="Enter price">
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" min="0" class="form-control" name="quantity" id="quantity"
                                    placeholder="Enter quantity">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" name="description" id="description" rows="3"
                                    placeholder="Enter description"></textarea>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="mb-3">
                                <label for="inputColor" class="form-label">Colors:</label>
                                <select class="form-control" name="color" id="inputColor">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($colors as $color) { ?>
                                        <?php if ($color['is_active'] == 1 ): ?>
                                        
                                        <option value="<?php echo $color['id']; ?>"><?php echo $color['color'] ?></option>
                                        
                                        <?php endif; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="inputSize" class="form-label">Sizes:</label>
                                <select class="form-control" name="size" id="inputSize">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($sizes as $size) { ?>
                                        <?php if ($size['is_active'] == 1 ): ?>

                                        <option value="<?php echo $size['id']; ?>"><?php echo $size['size'] ?></option>
                                        
                                        <?php endif; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="inputUnits" class="form-label">Units:</label>
                                <select class="form-control" name="unit" id="inputUnits">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($units as $unit) { ?>
                                        <?php if ($unit['is_active'] == 1 ): ?>

                                        <option value="<?php echo $unit['id']; ?>"><?php echo $unit['unit'] ?></option>

                                        <?php endif; ?>

                                    <?php } ?>
                                </select>
                            </div>
  
                            <div class="mb-3">
                                <label for="inputItem" class="form-label">Items:</label>
                                <select class="form-control" name="item" id="inputItem">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($items as $item) { ?>
                                        <?php if ($item['is_active'] == 1 ): ?>

                                        <option value="<?php echo $item['id']; ?>"><?php echo $item['item'] ?></option>

                                        <?php endif; ?>

                                    <?php } ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Category:</label>
                                <select class="form-control" name="category" id="inputCategory">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <?php if ($category['is_active'] == 1 ): ?>

                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category'] ?>
                                        </option>
                                        <?php endif; ?>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="inputWarehouse" class="form-label">Warehouse:</label>
                                <select class="form-control" name="warehouse" id="inputWarehouse">
                                    <option value="">~ Select Any One ~</option>
                                    <?php foreach ($warehouses as $warehouse) { ?>
                                        <?php if ($warehouse['is_active'] == 1 ): ?>

                                        <option value="<?php echo $warehouse['id']; ?>"><?php echo $warehouse['warehouse'] ?>
                                        </option>

                                        <?php endif; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                    id="inputIsActive">
                                <label for="inputIsActive" class="form-check-label">Active</label>
                            </div>
                            
                        </div>
                    </div>

                    <button type="submit" class="btn btn-secondary">Submit</button>

                </form>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>



