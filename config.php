
<?php
// --- DATABASE CONFIGURATION ---
define('DB_HOST', 'sql109.infinityfree.com');
define('DB_USER', 'if0_39608724');
define('DB_PASS', 'DGu6OOjEYty');
define('DB_NAME', 'if0_39608724_SkillzUp');

// --- SITE CONFIGURATION ---
define('BASE_URL', 'https://skillzup.great-site.net');

// --- DATABASE CONNECTION (PDO) ---
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, you would log this error and show a generic message
    die("ERROR: Could not connect. " . $e->getMessage());
}

// --- SECURE SESSION MANAGEMENT ---
function secure_session_start() {
    $session_name = 'secure_session_id';
    $secure = isset($_SERVER['HTTPS']); // Use HTTPS in production
    $httponly = true; // Prevent JavaScript access to the session cookie

    ini_set('session.use_only_cookies', 1);
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly
    );

    session_name($session_name);
    session_start();

    // Regenerate session ID periodically to prevent session fixation
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) { // 30 minutes
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
    
    // Bind session to IP address
    if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
        session_unset();
        session_destroy();
        session_start();
    }
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
}

secure_session_start();

// --- HELPER FUNCTIONS ---

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function formatPrice($price) {
    return '$' . number_format($price, 2);
}

// --- CSRF TOKEN MANAGEMENT ---
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        return true;
    }
    return false;
}

// Set a default CSRF token for forms
$csrf_token = generateCsrfToken();
