<?php

require_once('../c$$nfi$$g/connection.php');

class CheckoutController
{
    private static $con = null;
    public static function store($data)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
			$stmt = self::$con->prepare("insert into checkouts values (:order_id, :product_id, :qte)");
            $stmt->execute($data);
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
            $stmt = self::$con->prepare('select * from checkouts  limit :offset ,:limit');
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
            $stmt = self::$con->prepare('select * from checkouts where id=:id');
            $stmt->execute();
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

}