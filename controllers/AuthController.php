<?php

require_once "models/Usuario.php";

class AuthController
{
    public function mostrar()
    {
        $usuario = new Usuario();
        return $usuario->mostrar();
    }
    public function register($username, $password, $confirmarClave, $correo, $type)
    {
        $usuario = new Usuario();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $id_rol = 1;
        $usuario->crear($username, $password, $confirmarClave, $correo, $id_rol, $type);
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
            $password_bd = $item["ConfirmClave"];
            $tipo = $item["tipo"];
            $contador++;
        }
        if ($contador > 0) {
            if ($password == $password_bd) { //password_verify($password, $password_bd)
                session_start();
                $_SESSION["id"] = $usuario_id;
                $_SESSION["usuario"] = $usuario_nombre;
                $_SESSION["tipo"] = $tipo;
                switch ($tipo) {
                    case 'paciente':
                        # code...
                        header("Location: home.php");
                        break;
                    default:
                        header("Location: dashboard.php");
                        # code...
                        break;
                }
            } else {
                echo "contraseña no valida";
            }
        } else {
            echo "usuario y/o contraseña no validos";
        }
    }
}
