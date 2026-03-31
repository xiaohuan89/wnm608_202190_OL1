<?php
$json = file_get_contents("../data/users.json");
$users = json_decode($json);

$id = $_GET['id'] ?? 0;

if(!isset($users[$id])) {
  die("User not found");
}

$user = $users[$id];
$classes = implode(", ", $user->classes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Editor Form</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background: #f3f3f3;
      color: #0f172a;
    }

    .editor-page {
      max-width: 820px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .back-link {
      display: inline-block;
      margin-bottom: 24px;
      color: #2aa7d6;
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .editor-card {
      background: #ffffff;
      border-radius: 22px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      padding: 34px 30px;
    }

    .editor-card h1 {
      font-size: 32px;
      margin: 0 0 28px;
      color: #0b1533;
    }

    .user-form {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .user-form label {
      font-size: 16px;
      font-weight: 700;
      color: #16213e;
      margin-top: 6px;
    }

    .user-form input {
      width: 100%;
      padding: 18px 16px;
      font-size: 16px;
      border: 1px solid #d7d7d7;
      border-radius: 18px;
      background: #fff;
      outline: none;
      box-sizing: border-box;
    }

    .user-form input:focus {
      border-color: #2d5566;
      box-shadow: 0 0 0 3px rgba(45, 85, 102, 0.12);
    }

    .btn-save {
      margin-top: 18px;
      padding: 18px;
      border: none;
      border-radius: 14px;
      background: #2d5566;
      color: white;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      transition: 0.2s ease;
    }

    .btn-save:hover {
      background: #234653;
    }
  </style>
</head>
<body>
  <div class="editor-page">
    <a href="users.php" class="back-link">← Back to Home</a>

    <div class="editor-card">
      <h1>User Editor Form</h1>

      <form action="" method="post" class="user-form">
        <label>Name</label>
        <input type="text" name="name" value="<?=$user->name?>">

        <label>Type</label>
        <input type="text" name="type" value="<?=$user->type?>">

        <label>Email</label>
        <input type="email" name="email" value="<?=$user->email?>">

        <label>Classes</label>
        <input type="text" name="classes" value="<?=$classes?>">

        <button type="submit" class="btn-save">Save</button>
      </form>
    </div>
  </div>
</body>
</html>