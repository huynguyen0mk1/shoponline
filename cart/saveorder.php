
<?php 
    session_start();
    if(!isset($_SESSION['login'])){
        header("location:../customer/login.php");
    }else{
        include '../class/order.php';
        $order = new Order();
        $order->orderID = time();
        $order->customerID = $_SESSION['username'];
        $order->date = date("Y-m-d");
        $order->total = $_SESSION["cartTotal"];
        $order->note ="";
        $order->addOrder($order, $_SESSION['arrVegetableID']);
        
    }
?>