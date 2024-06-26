<?php

require_once "models/Usuario.php";

class UsuarioController
{
    public function mostrar()
    {
        $usuario = new Usuario();
        return $usuario->mostrar();
    }

    public function login($username, $password)
    {
        $usuario = new Usuario();
        $usuarioValidado = $usuario->login($username);

        $contador = 0;
        $usuario_id = null;
        $usuario_nombre = null;
        $password_bd = null;

        foreach ($usuarioValidado as $item) {
            $usuario_id = $item["ID_User"];
            $usuario_nombre = $item["Username"];
            $password_bd = $item["Clave"];
            $tipo = $item["tipo"];
            $contador++;
        }
        if ($contador > 0) {
            if ($password == $password_bd) {
                session_start();
                $_SESSION["id"] = $usuario_id;
                $_SESSION["usuario"] = $usuario_nombre;
                $_SESSION["tipo"] = $tipo;
                header("Location: views/dashboard.php");
            } else {
                echo "contraseña no valida";
            }
        } else {
            echo "usuario y/o contraseña no validos";
        }
    }
}
