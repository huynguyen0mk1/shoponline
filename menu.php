<?php if(isset($_SESSION['login']))
{?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-default main-navbar navbar-custom ">
    <div class="collapse navbar-collapse">
        <div class="col-7"></div>
        <ul class="navbar-nav mr-auto float-right  col-5">
            <li class="nav-item text-light" style="margin-left: 15px;"><a href="index.php" class="nav-link float-right  text-light">Market Online</a>
            </li>
            <li class="nav-item text-light"  style="margin-left: 15px;"><a href="/shop/vegetable/index.php" class=" text-light nav-link float-right">Vegetable</a>
            </li>
            <li class="nav-item text-light" style="margin-left: 15px;"><a href="/shop/cart/index.php" class="nav-link text-light float-right">Cart</a>
            </li>
            <li class="nav-item text-light" style="margin-left: 15px;"><a href="/shop/cart/history.php" class="nav-link text-light float-right">History</a>
            </li>
            <li class="nav-item text-light" style="margin-left: 15px;"><a href="/shop/customer/logout.php" class="nav-link  text-light float-right">Logout</a>
            </li>
            <li class="nav-item" style="margin-left: 15px;"><a class="btn btn-info"><?php echo htmlentities($_SESSION['login']);?></a>
            </li>
        </ul>
    </div>
</nav>

<?php } else {?>

<nav class="navbar navbar-expand-lg bg-dark navbar-default main-navbar navbar-custom">
    <div class="collapse navbar-collapse">
        <div class="col-sm-8"></div>
        <ul class="navbar-nav mr-auto float-right col-sm-4">
            <li class="nav-item  text-light" style="margin-left: 15px;"><a href="index.php" class="nav-link float-right  text-light">Market Online</a>
            </li>
            <li class="nav-item  text-light" style="margin-left: 15px;"><a href="/shop/vegetable/index.php" class="nav-link text-light float-right">Vegetable</a>
            </li>
            <li class="nav-item  text-light" style="margin-left: 15px;"><a href="/shop/cart/index.php" class="nav-link text-light float-right">Cart</a>
            </li>
            <li class="nav-item  text-light" style="margin-left: 15px;"><a href="/shop/customer/login.php" class="nav-link text-light float-right">Login</a>
            </li>
        </ul>
    </div>
</nav>
<?php }?>