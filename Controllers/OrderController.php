<?php

require_once('../c$$nfi$$g/connection.php');

class ProductController
{
    private static $con = null;
    public static function store($data)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
			$stmt = self::$con->prepare("insert into orders values (:email, :phone, :firstname, :lastname, :country, :address, :code_postal, :email_paypal)");
            $stmt->execute($data);
            return true;
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function update($data)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $stmt = self::$con->prepare("update products set intitule=:intitule description=:description categorie_id=:categorie prix=:prix solde=:solde size=:size color=:color avis=:avis likes=:likes tag=:tag");
            $stmt->execute($data);
            return true;
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function delete($id)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $stmt = self::$con->prepare("delete from orders where id=:id");
            $stmt->execute($id);
            return true;
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function getAll($page = 16, $offset = 0)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $data = array('offset'=> $offset, 'limit'=>$page);
            $stmt = self::$con->prepare('select * from orders  limit :offset ,:limit');
            $stmt->execute($data);
            return $stmt->fetchAll();
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function getOne($id)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $stmt = self::$con->prepare('select * from orders where id=:id');
            $stmt->execute();
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

}