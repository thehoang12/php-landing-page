<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   Trang quản lý 
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="/assets/admin.css" rel="stylesheet" />
</head>

    <body>
        <?php
            include 'layouts/admin/header.php';
        ?>
        <?php
            include $content;
        ?>
    </body>
</html>