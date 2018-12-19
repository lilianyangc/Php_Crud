<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-06
 * Time: 3:56 PM
 */

include "inclusions/functions.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <meta name="description" content="Php assignment on CRUD">
    <meta name="keywords" content="HTML,PHP,Bootstrap4">
    <meta name="author" content="Maria Lilian Yang">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        table{
            width: 80%
        }

        #pages {
            height:224px;
            overflow:auto;
            background:#fff;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php">CRUD</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="about.php">About <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="createnewrecord.php">Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="appendfiletocurrent.php">Import</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="export.php">Export</a>
            </li>

        </ul>

    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class=" col-md-12 justify-content-center">
            <div>
                <div class="col-sm-10 offset-sm-1 text-center">

                    <a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>