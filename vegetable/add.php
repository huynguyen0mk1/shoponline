<?php 
try {
	include('../connection.php');
    error_reporting(0);
    session_start();
    $_SESSION['msgnew']=null;
    if(isset($_POST['submit']))
	{
        $dbh->beginTransaction();
        // Allow certain file formats
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png") {
            $_SESSION['msgnew']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header('location:new.php',true,301);
            $uploadOk = 0;
        }else{
            // Check file size
            if ($_FILES["image"]["size"] > 2000000) {
                $_SESSION['msgnew']= "Sorry, your file is too large.";
                header('location:new.php',true,301);
                $uploadOk = 0;
            }else{
                $uploadOk = 1;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    echo "File ".$target_file." is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $sql="INSERT INTO `vegetable`(`VegetableID`, `CategoryID`, `VegetableName`, `Unit`, `Amount`, `Price`, `Image`) VALUES (:value_1,:value_2,:value_3,:value_4,:value_5,:value_6,:value_7)";
                        $query = $dbh->prepare($sql);
                        $query->bindValue(':value_1',time());
                        $query->bindValue(':value_2',$_POST['categoryId']); 
                        $query->bindValue(':value_3',$_POST['vagetableName']); 
                        $query->bindValue(':value_4',$_POST['unit']);
                        $query->bindValue(':value_5',$_POST['amount']);
                        $query->bindValue(':value_6',$_POST['price']);
                        $query->bindValue(':value_7',"".basename($_FILES["image"]["name"]));
                        // try the insert, if something goes wrong, rollback.
                        if ($query->execute() === FALSE) {
                            $dbh->rollback();
                            $_SESSION['msgnew']="Error system!!!";//."-".$_POST['categoryId']."-".$_POST['vagetableName']."-".$_POST['unit']."-".$_POST['amount']."-".$_POST['price']."-".basename($_FILES["image"]["name"]);
                            header('location:new.php',true,301);
                        } else {
                            $_SESSION['msgnew']=null;
                            $last_insert_id = $dbh->lastInsertId();
                            $dbh->commit();
                            header('location:new.php',true,301);
                        }

                    } else {
                        $_SESSION['msgnew']= "Sorry, there was an error uploading your file.";
                        header('location:new.php',true,301);
                    }
                } 
            }
        }
        
        
        

	}
} catch (PDOException $e) {
    echo 'Database Error '.$e->getMessage().' in '.$e->getFile().
    ': '.$e->getLine();
}
?>