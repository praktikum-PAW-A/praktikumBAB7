<?php
require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;
    private $table = "users";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $password, $email, $name)
    {
        $sql = "INSERT INTO {$this->table} (username, password, email, name)
                VALUES (:username, :password, :email, :name)";
        $stmt = $this->conn->prepare($sql);
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([
            ':username' => $username,
            ':password' => $hashed,
            ':email' => $email,
            ':name' => $name
        ]);
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function update($id, $username, $email, $name, $password = null)
    {
        if (!empty($password)) {
            $sql = "UPDATE {$this->table} 
                SET username = :username, email = :email, name = :name, password = :password 
                WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            return $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':name' => $name,
                ':password' => $hashed,
                ':id' => $id
            ]);
        } else {
            $sql = "UPDATE {$this->table} 
                SET username = :username, email = :email, name = :name 
                WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':name' => $name,
                ':id' => $id
            ]);
        }
    }


    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
