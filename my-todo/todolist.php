<?php
include 'db.php';

if(isset($_POST['add'])){
    $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
        '".$_POST['task']."',
        'open'
    )";

    $run_q_insert = mysqli_query($conn, $q_insert);
    if($run_q_insert){
        header('Refresh:0; url=todolist.php');
    }
}

$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);


if(isset($_GET['delete'])){
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=todolist.php');
}

if(isset($_GET['done'])){
    $status = 'close';
    if ($_GET['status'] == 'open'){
        $status = 'close';
    } else{
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('Refresh:0; url=todolist.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuDudu List</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Box Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
    <link rel="icon" type="image/x-icon" href="asset/logo.svg">
</head>
<body>
    <section class="todo-page">
    <div class="todo-img">
        <span>Make Your Plans!</span>
        <img src="asset/illust-todo.png" alt="Tududu">
    </div>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="title">
                <i class='bx bxs-left-arrow' onclick="window.location.href='index.php'" title="Back"></i>
                <span>To Do List</span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        
        <!-- Konten -->
        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Add Task">
                    <div class="text-right">
                        <button type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>

            <!-- Task -->
            <?php
            if(mysqli_num_rows($run_q_select) > 0){
                while($r = mysqli_fetch_array($run_q_select)){
            ?>
            <div class="card">
                <div class="task-item <?= $r['task_status'] == 'close' ? 'done':''?>">
                    <div>
                        <input type="checkbox" onclick="window.location.href='?done=<?= $r['task_id']?>&status=<?=$r['task_status']?>'" <?= $r['task_status'] == 'close' ? 'checked':''?>>
                        <span class="list"><?= $r['task_lable']?></span>
                    </div>
                    <div class="edit-del">
                        <a href="edit.php?id=<?= $r['task_id']?>" class="edit-task" title="Edit"><i class='bx bx-edit-alt'></i></a>
                        <a href="?delete=<?= $r['task_id']?>" class="delete-task" title="Remove" onclick="return confirm ('Are you sure? 🤔')" value="Show alert box"><i class='bx bx-trash' ></i></a>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
                <div>No data yet 🧞‍♂️</div>
            <?php } ?>
        </div>
    </div>
    
    </section>
    
</body>
</html>