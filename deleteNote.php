<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/4/2016
 * Time: 11:11 PM
 *
 *
 * Description: It will notify that the note has been deleted and it will delete the note from NoteDB.sqlite database file.
 * User can go back to home page either.
 */

require_once 'Note.php';
require_once 'myFileRepository.php';
$fileRepo = new \massa\p3\myFileRepository();
$isValid = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['deleteConfirmed'])) {
    $noteId = $_POST['deleteConfirmed'];
    $note = $fileRepo->getNoteById($noteId);
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete View</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style type="text/css">


            button {
                margin-top: 20px;
                width: 150px;
                height: 40px;

            }

            #main-Div {

                margin-left: 100px;
                margin-bottom: 100px;
                margin-right: 100px;
                background-color: #cccccc;
                width: 700px;
                height: 250px;
            }
        </style>
    </head>
    <body>
    <div id="main-Div">
        <h2>The Note has been deleted</h2><br>
        <?php $fileRepo->deleteNote($note); ?>
        <a href="index.php" class="btn btn-primary btn-sm">Home</a>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php

} else {
    echo 'There is nothing to delete!';
}