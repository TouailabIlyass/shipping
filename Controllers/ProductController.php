<?php

require_once('../c$$nf$$g/connection.php');

class ProductController
{
    private static $con = null;
    public static function store($data)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
			$stmt = self::$con->prepare("insert into products values (:intitule, :description, :categorie, :prix, :solde, :size, :color, :avis, :likes, :tag)");
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
            $stmt = self::$con->prepare("delete from products where id=:id");
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
            $stmt = self::$con->prepare('select * from products  limit :offset ,:limit');
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
            $stmt = self::$con->prepare('select * from products where id=:id');
            $stmt->execute();
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function getByTag($tag, $page = 16 ,$offset = 0)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $data = array('tag'=> $tag, 'limit'=> $page, 'offset'=> $offset);
            $stmt = self::$con->prepare('select * from products where tag=%:tag% limit :offset ,:limit');
            $stmt->execute($data);
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

    public static function getByCategorie($categorie, $page = 16, $offset = 0)
    {
        try{
            if(self::$con == null)
                self::$con = ConnectionBD::getConnection();
            $data = array('categorie'=>$categorie, 'limit'=>$page, 'offset'=>$offset);
            $stmt = self::$con->prepare('select * from products where categorie=%:categorie% limit :offset ,:limit');
            $stmt->execute($data);
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
        return false;
    }

}