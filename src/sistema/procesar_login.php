<?php
// Verificar si se recibió el token de ID del usuario
if (isset($_POST['id_token'])) {
    $id_token = $_POST['id_token'];

    // Enviar la solicitud al servidor de Google para validar el token
    $url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $id_token;
    $response = file_get_contents($url);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Verificar si la respuesta es válida
    if ($data && isset($data['sub'])) {
        // El token es válido y se puede confiar en él

        // Aquí puedes realizar cualquier lógica adicional, como verificar el dominio del correo electrónico, consultar una base de datos de usuarios, etc.

        // Por ejemplo, podrías almacenar la información del usuario en una sesión
        session_start();
        $_SESSION['user_id'] = $data['sub'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['email'] = $data['email'];

        // Devolver una respuesta exitosa al frontend
        $response = array('success' => true);
        echo json_encode($response);
        exit;
    }
}

// Si no se recibió un token válido, devolver una respuesta de error
$response = array('success' => false);
echo json_encode($response);
?>