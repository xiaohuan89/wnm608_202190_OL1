<?php
$json = file_get_contents("../data/users.json");
$users = json_decode($json);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User List</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background: #f3f3f3;
      color: #0f172a;
    }

    .page {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    h1 {
      margin-top: 0;
      font-size: 42px;
      color: #0b1533;
    }

    ul {
      padding-left: 20px;
    }

    li {
      margin: 14px 0;
      font-size: 22px;
    }

    a {
      color: #2d5566;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="page">
    <div class="card">
      <h1>User List</h1>

      <ul>
        <?php foreach($users as $index => $user): ?>
          <li>
            <a href="user.php?id=<?=$index?>">
              <?=$user->name?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</body>
</html>