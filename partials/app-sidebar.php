<?php 
$user = $_SESSION['user'] ?>

<div class="dashboard_sidebar" id="dashboard_sidebar">
<h3 class="dashboard_logo" id="dashboard_logo">Retactics</h3>
<div class="dashboard_sidebar_user">
    <img src="img/profile_picture.png" alt="User Image" id="userImage" />
    <span><?= $user ['first_name']. ' ' . $user['last_name']?></span>
</div>
<div class="dashboard_sidebar_menus">
    <ul class="dashboard_menu_lists">
        <!-- class="menuActive" -->
        <li class="liMainmenu">
            <a href="./dashboard.php"><i class="fa fa-dashboard"></i><span class="menuText">Dashboard</span></a>
        </li>
         <li class="liMainmenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-tag showHideSubMenu"></i>
                <span class="menuText showHideSubMenu">Products</span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i></a>

            <ul class="subMenus">
                <li><a class="subMenuLink" href="./product-view.php" style="background: #265757;"><i class="fa fa-circle-o"> View Product</i></a></li>
                <li><a class="subMenuLink" href="./product-add.php" style="background: #265757;"><i class="fa fa-circle-o"> Add Product</i></a></li>
            </ul>
        </li>
         <li class="liMainmenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-truck showHideSubMenu"></i>
                <span class="menuText showHideSubMenu">Suppliers</span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i></a>

            <ul class="subMenus">
                <li><a class="subMenuLink" href="./supplier-view.php" style="background: #265757;"><i class="fa fa-circle-o"> View Suppliers</i></a></li>
                <li><a class="subMenuLink" href="./supplier-add.php" style="background: #265757;"><i class="fa fa-circle-o"> Add Supplier</i></a></li>
            </ul>
        </li>
        <li class="liMainmenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-shopping-cart showHideSubMenu"></i>
                <span class="menuText showHideSubMenu">Purchase Order</span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i></a>

            <ul class="subMenus">
                <li><a class="subMenuLink" href="./product-order.php" style="background: #265757;"><i class="fa fa-circle-o"> Create Order</i></a></li>
                <li><a class="subMenuLink" href="./view-order.php" style="background: #265757;"><i class="fa fa-circle-o"> View Orders</i></a></li>
            </ul>
        </li>
        <li class="liMainmenu showHideSubMenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-user-plus showHideSubMenu"></i>
                <span class="menuText showHideSubMenu">Users</span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" style="float: right;"></i></a>

            <ul class="subMenus">
                <li><a class="subMenuLink" href="./users-view.php" style="background: #265757;"><i class="fa fa-circle-o"> View Users</i></a></li>
                <li><a class="subMenuLink" href="./users-add.php" style="background: #265757;"><i class="fa fa-circle-o"> Add User</i></a></li>
            </ul>
        </li>
    </ul>
</div>
</div>
