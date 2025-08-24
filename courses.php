<?php
require_once '../common/config.php';

// Set headers for JSON and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Restrict in production to your Netlify domain

$response = ['success' => false, 'courses' => []];

try {
    // Select all courses that are approved, and join with the users table to get the instructor's name
    $stmt = $pdo->prepare("
        SELECT 
            c.id, 
            c.title, 
            c.subtitle,
            c.description,
            c.thumbnail_url,
            c.price,
            u.full_name as instructor_name
        FROM courses c
        JOIN users u ON c.instructor_id = u.id
        WHERE c.status = 'approved'
    ");
    
    $stmt->execute();
    $courses = $stmt->fetchAll();

    $response['success'] = true;
    $response['courses'] = $courses;

} catch (PDOException $e) {
    // In a real app, log this error
    $response['message'] = 'A server error occurred while fetching courses.';
}

echo json_encode($response);
