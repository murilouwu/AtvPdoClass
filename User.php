<?php

session_start();

require 'Connect.php';

final class User
{
    public $name;
    public $email;
    public $password;

    function setUser($pdo, $name, $email, $password)
    {
        if (!empty($name) && !empty($email) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                mensage("Email já cadastrado, >:(");
            } else {
                try {
                    $sql = "INSERT INTO users (nome, email, pass) VALUES (:name, :email, :password)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $password);
                    if ($stmt->execute()) {
                        mensage('Usuário cadastrado com sucesso :)');
                    } else {
                        throw new Exception('Erro ao cadastrar usuário ;-;');
                    }
                } catch (PDOException $e) {
                    mensage('Error: ' . $e->getMessage());
                }
            }
        } else {
            mensage("Há campos vazios!");
        }
    }

    function selectUser($pdo, $fields, $where)
    {
        if($fields == ""){
            $fields = "*";
        }
        try{
            $sql = "SELECT $fields FROM users $where";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute()){
                return $stmt;       
            }else{
                throw new Exception('Erro ao executar o select!');
            }
        } catch(PDOException $e){
            mensage('Error: '.$e->getMessage());
        }
    }

    function deleteUser($pdo, $id)
    {
        try{
            $sql = "DELETE FROM users WHERE cd = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                mensage("Usuário {$id} eliminado de vez!");
            }else{
                throw new Exception('Erro ao deletar usuário ;-;');
            }
        } catch(PDOException $e){
            mensage( "Error: ".$e->getMessage());
        }
    }

    function updateUser($pdo, $id, $name, $email)
    {
        if(!empty($id) || !empty($name) || !empty($email) || !empty($password)){
            try{    
                $sql = "UPDATE users SET nome = :name, email = :email WHERE cd = ".$id;
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);   
                if($stmt->execute()){ 
                    mensage('Usuário editado com sucesso :)'); 
                }else{
                    throw new Exception('Erro ao editar usuário ;-;');  
                }
            } catch(PDOException $e){
                mensage('Error: '.$e->getMessage());
            }                
        }
        else{
            mensage("Há campos vazios!");
        }
    }
}