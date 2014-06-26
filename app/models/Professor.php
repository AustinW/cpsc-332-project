<?php
/**
 * Created by PhpStorm.
 * User: Austin White
 * Date: 6/24/14
 */

require_once 'BaseModel.php';

class Professor extends BaseModel {

    public static function find($ssn)
    {
        $stmt = parent::getConnection()->prepare('SELECT * FROM `professors` WHERE `ssn` = :ssn LIMIT 1');
        $stmt->execute(array('ssn' => $ssn));

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Professor');
        return $stmt->fetch();
    }

    public static function all()
    {
        $stmt = parent::getConnection()->prepare('SELECT * FROM `professors`');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Professor');
    }

    public function name()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function address($html = true)
    {
        $separator = ($html) ? '<br/>' : '\n';

        return $this->address_street . $separator . $this->address_city . ', ' . $this->address_state . ' ' . $this->address_zip;
    }
}