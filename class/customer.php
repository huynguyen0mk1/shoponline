<?php
session_start();
error_reporting(0);
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



    <div class="w3l-table-info">
        <h2>Thông tin khách hàng</h2>
        <table id="table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">STT</th>
                    <th style="text-align: center;">Họ tên</th>
                    <th style="text-align: center;">Địa chỉ</th>
                    <th style="text-align: center;">Thành phố</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                <?php $sql = "SELECT * from customers order by CustomerID";
								$query = $dbh -> prepare($sql);
								//$query -> bindParam(':city', $city, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
										{				?>
                <tr style="width:100%;">
                    <td><?php echo htmlentities($cnt);?></td>
                    <td><?php echo htmlentities($result->FullName);?></td>
                    <td><?php echo htmlentities($result->Address);?></td>
                    <td><?php echo htmlentities($result->City);?></td>

                </tr>
                <?php $cnt=$cnt+1;} }?>
            </tbody>
        </table>
    </div>
    <br> <br>
    <h2> Thêm khách hàng mới </h2>
    <br> <br>
    <?php 
	if(isset($_POST['submit']))
	{
		$id=$_POST['id'];
		$fname=$_POST['fname'];
		$add=$_POST['add'];
		$city=$_POST['city'];	
	
		$sql="INSERT INTO customers(CustomerID, FullName, Address, City) VALUES(:id, :fname,:add, :city)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id',$id,PDO::PARAM_STR);
		$query->bindParam(':fname',$fname,PDO::PARAM_STR);
		$query->bindParam(':add',$add,PDO::PARAM_STR);
		$query->bindParam(':city',$city,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			$msg="Gói được tạo thành công";
		}
		else 
		{
			$error="Thêm thất bại. Hãy thử lại";
		}

	}
	 ?>
    <form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Thêm khách hàng</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="id" id="" placeholder="id khách hàng" required>
            </div>
        </div>
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Họ tên khách hàng</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="fname" id="" placeholder="Ghi rõ họ tên" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ</label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" cols="50" name="add" id="" placeholder="Địa chỉ cụ thể"
                    required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Thành phố</label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" cols="50" name="city" id="" placeholder="Thành phố"
                    required></textarea>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="submit" class="btn-primary btn">Tạo</button>

                <button type="reset" class="btn-inverse btn">Làm mới</button>
            </div>
        </div>





        </div>

    </form>
</body>

</html>