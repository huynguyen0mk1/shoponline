<?php
        session_start();
        error_reporting(0);
        include "../class/category.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Vegetable</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">

</head>

<body>
    <?php include('../connection.php'); ?>
    <?php include('../menu.php'); ?>
    <div class="container ">
        <h2>Add Vegetable</h2>
        <form action="./add.php" class="needs-validation  col-sm-9" method="POST" enctype="multipart/form-data"
            novalidate>
            <div class="row">
                <div class="form-group col-sm-8">
                    <label for="uname">Vegetable name:</label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter Vegetable name"
                        name="vagetableName" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="cate">Category name:</label>
                    <select id="cate" class=" form-control form-select form-select-lg mb-3" name="categoryId"
                        aria-label=".form-select-lg example" required>
                        <?php 
                                $data = new Category();
								$results=$data->getAll();
								foreach($results as $result){				
                                ?> <option value="<?php echo $result->CategoryID;?>">
                            <?php echo htmlentities($result->Name);?></option>

                        <?php  }?>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="unit">Unit</label>
                    <select id="unit" name="unit" class=" form-control form-select form-select-lg mb-3"
                        aria-label=".form-select-lg example">
                        <option value="Kg">Kg</option>
                        <option value="Gram">Gram</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" placeholder="Enter Amount Vegetable"
                        name="amount" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter Price Vegetable"
                        name="price" required>
                </div>
            </div>
            <div class="form-group" >
                <label for="image">Image</label>
                <div class="custom-file"  style=" border: 1px,#495057;">
                    <input type="file"  id="image" name="image" required>
                </div>
            </div>
            <?php if(isset($_SESSION["msgnew"])){?>
            <div class="form-group">
                <div class="text-danger"><?php echo $_SESSION["msgnew"];?></div>
            </div>
            <?php }?>
            <input type="submit" name="submit" class="btn btn-info" value="Add" />
        </form>
    </div>

    <script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>

</body>

</html>