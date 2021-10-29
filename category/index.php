<?php
        session_start();
        error_reporting(0);
        include "../class/category.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>market</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">

</head>

<body>

    <?php include('../menu.php'); ?>
    <div class="container">
        <div class="agile-grids">
            <div class="row col-sm-12" style="float: left;">
                <div class="col-sm-4" style="float: left; padding-top:20px">
                    <form action="./add.php" method="POST">
                        <div class="row form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Enter name">
                        </div>

                        <div class="row form-group">
                            <label for="Description">Description:</label>
                            <input type="text" id="Description" class="form-control" name="mota"
                                placeholder="Enter description">
                        </div>

                        <div class="row">
                            <button type="submit" name="submit" class="btn btn-info">Tạo</button>
                        </div>

                    </form>
                </div>
                <div class="col-sm-8" style="float: left;">
                    <div class="agile-tables" style="padding: 0px;">
                        <div class="w3l-table-info">
                            <h2>Category</h2>
                            <table id="table" style="width: 100%" class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Description</th>
                                    </tr>
                                </thead style="width: 100%">
                                <tbody style="width: 100%; text-align: center;">
                                    <?php 
                                $data = new Category();
								$results=$data->getAll();
								$cnt=1;
								foreach($results as $result){				
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->Name);?></td>
                                        <td><?php echo htmlentities($result->Description);?></td>
                                    </tr>
                                    <?php $cnt++; }?>
                                </tbody>
                            </table>
                        </div>
                        </table>
                    </div>
                </div>

            </div>
        </div>



        <script>
        $(document).ready(function() {
            var navoffeset = $(".header-main").offset().top;
            $(window).scroll(function() {
                var scrollpos = $(window).scrollTop();
                if (scrollpos >= navoffeset) {
                    $(".header-main").addClass("fixed");
                } else {
                    $(".header-main").removeClass("fixed");
                }
            });
        });
        </script>
        <div class="inner-block">
        </div>
        <?php include('includes/footer.php');?>
    </div>
    </div>
</body>

</html>