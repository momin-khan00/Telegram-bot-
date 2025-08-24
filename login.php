<?php
/**
 * CORS HEADERS - इन्हें सबसे ऊपर रखें
 */
header("Access-Control-Allow-Origin: *"); // प्रोडक्शन में '*' की जगह 'https://your-netlify-site.app' डालें
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// ब्राउज़र पहले एक OPTIONS रिक्वेस्ट भेजता है, उसे हैंडल करना ज़रूरी है
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
// --- CORS का हिस्सा यहाँ खत्म होता है ---


// अब आपका बाकी का PHP कोड शुरू होगा
require_once '../common/config.php';

header('Content-Type: application/json'); // यह लाइन यहीं रहेगी

// ... बाकी का पूरा कोड जैसा था वैसा ही रहेगा ...
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
