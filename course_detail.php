<?php
require_once '../common/config.php';

// Set headers for JSON and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Restrict in production

$response = ['success' => false, 'message' => 'Course not found.'];
$course_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($course_id) {
    try {
        // Main course details
        $stmt = $pdo->prepare("
            SELECT 
                c.id, c.title, c.subtitle, c.description, c.thumbnail_url, c.price,
                u.full_name as instructor_name, u.email as instructor_email 
            FROM courses c
            JOIN users u ON c.instructor_id = u.id
            WHERE c.id = ? AND c.status = 'approved'
        ");
        $stmt->execute([$course_id]);
        $course = $stmt->fetch();

        if ($course) {
            // In a real application, you would make separate queries for chapters and reviews
            // For now, we'll hardcode them into the response object
            
            // Fetch chapters and lessons (placeholder)
            $chapters = [
                ['id' => 1, 'title' => 'Module 1: The Core Concepts', 'lessons' => [
                    ['title' => 'The Event Loop Revisited', 'duration' => '12:45'],
                    ['title' => 'Deep Dive into Closures', 'duration' => '15:30']
                ]],
                ['id' => 2, 'title' => 'Module 2: Asynchronous JavaScript', 'lessons' => [
                    ['title' => 'Callbacks vs Promises', 'duration' => '10:00'],
                    ['title' => 'Mastering Async/Await', 'duration' => '18:20']
                ]]
            ];

            // Fetch reviews (placeholder)
            $reviews = [
                ['author' => 'Jane S.', 'rating' => 5, 'comment' => 'This course is incredible! Changed the way I write JavaScript.'],
                ['author' => 'Mike R.', 'rating' => 5, 'comment' => 'The instructor is clear, concise, and explains complex topics with ease.']
            ];

            $response['success'] = true;
            $response['course'] = $course;
            $response['course']['chapters'] = $chapters;
            $response['course']['reviews'] = $reviews;
            unset($response['message']); // Remove the default "not found" message
        }
    } catch (PDOException $e) {
        $response['message'] = 'A server error occurred.';
    }
} else {
    $response['message'] = 'Invalid course ID provided.';
}

echo json_encode($response);
