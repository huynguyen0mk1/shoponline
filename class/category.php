<?php
class Category{
	public $id;
	public $name;
	public $mota;
	function getAll() {
		include '../connection.php';
		$sql = "SELECT * from category order by CategoryID";
		$query = $dbh->prepare($sql);
		$query->execute();
        if($query->rowCount() > 0) 
        	return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
	}
	function add($cate) {
		include '../connection.php';
			$id=$cate->id;
			$fname=$cate->name;
			$add=$cate->mota;	
			$sql="INSERT INTO category(CategoryID, Name, Description) VALUES(:id, :fname,:add)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_STR);
			$query->bindParam(':fname',$fname,PDO::PARAM_STR);
			$query->bindParam(':add',$add,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
			{
				$msg="Tạo thành công";
				header('location:index.php',true,301);
			}
			else 
			{
				$error="Thêm thất bại. Hãy thử lại";
				header('location:index.php',true,301);
			}
		
	}

}
?>