<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    redirect(SITE_URL . '/auth/login.php');
}

$student_id = $_SESSION['student_id'];
$student = getStudentById($student_id);
$exams = getExams();
$results = getStudentResults($student_id);

$page_title = 'Dashboard';
require_once 'includes/header.php';
?>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($student['first_name']); ?>!</h2>
    
    <div class="dashboard-sections">
        <section class="upcoming-exams">
            <h3>Available Exams</h3>
            <?php if (count($exams) > 0): ?>
                <ul>
                    <?php foreach ($exams as $exam): ?>
                        <li>
                            <h4><?php echo htmlspecialchars($exam['title']); ?></h4>
                            <p><?php echo htmlspecialchars($exam['description']); ?></p>
                            <p>Duration: <?php echo $exam['duration_minutes']; ?> minutes</p>
                            <a href="<?php echo SITE_URL; ?>/exams/take_exam.php?exam_id=<?php echo $exam['id']; ?>" class="btn">Take Exam</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No exams available at the moment.</p>
            <?php endif; ?>
        </section>
        
        <section class="recent-results">
            <h3>Your Recent Results</h3>
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
                <a href="<?php echo SITE_URL; ?>/results/view_results.php" class="btn">View All Results</a>
            <?php else: ?>
                <p>You haven't taken any exams yet.</p>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>