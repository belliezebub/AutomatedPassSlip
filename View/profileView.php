<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/dashboardstyle.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <script src="assets/js/uploadscript.js" defer></script>
</head>
<body>
    <div class="container">
        <?php include 'View/Sidebar.php'?>
        <div class="main-content">
            <form id="upload-form" action="Controller/DashboardController.php" method="post" enctype="multipart/form-data">
                <div class="profile-pic" id="profile-pic" style="background-image: url('<?php echo isset($user['profile_picture']) ? $user['profile_picture'] : 'default.png'; ?>');">
                    <input id="file-upload" type="file" name="file" accept="image/jpeg, image/jpg" style="display:none;">
                </div>
                <button type="button" id="add-photo-btn" class="btn">Add Photo</button>
            </form>
            <div class="profile-info">
                <h1><?php echo isset($user['firstname']) && isset($user['lastname']) ? $user['firstname'] . ' ' . $user['lastname'] : ''; ?></h1>
                <p><h4><em><?php echo isset($user['batch']) && isset($user['section']) ? $user['batch'] . '-' . $user['section'] : ''; ?></em></h4></p>
                <p><h4><em><?php echo isset($user['id']) ? $user['id'] : ''; ?></em></h4></p>
            </div>
            <div class="tasks">
                <div class="task-box" id="pending" onclick="location.href='link_to_pending_tasks.php'">Pending: <br><h1><?php echo isset($pendingTasks) ? $pendingTasks : 0; ?></h1></div>
                <div class="task-box" id="unprocessed" onclick="location.href='link_to_unprocessed_tasks.php'">Unprocessed:<br><h1><?php echo isset($unprocessedTasks) ? $unprocessedTasks : 0; ?></h1></div>
                <div class="task-box" id="complete" onclick="location.href='link_to_complete_tasks.php'">Complete:<br><h1><?php echo isset($completedTasks) ? $completedTasks : 0; ?></h1></div>
            </div>
            <div class="new">
                <button class="newForm" onclick="location.href='index.php?page=form'">
                    <img class="newButton" src="assets/img/newForm.png" alt="New Form">
                </button>
            </div>          
        </div>
    </div>
</body>
</html>
