<?php
require_once 'layout/header.php';
?>

<div class="bg-gradient-to-r from-blue-200 via-blue-100 to-blue-200 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white border border-gray-200 p-6 sm:p-10 rounded-xl shadow-2xl mx-6">
        <h4 class="text-center text-3xl mb-8 text-gray-700">Iniciar <span class="text-blue-400">Sesión</span></h4>
        <div class="flex justify-center mb-6">
            <img src="images/dental.png" alt="Imagen" class="w-1/3 sm:w-1/4 h-auto">
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="space-y-6 flex flex-col items-center">
            <!-- Mostrar mensaje de error si existe -->
            <?php
            $error = '';
            if (isset($_POST['submit'])) {
                $correo = $_POST['correo'];
                $password = $_POST['password'];

                require_once "controllers/AuthController.php";
                $uc = new AuthController();
                $error = $uc->login($correo, $password);
            }
            ?>
            <?php if ($error) : ?>
                <div class="w-full bg-red-100 text-red-700 border border-red-400 p-3 rounded mb-6 text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-col space-y-2">
                <label class="text-center">Ingresar correo:</label>
                <input type="text" name="correo" class="w-full text-md px-5 py-2 rounded-md outline-none 
                border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="example@gmail.com">
            </div>

            <div class="flex flex-col space-y-2">
                <label class="text-center">Ingresar contraseña:</label>
                <div class="relative w-full">
                    <input type="password" name="password" id="password" class="w-full text-md px-5 py-2 rounded-md outline-none border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="**********" required>
                    <span id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <input type="submit" name="submit" value="Ingresar" class="w-1/2 sm:w-1/2 py-2 text-lg rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 cursor-pointer transition duration-300 transform hover:-translate-y-1">

            <div class="text-center">¿Aún no tienes una cuenta? <a href="register.php" class="text-blue-400 hover:text-blue-600">Registrate</a></div>
        </form>
    </div>
</div>


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the icon
        if (type === 'password') {
            this.querySelector('i').classList.remove('fa-eye-slash');
            this.querySelector('i').classList.add('fa-eye');
        } else {
            this.querySelector('i').classList.remove('fa-eye');
            this.querySelector('i').classList.add('fa-eye-slash');
        }
    });
</script>