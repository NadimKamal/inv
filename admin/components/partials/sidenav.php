<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/index.php'; ?>"><i
                    class="fa-solid fa-gauge"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/items/index.php'; ?>"><i
                    class="fa fa-cubes"></i> Items</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories/index.php' ?>"><i
                    class="fa fa-th"></i> Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/warehouses/index.php' ?>"><i
                    class="fa-solid fa-building-columns"></i>
                Warehouse</a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"> <i class="fa-solid fa-cube"></i>
                Elements
            </a>
            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/colors/index.php' ?>">Color</a>
                </li>
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/sizes/index.php' ?>">Size</a>
                </li>
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/units/index.php' ?>">Unit</a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"> <i class="fa-solid fa-cube"></i>
                Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/create.php' ?>">Create
                        Product</a>
                </li>
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/index.php' ?>">Manage
                        Product</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa-solid fa-dollar-sign"></i>
                Sells
            </a>
            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/create.php' ?>">Add
                        Sell</a></li>
                <li><a class="dropdown-item"
                        href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/index.php' ?>">Manage
                        Sells</a></li>
            </ul>
        </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-users"></i>
                    Members
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        <?php if ($_SESSION['role_id'] === 1) { ?>
                    <li><a class="dropdown-item"
                            href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/create.php' ?>">Add
                            Members</a></li>
                                    <?php } ?>
                    <li><a class="dropdown-item"
                            href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/index.php' ?>">Manage
                            Members</a></li>
                </ul>
            </li>

        <?php if ($_SESSION['role_id'] === 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/roles/index.php' ?>"><i
                        class="fa fa-th"></i> Roles</a>
            </li>
        <?php } ?>



        <li class="nav-item">
            <a class="nav-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/reports/index.php' ?>"><i
                    class="fa-solid fa-file"></i>
                Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/logout.php' ?>"><i
                    class="fa fa-power-off"></i> Logout</a>
        </li>
    </ul>
</div>