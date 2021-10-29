<?php
    include '../connection.php';
    session_start();
    $idInvaild="";
    $passInvaild="";
    $email="";
    $_SESSION['username']=null;
    $_SESSION["passInvaild"]=null;
    $_SESSION["idInvaild"]=null;
    if(isset($_POST['login']))
    {
        $_SESSION['username']=$_POST['username'];
        $email=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT * FROM customers WHERE CustomerID=:email";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0 && $results[0]->CustomerID == $email)
        {
            $row = $results[0]->Password;
            if($row==$password){
                $_SESSION["passInvaild"]="";
                $_SESSION["idInvaild"]="";
                $_SESSION['login']=$results[0]->FullName;
                header("location:../vegetable/index.php");
            }
            else{
                $_SESSION["passInvaild"]="Nhập sai passowrd";
                header("location:login.php",true,301);
            }
            
        } else{
            
            $_SESSION["idInvaild"]="Không tìm thấy tài khoản";
            header("location:login.php",true,301);
        }
        exit(0);
    }

?>