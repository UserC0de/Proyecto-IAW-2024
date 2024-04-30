document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencias a los elementos del DOM
    const usernameInput = document.querySelector('input[type="text"]');
    const passwordInput = document.querySelector('input[type="password"]');
    const loginButton = document.querySelector('.btn');
  
    // Función para manejar el evento de clic en el botón de inicio de sesión
    function handleLogin() {
      const username = usernameInput.value;
      const password = passwordInput.value;
  
      // Validar las credenciales
      if (validarCredenciales(username, password)) {
        // Si las credenciales son válidas, realizar la acción de inicio de sesión (por ejemplo, redirigir a una nueva página)
        alert("Inicio de sesión exitoso");
        // Aquí podrías agregar código para redirigir a una nueva página o realizar otras acciones después de iniciar sesión
      } else {
        // Si las credenciales son inválidas, mostrar un mensaje de error
        alert("Nombre de usuario o contraseña incorrectos");
      }
    }
  
    // Función para validar las credenciales
    function validarCredenciales(username, password) {
      // Validar que el nombre de usuario y la contraseña cumplan ciertos criterios
      // Por ejemplo, podrías requerir que el nombre de usuario tenga al menos 4 caracteres
      // y que la contraseña tenga al menos 6 caracteres
      if (username.length >= 4 && password.length >= 6) {
        return true; // Las credenciales son válidas
      } else {
        return false; // Las credenciales son inválidas
      }
    }
  
    // Agregar un event listener al botón de inicio de sesión
    loginButton.addEventListener('click', handleLogin);
  });
  