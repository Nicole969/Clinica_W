<?php

require_once "controllers/NotificacionController.php";

$noti = new NotificacionController();
$notificaciones = $noti->obtenerNotificaciones();
?>
<header class="text-black py-4">
    <div class="container mx-auto flex justify-between items-center px-4 md:px-14">
        <a href="index.php" class="text-lg">DuoDent</a>
        <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
            <?php
            if (isset($_SESSION["tipo"])) { ?>
                <?php
                switch ($_SESSION["tipo"]) {
                    case 'paciente': ?>
                        <a href="home" class="text-black px-4 py-2 rounded hover:text-blue-600">Home</a>
                        <a href="miscitas" class="text-black px-4 py-2 rounded hover:text-blue-600">Mi citas</a>
                        <a href="perfil" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                        <div>
                            <a href="logout" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                        <?php break; ?>
                    <?php
                    case 'admin': ?>
                        <a href="dashboard" class="text-black px-4 py-2 rounded hover:text-blue-600">Panel</a>
                        <a href="admedicos" class="text-black px-4 py-2 rounded hover:text-blue-600">Medicos</a>
                        <a href="perfil" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>

                        <div x-data="{ dropdownOpen: true }" class="relative my-32">
                            <button @click="dropdownOpen = !dropdownOpen" id="notificationDropdown" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                                <i class="fa-solid fa-bell"></i>
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                            <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">

                                <?php if (!empty($notificaciones)) : ?>
                                    <?php foreach ($notificaciones as $notificacion) : ?>
                                        <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                            <p><?php echo $notificacion['Mensaje']; ?></p>
                                            <small>Cita: <?php echo $notificacion['CitaAsunto']; ?> el <?php echo $notificacion['CitaFecha']; ?></small>
                                            <small>Usuario: <?php echo $notificacion['Usuario']; ?></small>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <a href="notificaciones" class="block px-4 py-2 text-sm capitalize bg-blue-500 text-white text-center
                                            hover:bg-blue-200">
                                    VER TODAS</a>
                            </div>

                        </div>
                        <div>
                            <a href="logout" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                        <?php break; ?>
                    <?php
                    default: ?>
                        <a href="perfil" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                        <div>
                            <a href="logout" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                <?php break;
                }
                ?>
            <?php
            } else { ?>

                <a href="register" class="text-black px-4 py-2 rounded hover:text-blue-600">Registro</a>
                <div>
                    <a href="login" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                        hover:bg-blue-700 block md:inline-block focus:outline-none focus:ring-2 focus:ring-blue-200 cursor-pointer transition duration-300 transform hover:-translate-y-1">Iniciar Sesión</a>
                </div>

            <?php } ?>
        </div>
    </div>
</header>

<!-- PARA EL Dropdown -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>