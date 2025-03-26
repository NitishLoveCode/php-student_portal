<?php
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    redirect(SITE_URL . '/auth/login.php');
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['exam_id'])) {
    redirect(SITE_URL);
}

$exam_id = sanitizeInput($_POST['exam_id']);
$student_id = $_SESSION['student_id'];
$answers = $_POST['answers'] ?? [];

// Calculate result
$result = calculateExamResult($student_id, $exam_id, $answers);

$page_title = 'Exam Submitted';
require_once '../includes/header.php';
?>

<div class="exam-result">
    <h2>Exam Submitted Successfully</h2>
    
    <div class="result-summary">
        <h3>Your Result</h3>
        <p>Score: <?php echo $result['score']; ?>/<?php echo $result['total_questions']; ?></p>
        <p>Percentage: <?php echo $result['percentage']; ?>%</p>
    </div>
    
    <div class="actions">
        <a href="<?php echo SITE_URL; ?>/results/view_results.php" class="btn">View All Results</a>
        <a href="<?php echo SITE_URL; ?>" class="btn">Back to Dashboard</a>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>