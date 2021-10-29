<?php session_start();?>
<?php 
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if(isset($_SESSION['login'])){
        header("location:../vegetable/index.php");
    }else{
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="/shop/css/bootstrap.min.css">
    <link rel="stylesheet" href="/shop/css/bootstrap.css">
    <link rel="stylesheet" href="/shop/css/style.css">
    <link rel="stylesheet" href="/shop/css/responsive.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-300">
            <div  style="width:500px; margin-top:50px;">
                
                <div class="card-body">
                <h3>Login</h3>
                    <form action="./checkLogin.php" method="POST">
                        <div class=" form-group">
                            <label for="user">Your's ID</label>
                            <input id="user" type="text" name="username"
                                value='<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo ""; ?>'
                                class="form-control" placeholder="Your's ID" required>

                        </div>
                        <?php if(isset($_SESSION["idInvaild"])){?>
                        <div class="form-group">
                            <label><?php echo $_SESSION["idInvaild"]; ?></label>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input id="pass" type="password" name="password" class="form-control" placeholder="Password"
                                required>
                        </div>
                        <?php if(isset($_SESSION["passInvaild"])){?>
                        <div class="input-group form-group">
                            <label><?php echo $_SESSION["passInvaild"]; ?></label>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <input type="submit" name="login" value="Login" class="btn  btn-info" />
                            <a class="btn  btn-info" href="/shop/customer/register.php">Sign Up</a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>