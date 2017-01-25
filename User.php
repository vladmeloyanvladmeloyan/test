<?php

class User extends DbConect
{
    public $password;

    public function tableName()
    {
        return '`user`';
    }


    public function findByMail($email)
    {
        $query = "SELECT * FROM {$this->tableName()} WHERE `email` = :email LIMIT 1 ";
        $result = $this->DB_CONECT->prepare($query);
        $result->execute(array(
            ':email' => $email
        ));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function generatePassword($password)
    {
        return base64_encode(pack('H*', sha1(utf8_encode($password))));
    }

    public function setPassword($password)
    {

        $this->password = $this->generatePassword($password);

    }

    public function save($firstname, $lastname, $email)
    {
        try {
            $query = "INSERT INTO {$this->tableName()} SET `firstname` = '$firstname',`lastname` = '$lastname',`email` = '$email', `password` = '$this->password' ";
            $result = $this->DB_CONECT->prepare($query);
            return $result->execute();
        } catch (PDOException $e) {
            return false;

        }
    }

    public function checkPassword($email, $password)
    {
        $user = $this->findByMail($email);
        if ($user['password'] == $this->generatePassword($password))
            return true;

        return false;
    }

    public function checkEmpty($post)
    {
        foreach ($post as $k) {
            if (empty($k)) {
                return false;
            }
        }
        return true;
    }

}