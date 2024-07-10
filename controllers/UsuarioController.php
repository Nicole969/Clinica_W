<?php

require_once "models/Usuario.php";

class UsuarioController
{
    public function mostrarTodos()
    {
        $usuario = new Usuario();
        return $usuario->mostrar();
    }

    public function cantidadUser()
    {
        $usuario = new Usuario();
        return $usuario->cantidadUser();
    }

    public function mostrarPaciente()
    {
        $tipo = 'paciente';
        $usuario = new Usuario();
        return $usuario->mostrarPorTipo($tipo);
    }

    public function mostrarMedicos()
    {
        $usuario = new Usuario();
        return $usuario->mostrarPorTipo('medico');
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
            $usuario_id = $item["id"];
            $usuario_nombre = $item["nombres"] . " " . $item["apellidos"];
            $password_bd = $item["password"];
            $tipo = $item["tipo"];
            $contador++;
        }
        if ($contador > 0) {
            if ($password == $password_bd) {
                session_start();
                $_SESSION["id"] = $usuario_id;
                $_SESSION["usuario"] = $usuario_nombre;
                $_SESSION["Tipo"] = $tipo;
                header("Location: usuarioMostrar.php");
            } else {
                echo "contraseña no valida";
            }
        } else {
            echo "usuario y/o contraseña no validos";
        }
    }
}
