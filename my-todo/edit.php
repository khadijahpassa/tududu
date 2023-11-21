<?php
include 'db.php';
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);
$d =  mysqli_fetch_object($run_q_select);

if(isset($_POST['edit'])){
    $q_update = "UPDATE task SET task_lable = '".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);

    header ('Refresh:0; url=todolist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit TuDudu List</title>
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
                <i class='bx bx-edit-alt'></i>
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
                    <input name="task" type="text" class="input-control" placeholder="Edit Task" value="<?= $d->task_lable?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                </form>
            </div>
            
            

        </div>
    </div>
    </section>
    
</body>
</html>