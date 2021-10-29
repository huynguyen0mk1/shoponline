<?php
session_start();
error_reporting(0);
include '../class/vegetable.php';
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
    <?php include('../connection.php'); ?>
    <?php include('../menu.php'); ?>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">

                <div class="space60">&nbsp;</div>

                <div class="row col-sm-12" style="float: left;">
                    <div class="col-sm-3" style="float: left; width: 21%;">
                        <h3>Danh mục</h3>
                        <form action="index.php" method="POST">
                            <ul class="list-group list-group-flush" style="border:none !important">
                                <?php $sql = "SELECT * from category order by CategoryID";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount() >0)
                                    { 
                                        $i=1;
                                        foreach($results as $result){   ?>
                                            <li class="list-group-item" style="border:none">
                                                <input id="<?php echo "checkbox".htmlentities($result->CategoryID);?>"
                                                    type="checkbox" name="check_list[]"
                                                    value="<?php echo htmlentities($result->CategoryID);?>">
                                                <label
                                                    for='<?php echo "checkbox".htmlentities($result->CategoryID);?>'><?php echo htmlentities($result->Name);?></label>
                                            </li>
                                            <?php 
                                        }
                                        $i++;
                                    } 
                                ?>
                                
                            </ul>
                            <input type="submit" class="btn btn-info" value="Filter" />
                        </form>
                    </div>
                    <div class="col-sm-9" style="float: left;">
                        <div class="beta-products-list">
                            <h3>Vegetable</h3>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="">
                                <?php 
                                    $data=new Vegetable();
                                    $results=null;
                                    if(!isset($_POST['check_list']))
                                        $results=$data->getAll();
                                    else{
                                        $results=$data->getListByCateIDs($_POST['check_list']);
                                    }
						            $cnt=1;
                                    foreach($results as $result){   
                                ?><form method="post">
                                    <div class="col-sm-3" style=" float: left; margin-bottom:20px">
                                        <div class="single-item">
                                            <div class="single-item-header" style="margin-bottom:5px">
                                                <a><img class="img-thumbnail"
                                                        src="/shop/images/<?php echo ($result->Image);?>"
                                                        alt="<?php echo ($result->VegetableName);?>"
                                                        style="min-width:180px ;min-height: 200px; max-width:180px ;max-height: 200px;"></a>
                                            </div>
                                            <div class="single-item-body" style="margin-bottom:10px">
                                                <span class="single-item-title" >
                                                    <?php echo ($result->VegetableName);?>
                                                </span>
                                                <span class="badge badge-warning"><?php echo number_format($result->Price);?></span>
                                            </div>
                                            <div class="single-item-caption">
                                                <button type="submit"
                                                    name="<?php echo "submit".($result->VegetableID);?>"
                                                    class="btn btn-danger" value="<?php echo $result->VegetableID;?>">
                                                    <i class="fa fa-chevron-right"></i>Buy
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if(isset($_POST['submit'.$result->VegetableID])) {
                                            if (!isset($_SESSION['cart'])) {
                                                $_SESSION['cart'] = array();
                                            }
                                            array_push($_SESSION['cart'],$result->VegetableID);
                                        }
                                       
                                    ?>
                                </form>
                                <?php } ?>

                            </div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
    </div> <!-- .container -->

</body>

</html>