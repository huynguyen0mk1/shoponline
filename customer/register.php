<?php session_start();?>
<?php 
    if(isset($_SESSION['login'])){
        header("location:../vegetable/index.php");
    }else{
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="/shop/css/bootstrap.min.css">
    <link rel="stylesheet" href="/shop/css/bootstrap.css">
    <link rel="stylesheet" href="/shop/css/style.css">
    <link rel="stylesheet" href="/shop/css/responsive.css">
</head>

<body>
    <div class="container ">
        <div class="row">

            <form action="./saveRegister.php" method="POST" class="col-md-8 ">
                <div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3>Register</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FullName">Full Name</label>
                                        <input type="text" id="FullName" name="fname" class="form-control"
                                            placeholder="Enter Full Name"
                                            value='<?php if(isset($_SESSION['fname'])) echo $_SESSION['fname']; else echo ""; ?>'
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group"><label for="pass">Password</label>
                                        <input id="pass" type="password" name="password" class="form-control"
                                            placeholder="Enter Password"
                                            value='<?php if(isset($_SESSION['password'])) echo $_SESSION['password']; else echo ""; ?>'
                                            required>
                                    </div>
                                </div>

                                <?php if(isset($_SESSION["passInvaild"])){?>
                                <div class="input-group form-group">
                                    <label><?php echo $_SESSION["passInvaild"]; ?></label>
                                </div>
                                <?php }?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label for="add">Address</label>
                                        <input type="text" id="add" name="address" class="form-control"
                                            placeholder="Enter Address"><?php if(isset($_SESSION['address'])) echo $_SESSION['address']; else echo ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-6">
                                <div class="form-group"><label for="city">City</label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        placeholder="Enter City"
                                        value='<?php if(isset($_SESSION['city'])) echo $_SESSION['city']; else echo ""; ?>'>
                                </div>
                                <?php if(isset($_SESSION["msgRegister"])){?>
                                <div class="input-group form-group">
                                    <label><?php echo $_SESSION["msgRegister"]; ?></label>
                                </div>
                                <?php }?>
                            </div>
                            <div class="row col-md-6">
                                <input type="submit" name="register" class="btn btn-info" value="Register">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>

</body>

</html>

<?php } ?>