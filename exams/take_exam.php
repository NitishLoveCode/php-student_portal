<?php
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    redirect(SITE_URL . '/auth/login.php');
}

// Check if exam_id is provided
if (!isset($_GET['exam_id'])) {
    redirect(SITE_URL);
}

$exam_id = sanitizeInput($_GET['exam_id']);
$student_id = $_SESSION['student_id'];

// Get exam details
$query = "SELECT * FROM exams WHERE id = '$exam_id'";
$result = $conn->query($query);
$exam = $result->fetch_assoc();

if (!$exam) {
    redirect(SITE_URL);
}

// Get questions for the exam
$questions = getExamQuestions($exam_id);

// Check if exam has questions
if (count($questions) === 0) {
    die("This exam has no questions yet.");
}

$page_title = 'Take Exam: ' . htmlspecialchars($exam['title']);
require_once '../includes/header.php';
?>

<div class="take-exam">
    <h2><?php echo htmlspecialchars($exam['title']); ?></h2>
    <p><?php echo htmlspecialchars($exam['description']); ?></p>
    <p class="exam-info">Duration: <?php echo $exam['duration_minutes']; ?> minutes | Questions: <?php echo count($questions); ?></p>
    
    <form id="exam-form" action="submit_exam.php" method="post">
        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
        
        <div class="questions">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <h3>Question <?php echo $index + 1; ?></h3>
                    <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                    
                    <div class="options">
                        <label>
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="a" required>
                            <?php echo htmlspecialchars($question['option_a']); ?>
                        </label>
                        
                        <label>
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="b">
                            <?php echo htmlspecialchars($question['option_b']); ?>
                        </label>
                        
                        <label>
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="c">
                            <?php echo htmlspecialchars($question['option_c']); ?>
                        </label>
                        
                        <label>
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="d">
                            <?php echo htmlspecialchars($question['option_d']); ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button type="submit" class="btn">Submit Exam</button>
    </form>
</div>

<script>
// Timer functionality
const durationMinutes = <?php echo $exam['duration_minutes']; ?>;
let timeLeft = durationMinutes * 60;

function updateTimer() {
    const minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    document.getElementById('timer').textContent = `${minutes}:${seconds}`;
    
    if (timeLeft <= 0) {
        document.getElementById('exam-form').submit();
    } else {
        timeLeft--;
        setTimeout(updateTimer, 1000);
    }
}

// Start timer
document.addEventListener('DOMContentLoaded', function() {
    updateTimer();
});
</script>

<?php require_once '../includes/footer.php'; ?>