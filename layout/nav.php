<header class="text-black py-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="index.php" class="text-lg sm">DuoDent</a>
        <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
            <?php
            if (isset($_SESSION["tipo"])) { ?>
                <?php
                switch ($_SESSION["tipo"]) {
                    case 'paciente': ?>
                        <a href="home.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Home</a>
                        <a href="miscitas.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Mi citas</a>
                        <a href="#" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                        <div>
                            <a href="logout.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                        <?php break; ?>
                    <?php
                    case 'admin': ?>
                        <a href="dashboard.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Panel</a>
                        <a href="#" class="text-black px-4 py-2 rounded hover:text-blue-600">Medicos</a>
                        <a href="#" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                        <div>
                            <a href="logout.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                        <?php break; ?>
                    <?php
                    default: ?>
                        <a href="#" class="text-black px-4 py-2 rounded hover:text-blue-600">Perfil</a>
                        <div>
                            <a href="logout.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                                hover:bg-blue-700 block md:inline-block">Cerrar Sesión</a>
                        </div>
                <?php break;
                }
                ?>
            <?php
            } else { ?>

                <a href="register.php" class="text-black px-4 py-2 rounded hover:text-blue-600">Registro</a>
                <div>
                    <a href="login.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                        hover:bg-blue-700 block md:inline-block">Iniciar Sesión</a>
                </div>

            <?php } ?>
        </div>
    </div>
</header>