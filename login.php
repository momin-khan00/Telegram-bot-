<?php
require_once '../common/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Restrict in production

$response = ['success' => false, 'message' => 'Invalid credentials.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $input['password'] ?? '';

    if ($email && $password) {
        try {
            $stmt = $pdo->prepare("SELECT id, full_name, email, password, role FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);

                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['full_name'];
                
                $response['success'] = true;
                $response['message'] = 'Login successful.';
                $response['user'] = [
                    'id' => $user['id'],
                    'fullName' => $user['full_name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                // Don't send the password hash back
            }
        } catch (PDOException $e) {
             $response['message'] = 'Server error.';
        }
    }
}

echo json_encode($response);
