<?php 
class Order{

	public $orderID;
	public $customerID;
	public $date;
	public $total;
	public $note;
	function getAllOrder($cusID) {
		include '../connection.php';
		$sql="SELECT OrderID, CustomerID, Date, Total, Note FROM orders WHERE CustomerID =:cusID";
		$query = $dbh -> prepare($sql);
		$query-> bindValue(':cusID', $cusID);
		$query->execute();
		if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
	}
	function getOrderDetail($orderid){
		include '../connection.php';
		$sql="SELECT  VegetableName, Image, OrderID, o.VegetableID, Quantity, o.Price FROM vegetable v INNER JOIN orderdetail o on v.VegetableID = o.VegetableID WHERE OrderID =:orderid";
		$query = $dbh -> prepare($sql);
		$query-> bindValue(':orderid', $orderid);
		$query->execute();
		if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
	}
	function addOrder($order, $detail){
		$value="";
		try {
			include '../connection.php';
			$dbh->beginTransaction();   
			$sql="INSERT INTO orders (OrderID, CustomerID, Date, Total, Note) VALUES(:orderid, :cusID, ':date', :total, ':note')";
			$query = $dbh->prepare($sql);
			$query->bindValue(':orderid',$order->orderID, PDO::PARAM_INT);
			$query->bindValue(':cusID',$order->customerID, PDO::PARAM_INT);
			$query->bindValue(':date',$order->date);
			$query->bindValue(':total',$order->total);
			$query->bindValue(':note',$order->note);
			if ($query->execute() === FALSE) {
				$dbh->rollback();
				$_SESSION['msgRegister']="Error system!!!";
			} else {
				$dbh->commit();
				$dbh->beginTransaction(); 
				$i=0;
				$sql1="INSERT INTO orderdetail(OrderID, VegetableID, Quantity, Price) VALUES :val";
				$query1 = $dbh->prepare($sql1);
				
				foreach( $detail as $item){
					$value = $value."(".$order->orderID.",".$item.",".$_SESSION["arrAmount"][$i].",".$_SESSION["arrPrice"][$i].")";
					if($i<count($detail)-1) $value = $value.",";
					else
					$value = $value.";";
					$i++;
				}
				echo $value;
				$query1->bindValue(':val', mysqli_escape_string($value));
				if ($query1->execute() === FALSE) {
					$_SESSION['msgRegister']="Error system!!!";
				} else $dbh->commit();
				$msg="Tạo thành công";
				
				$_SESSION['cart']=array();
				$_SESSION["arrAmount"] = array();
				$_SESSION["arrPrice"] = array();
				
			}
		} catch (PDOException $e) {
			echo "=====".$value."====="."<br/>";
			echo 'Database Error '.$e->getMessage().' in '.$e->getFile().
			': '.$e->getLine();
		}
		// header('location:index.php',true,301);
	}
}
?>