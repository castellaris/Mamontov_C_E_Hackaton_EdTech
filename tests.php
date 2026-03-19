<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем мультиязычность

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$selected_test = $_POST['selected_test'] ?? null;
$answers = $_POST['answers'] ?? null;
$result_message = '';
$recommendation_message = '';
$description_message = '';

$tests_map = [
    'burnout'   => 'burnout_test',
    'stress'    => 'stress_test',
    'emotional' => 'emotional_state_test',
    'anxiety'   => 'anxiety_test'
];

if ($selected_test && !$answers) {
    $table = $tests_map[$selected_test];
    $stmt = $pdo->query("SELECT question_id, question FROM $table");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($answers) {
    $table = $tests_map[$selected_test];
    $score = count(array_filter($answers, fn($a) => strtolower($a) === 'да' || strtolower($a) === 'yes' || strtolower($a) === 'иә'));

    if ($score <= 2) {
        $result_message = $translations[$lang]['result_low'];
        $description_message = $translations[$lang]['desc_normal'];
        $recommendation_message = $translations[$lang]['rec_balance'];
    } elseif ($score <= 4) {
        $result_message = $translations[$lang]['result_medium'];
        $description_message = $translations[$lang]['desc_tension'];
        $recommendation_message = $translations[$lang]['rec_rest'];
    } else {
        $result_message = $translations[$lang]['result_high'];
        $description_message = $translations[$lang]['desc_high_tension'];
        $recommendation_message = $translations[$lang]['rec_specialist'];
    }

    foreach ($answers as $qid => $resp) {
        $stmt = $pdo->prepare("UPDATE $table 
            SET response = :resp, who_responsed = :user, recommendations = :rec 
            WHERE question_id = :qid");
        $stmt->execute([
            'resp' => $resp,
            'user' => $username,
            'rec'  => $recommendation_message,
            'qid'  => $qid
        ]);
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container mt-5">
    <h2><?= $translations[$lang]['choose_test'] ?></h2>
    <form method="post">
        <select name="selected_test" class="form-select mb-3">
            <option value="burnout"   <?= $selected_test==='burnout'?'selected':'' ?>><?= $translations[$lang]['test_burnout'] ?></option>
            <option value="stress"    <?= $selected_test==='stress'?'selected':'' ?>><?= $translations[$lang]['test_stress'] ?></option>
            <option value="emotional" <?= $selected_test==='emotional'?'selected':'' ?>><?= $translations[$lang]['test_emotional'] ?></option>
            <option value="anxiety"   <?= $selected_test==='anxiety'?'selected':'' ?>><?= $translations[$lang]['test_anxiety'] ?></option>
        </select>
        <button type="submit" class="btn btn-primary"><?= $translations[$lang]['start'] ?></button>
    </form>

    <?php if (!empty($questions)): ?>
        <form method="post" class="mt-4">
            <input type="hidden" name="selected_test" value="<?= htmlspecialchars($selected_test) ?>">
            <?php foreach ($questions as $q): ?>
                <div class="mb-3">
                    <label class="form-label"><?= htmlspecialchars($q['question']) ?></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?= $q['question_id'] ?>]" value="<?= $translations[$lang]['yes'] ?>" required>
                        <label class="form-check-label"><?= $translations[$lang]['yes'] ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?= $q['question_id'] ?>]" value="<?= $translations[$lang]['no'] ?>" required>
                        <label class="form-check-label"><?= $translations[$lang]['no'] ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success"><?= $translations[$lang]['finish_test'] ?></button>
        </form>
    <?php endif; ?>

    <?php if ($result_message): ?>
        <div class="mt-4">
            <h3><?= htmlspecialchars($result_message) ?></h3>
            <p><strong><?= $translations[$lang]['description'] ?>:</strong> <?= htmlspecialchars($description_message) ?></p>
            <p><strong><?= $translations[$lang]['recommendations'] ?>:</strong> <?= htmlspecialchars($recommendation_message) ?></p>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
