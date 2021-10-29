<?php
session_start();
error_reporting(0);
include '../class/order.php';
$num=0;
$total=0;
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
        <h3>Order Detail</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; 
                 $data=new Order();
                 if($_GET['id'])
                 $results=$data->getOrderDetail($_GET['id']);
                 $i=0;
                foreach($results as $item){?>
                <tr>
                    <th scope="row"><?php echo $i;?></th>
                    <td><?php echo $item->VegetableName;?></td>
                    <td><img class="img-thumbnail" src="/shop/images/<?php echo ($item->Image);?>"
                            alt="<?php echo ($item->VegetableName);?>" style="height: 200px;"></td>

                    <td><?php 
                    $num+=$item->Quantity;
                    $total+=$item->Quantity*$item->Price;
                     echo $item->Quantity;?></td>
                    <td><?php echo $item->Price;?></td>
                </tr>
                <?php $i++;}?>
            </tbody>
            <tbody>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Total:</th>
                <th scope="col"><?php echo $num;?></th>
                <th scope="col"><?php $_SESSION["cartTotal"]=$total;
                     echo $total;?></th>
            </tbody>
        </table>

    </div>
</body>

</html>