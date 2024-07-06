<?php
require_once 'layout/header.php';
?>

<div class="bg-gradient-to-r from-blue-200 via-blue-100 to-blue-200 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white border border-gray-200 p-6 sm:p-10 rounded-xl shadow-2xl mx-6">
        <h4 class="text-center text-3xl mb-2 text-blue-600">Registro</h4>

        <form id="registerForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="space-y-4 flex flex-col items-center">
            <div id="empty-fields-message" class="text-red-500 text-center hidden">Por favor, rellene todos los campos.</div>  

            <div class="flex flex-col space-y-2">
                <label class="text-center">Ingresar usuario:</label>
                <input type="text" id="username"  name="username" class="w-full text-md px-5 py-2 rounded-md outline-none 
                border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="Example">
            </div>

            <div id="email-error-message" class="text-red-500 text-center hidden">Por favor, ingrese un correo válido.</div>

            <div class="flex flex-col space-y-2">
                <label class="text-center">Ingresar correo:</label>
                <input type="text" id="correo" name="correo" class="w-full text-md px-5 py-2 rounded-md outline-none 
                border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="example@gmail.com">
            </div>

            <div id="error-message" class="text-red-500 text-center hidden">Las contraseñas no coinciden.</div>

            <div class="flex flex-col space-y-2 relative">
                <label class="text-center">Ingresar contraseña:</label>
                <input type="password" id="password" name="password" class="w-full text-md px-5 py-2 rounded-md outline-none 
                border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="**************">
                <i class="fa fa-eye absolute right-4 top-10 cursor-pointer" id="togglePassword" style="color: black;"></i>
            </div>

            <div class="flex flex-col space-y-2 relative">
                <label class="text-center">Confirmar contraseña:</label>
                <input type="password" id="confirmPassword" name="confirmclave" class="w-full text-md px-5 py-2 rounded-md outline-none 
                border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-center" placeholder="**************">
                <i class="fa fa-eye absolute right-4 top-10 cursor-pointer" id="toggleConfirmPassword" style="color: black;"></i>
            </div>
            
            <input type="submit" name="submit" value="Guardar" class="w-1/2 sm:w-1/2 py-2 text-lg rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 cursor-pointer transition duration-300 transform hover:-translate-y-1">

            <div class="text-center">¿Ya tienes una cuenta? <a href="login.php" class="text-blue-400 hover:text-blue-600">Ingresar</a></div>
        </form>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmarClave = $_POST["confirmclave"];
    $correo = $_POST["correo"];
    $type = $_POST["tipo"];

    require_once "controllers/AuthController.php";
    $uc = new AuthController();
    $uc->register($username, $password, $confirmarClave, $correo, $type);
}
?>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    toggleConfirmPassword.addEventListener('click', function (e) {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const form = document.getElementById('registerForm');
    const errorMessage = document.getElementById('error-message');
    const emailErrorMessage = document.getElementById('email-error-message');
    const emptyFieldsMessage = document.getElementById('empty-fields-message');
    const username = document.getElementById('username');
    const email = document.getElementById('correo');

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    form.addEventListener('submit', function (e) {
        let valid = true;

        if (!username.value || !email.value || !password.value || !confirmPassword.value) {
            e.preventDefault();
            emptyFieldsMessage.classList.remove('hidden');
            valid = false;
        } else {
            emptyFieldsMessage.classList.add('hidden');
        }

        if (!isValidEmail(email.value)) {
            e.preventDefault();
            emailErrorMessage.classList.remove('hidden');
            valid = false;
        } else {
            emailErrorMessage.classList.add('hidden');
        }

        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            errorMessage.classList.remove('hidden');
            valid = false;
        } else {
            errorMessage.classList.add('hidden');
        }

        return valid;
    });

    
</script>