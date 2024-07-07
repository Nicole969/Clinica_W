<?php

require_once dirname(__DIR__) . "/models/Roles.php";

class RoleController
{
    public function mostrarRoles()
    {
        $role = new Role();
        return $role->mostrar();
    }
}
?>
