<?php 
	if(isset($_POST['submit']))
	{
        include "../class/category.php";
        $data = new Category();
		$data->id=time();
		$data->name=$_POST['name'];
		$data->mota=$_POST['mota'];	
        $data->add($data);
	}
	 ?>