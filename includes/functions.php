<?php
require_once 'db.php';

function isLoggedIn() {
    return isset($_SESSION['student_id']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

function getStudentById($id) {
    global $conn;
    $id = sanitizeInput($id);
    $query = "SELECT * FROM students WHERE id = '$id'";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

function getExams() {
    global $conn;
    $query = "SELECT * FROM exams";
    $result = $conn->query($query);
    $exams = [];
    while ($row = $result->fetch_assoc()) {
        $exams[] = $row;
    }
    return $exams;
}

function getExamQuestions($exam_id) {
    global $conn;
    $exam_id = sanitizeInput($exam_id);
    $query = "SELECT * FROM questions WHERE exam_id = '$exam_id'";
    $result = $conn->query($query);
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    return $questions;
}

function calculateExamResult($student_id, $exam_id, $answers) {
    global $conn;
    
    // Get all questions for the exam
    $questions = getExamQuestions($exam_id);
    $total_questions = count($questions);
    $score = 0;
    
    // Calculate score
    foreach ($questions as $question) {
        $question_id = $question['id'];
        if (isset($answers[$question_id])) {  // FIXED SYNTAX ERROR
            if ($answers[$question_id] == $question['correct_answer']) {
                $score++;
            }
        }
    }
    
    // Calculate percentage
    $percentage = ($score / $total_questions) * 100;
    
    // Save result
    $student_id = sanitizeInput($student_id);
    $exam_id = sanitizeInput($exam_id);
    $score = sanitizeInput($score);
    $total_questions = sanitizeInput($total_questions);
    $percentage = sanitizeInput($percentage);
    
    $query = "INSERT INTO results (student_id, exam_id, score, total_questions, percentage) 
              VALUES ('$student_id', '$exam_id', '$score', '$total_questions', '$percentage')";
    $conn->query($query);
    
    return [
        'score' => $score,
        'total_questions' => $total_questions,
        'percentage' => $percentage
    ];
}


function getStudentResults($student_id) {
    global $conn;
    $student_id = sanitizeInput($student_id);
    $query = "SELECT r.*, e.title as exam_title 
              FROM results r 
              JOIN exams e ON r.exam_id = e.id 
              WHERE r.student_id = '$student_id' 
              ORDER BY r.submitted_at DESC";
    $result = $conn->query($query);
    $results = [];
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    return $results;
}
?>