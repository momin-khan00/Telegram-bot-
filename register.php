<?php
require_once '../common/config.php';

// Set header to return JSON
header('Content-Type: application/json');
// Handle CORS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *'); // In production, restrict this to your Netlify domain
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit(0);
}
header('Access-Control-Allow-Origin: *'); // In production, restrict this to your Netlify domain

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $full_name = sanitize($input['full_name'] ?? '');
    $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $input['password'] ?? '';

    // --- Validation ---
    if (empty($full_name) || empty($email) || empty($password)) {
        $response['message'] = 'Please fill in all fields.';
    } elseif (strlen($password) < 8) {
        $response['message'] = 'Password must be at least 8 characters long.';
    } else {
        try {
            // Check if user already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $response['message'] = 'An account with this email already exists.';
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user
                $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'student')");
                if ($stmt->execute([$full_name, $email, $hashed_password])) {
                    $response['success'] = true;
                    $response['message'] = 'Registration successful! You can now log in.';
                } else {
                    $response['message'] = 'Database error: Could not register user.';
                }
            }
        } catch (PDOException $e) {
            // In production, log the error instead of echoing
            $response['message'] = 'A server error occurred. Please try again later.';
        }
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
