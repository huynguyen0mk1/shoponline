<?php

class Vegetable{
    function getAll(){
        include '../connection.php';
        $sql = "SELECT * from vegetable order by VegetableID ";
		$query = $dbh->prepare($sql);
		$query->execute();
        if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
    }
    function getListByCateID($cateid){
        include '../connection.php';
        $sql = "SELECT * from vegetable where CategoryID  =:CategoryID order by VegetableID ";
        $query = $dbh->prepare($sql);
        $query-> bindValue(':CategoryID', $cateid);
		$query->execute();
        if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
    }
    function getListByCateIDs($cateids){
        include '../connection.php';
        $sql = "SELECT * from vegetable where CategoryID In (".implode(',', $cateids).") order by VegetableID ";
        $query = $dbh->prepare($sql);
		$query->execute();
        if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
    }
    function getByID($vegetableID) {
        include '../connection.php';
        $sql = "SELECT * from vegetable where VegetableID  =:VegetableID order by VegetableID ";
        $query = $dbh->prepare($sql);
        $query-> bindValue(':VegetableID', $vegetableID);
		$query->execute();
        if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
    }
    function getListByIDs($vegetableIDs) {
        include '../connection.php';
        $sql = "SELECT * from vegetable where VegetableID In (".implode(',', $vegetableIDs).") order by VegetableID ";
        $query = $dbh->prepare($sql);
		$query->execute();
        if($query->rowCount() > 0) 
        return $query->fetchAll(PDO::FETCH_OBJ);
        return null;
    }
}
?>