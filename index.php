<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/3/2016
 * Time: 6:24 PM
 *
 *
 * Description: This page is in charge of reading from NoteDB.sqlite database file and then if there is any data, it
 * will show note list in table. Each note has information such as author name, the link
 * , date created/updated and number of their noted body text characters.
 * Also in this page, user will be able to add new notes and it will be redirected to addNote.php file.
 * Furthermore, for inquiring more information about each note,
 * user can click on the related button and it will send note id to viewNote.php file using GET method later.
 * Besides, there is logout button that will destroy the user session and it will be redirected to login.php page.
 *
 */
require_once 'myFileRepository.php';
require_once 'Note.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index Page</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">


        button {
            margin-top: 20px;
            width: 150px;
            height: 40px;

        }

        select {
            border-style: solid;
            border-width: 2px;
            width: 250px;
        }

        #main-Div {

            margin-left: 100px;
            margin-bottom: 100px;
            margin-right: 100px;
            background-color: #cccccc;
            width: 800px;
            height: 600px;
        }

        input, textarea {
            width: 250px;
            border-style: solid;
            border-width: 2px;
            display: inline-block;
        }


    </style>
</head>


<body>


<div id="main-Div">


    <h1>Notes List</h1>

    <table class="table table-bordered">
        <?php
        $fileRepo = new \massa\p3\myFileRepository();
        $dataArray = $fileRepo->getAllNotes();
        if ($dataArray) {
            echo '<tr class="info"><th>Author Name</th><th>Subject Line</th> <th>Date Created/Edited</th><th>Number of characters</th></tr>';
            foreach ($dataArray as $note) {
                //  print_r($note);
                echo '<tr class="info">';
                echo '<td>';
                echo $note->getAuthorName();
                echo '</td>';
                echo '<td>';
                // echo $note->getSubjectLine();
                echo '<a class="btn btn-default btn-sm" role="button" href="viewNote.php?id=' . $note->getNoteID() . '">' . $note->getSubjectLine() . '</a>';
                echo '</td>';
                echo '<td>';
                echo $note->getDate();
                echo '</td>';
                echo '<td>';
                //echo mb_strlen($note->getNoteBody());
                echo $note->getNumOfChar();
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo 'There is no data in the file!!!';
        }

        ?>
    </table>
    <form method="post" action="addNote.php" enctype="multipart/form-data">
        <input type="hidden" name="addNoteSubmitted" value="set">
        <input type="submit" id="myButton" value="Add Note" class="btn btn-success btn-lg">
    </form>

<a style="margin-top: 10px;width: 170px;" href="login.php?logout=1" class="btn btn-lg btn-danger"> Log out</a>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

