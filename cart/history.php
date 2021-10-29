<?php
session_start();
error_reporting(0);
include '../class/order.php';
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
        <h3>History</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $data=new Order();
                $results=$data->getAllOrder($_SESSION['username']);
                $i=1;
                foreach($results as $item){ ?>
                <tr>
                    <th scope="row"><?php echo $i;?></th>
                    <td><?php echo $item->Date;?></td>
                    <td><?php echo $item->Total;?></td>
                    <td>
                        <form action="./detail.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $item->OrderID;?>" />
                            <input type="submit" name="submit" value="Detail" class="btn btn-info" />
                        </form>
                    </td>

                </tr>
                <?php $i++;}?>
            </tbody>
            <tbody>

        </table>

    </div>
</body>

</html>