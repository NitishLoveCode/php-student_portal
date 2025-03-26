<?php
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    redirect(SITE_URL . '/auth/login.php');
}

$student_id = $_SESSION['student_id'];
$results = getStudentResults($student_id);

$page_title = 'Your Exam Results';
require_once '../includes/header.php';
?>

<div class="view-results">
    <h2>Your Exam Results</h2>
    
    <?php if (count($results) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Score</th>
                    <th>Percentage</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['exam_title']); ?></td>
                        <td><?php echo $result['score']; ?>/<?php echo $result['total_questions']; ?></td>
                        <td><?php echo $result['percentage']; ?>%</td>
                        <td><?php echo date('M j, Y', strtotime($result['submitted_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You haven't taken any exams yet.</p>
    <?php endif; ?>
    
    <a href="<?php echo SITE_URL; ?>" class="btn">Back to Dashboard</a>
</div>

<?php require_once '../includes/footer.php'; ?>