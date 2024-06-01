<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/passSlipForm.css">
    <title>Pass Slip</title>
</head>
<body>
    <div class="form-container">
        <form action="passSlip.php" method="POST">
            <h2>PASS SLIP</h2>
            <label for="requester">Requester</label>
            <input type="text" id="requester" name="requester" required>

            <label for="section">Section</label>
            <input type="text" id="section" name="section" required>

            <div class="radio-group">
                <label>Type</label>
                <input type="radio" id="individual" name="type" value="Individual" checked>
                <label for="individual">Individual</label>
                <input type="radio" id="class" name="type" value="Class">
                <label for="class">Class</label>
            </div>

            <label for="purpose">Purpose</label>
            <input type="text" id="purpose" name="purpose" required>

            <label for="details">Details</label>
            <textarea id="details" name="details" required></textarea>

            <label for="subjectTeacher">Subject Teacher</label>
            <select id="subjectTeacher" name="subjectTeacher" required>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['firstname'] . ' ' . $teacher['lastname']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="adviser">Adviser</label>
            <select id="adviser" name="adviser" required>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['firstname'] . ' ' . $teacher['lastname']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="csd">CSD</label>
            <select id="csd" name="csd" required>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['firstname'] . ' ' . $teacher['lastname']; ?></option>
                <?php endforeach; ?>
            </select>

            <div class="button-group">
                <button type="button" onclick="back()">Cancel</button>
                <button type="submit" name="submit">Submit</button>  
            </div>
        </form>
        <script src="assets/js/back.js"></script>
        <script src="assets/js/sidebar.js"></script>
    </div>
</body>
</html>
