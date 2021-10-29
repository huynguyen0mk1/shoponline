<?php
    session_start();
    $arr_cart = array();
    $arr_num_cart = array();
    if(isset($_SESSION['cart']))
    foreach($_SESSION['cart'] as $item){
        // echo $item."<br/>";
        if (in_array($item, $arr_cart)) {
            
            $arr_num_cart[array_search($item,$arr_cart)]++;
        }
        else{
            array_push($arr_cart,$item);
            array_push($arr_num_cart,1);
        }
    }
    include '../class/vegetable.php';
    $data = new Vegetable();
    $results=$data->getListByIDs($arr_cart);
    $total=0;
    $num=0;
    $_SESSION["arrVegetableID"]=array();
    $_SESSION["arrAmount"]=array();
    $_SESSION["arrPrice"]=array();
    $_SESSION["cartTotal"]=0;
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
    <div class="container register">
        <div class="row">
            <div class="container">
                <h3>Cart</h3>
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
                            if(isset($results))
                            foreach($results as $item){?>
                        <tr>
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $item->VegetableName;?></td>
                            <td><img class="img-thumbnail" src="/shop/images/<?php echo ($item->Image);?>"
                                    alt="<?php echo ($item->VegetableName);?>" style="height: 200px;"></td>
                            <td><?php 
                                    array_push($_SESSION["arrVegetableID"],$item->VegetableID);
                                    array_push($_SESSION["arrAmount"],$arr_num_cart[array_search($item->VegetableID,$arr_cart)]);
                                    array_push($_SESSION["arrPrice"],$item->Price);
                                    $num+=$arr_num_cart[array_search($item->VegetableID,$arr_cart)];
                                    $total+=$arr_num_cart[array_search($item->VegetableID,$arr_cart)]*$item->Price;
                                    echo $arr_num_cart[array_search($item->VegetableID,$arr_cart)];?>
                            </td>
                            <td><?php echo $item->Price;?></td>
                        </tr>
                        <?php $i++;}?>
                    </tbody>
                    <tbody>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"><?php echo $num;?></th>
                        <th scope="col"><?php $_SESSION["cartTotal"]=$total;
                     echo $total;?></th>
                    </tbody>
                </table>
                <form action="./saveorder.php" method="post">
                    <input type="submit" name="submit" value="Order" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>