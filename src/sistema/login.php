<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="g_id_onload"
        data-client_id="743643530121-7hlmmq2p208njhjca9e5r867k5ukpo32.apps.googleusercontent.com"
        data-callback="handleCredentialResponse">
    </div>

    <script>
        function handleCredentialResponse(response) {
            // Envía la respuesta al servidor para validación y autenticación del usuario
            $.ajax({
                url: "https://softecuestre.com.ar/src/sistema/procesar_login.php", // Ruta al archivo del servidor que procesa la respuesta
                type: "POST",
                dataType: "json",
                data: {
                    id_token: response.credential
                },
                success: function(data) {
                    // Aquí puedes manejar la respuesta del servidor después de la validación
                    // Por ejemplo, redirigir al usuario a otra página si el inicio de sesión es exitoso
                    if (data.success) {
                        window.location.href = "https://softecuestre.com.ar/src/sistema/gestion.php";
                    } else {
                        alert("Error al iniciar sesión. Por favor, inténtalo de nuevo.");
                    }
                },
                error: function() {
                    alert("Error al comunicarse con el servidor. Por favor, inténtalo de nuevo.");
                }
            });
        }
    </script>
</body>
</html>

