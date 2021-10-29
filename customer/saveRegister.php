<?php
try {
    include('../connection.php');
    error_reporting(0);
    session_start();
    $_SESSION['fname']=null;
    $_SESSION['address']=null;
    $_SESSION['city']=null;
    $_SESSION['password']=null;
    $_SESSION['passInvaild']=null;
    $_SESSION['msgRegister']=null;
    if(isset($_POST['register']))
    {
        $dbh->beginTransaction();   
        $_SESSION['fname']=$_POST['fname'];
        $_SESSION['address']=$_POST['address'];
        $_SESSION['city']=$_POST['city'];
        $_SESSION['password']=$_POST['password'];
        if(true){
            $password=md5($_POST['password']);
            $sql="INSERT INTO  customers (CustomerID ,Fullname,Address,City,Password) VALUES(:id,:fname,:add,:city,:password)";
            $query = $dbh->prepare($sql);
            $query->bindValue(':id',time());
            $query->bindValue(':fname',$_SESSION['fname']);
            $query->bindValue(':add',$_SESSION['address']);
            $query->bindValue(':city',$_SESSION['city']);
            $query->bindValue(':password',$password);
            // try the insert, if something goes wrong, rollback.
            if ($query->execute() === FALSE) {
                $dbh->rollback();
                $_SESSION['msgRegister']="Error system!!!";
                header('location:register.php',true,301);
            } else {
                $last_insert_id = $dbh->lastInsertId();
                $_SESSION['fname']=null;
                $_SESSION['address']=null;
                $_SESSION['city']=null;
                $_SESSION['password']=null;
                $_SESSION['passInvaild']=null;
                $_SESSION['msgRegister']="Đăng ký thành công. bạn có thể đăng nhập";
                $dbh->commit();
                header('location:register.php',true,301);
            }
        }
        else{
            $_SESSION['msgRegister']=null;
            $_SESSION['passInvaild']="Password invaild";
            header('location:register.php',true,301);
        }
        
    }
    
} catch (PDOException $e) {
    echo 'Database Error '.$e->getMessage().' in '.$e->getFile().
    ': '.$e->getLine();
}


?>