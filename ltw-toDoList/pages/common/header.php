<?php include_once('database/users.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>To Do List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Cherry+Swash" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

<header>
    <div id="info">
        <h1><a href="index.php">To Do List</a></h1>
    </div>
    <?php include_once('user.php'); ?>
</header>

<nav id="menu">
    <ul>
        <li><a href="../myProfile.php">Profile</a></li>
        <li><a href="../search.php">Search</a></li>
        <li><a href="../myShares.php">Shares</a></li>
    </ul>
</nav>