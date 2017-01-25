<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/3/2016
 * Time: 10:15 PM
 *
 * Description: This page will allow user to enter note data, which contains author name, subject and note body. Author name and
 * subject are required data field so whenever user wants to enter new note without these fields, it will get an error stated
 * user should enter the required field. If user click on add note button, it will save new note to the database file.
 */

require_once 'Note.php';
require_once 'myFileRepository.php';

date_default_timezone_set('America/Chicago');
$isValid = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authorName = isset($_POST['authorName']) ? htmlspecialchars(trim($_POST['authorName'])) : '';
    $noteBody = isset($_POST['noteBody']) ? htmlspecialchars(trim($_POST['noteBody'])) : '';
    $subjectLine = isset($_POST['subjectLine']) ? htmlspecialchars(trim($_POST['subjectLine'])) : '';
    if ($authorName == '' && isset($_POST['addNoteConfirmed'])) {
        $isValid=1;

        ?> <span class="error">*Author name is required!</span>
        <div id="main-Div">
            <h2>Add Note</h2>
            <form enctype="multipart/form-data" action="#" method="post">
                <table>
                    <tr>
                        <td>Author Name :</td>
                        <td><input name="authorName" value="<?php echo $authorName; ?>" id="authorName" type="text" style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Subject Line :</td>
                        <td><input name="subjectLine" value="<?php echo $subjectLine; ?>" id="subjectLine" type="text" style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Note Body:</td>
                        <td><textarea id="noteBody" name="noteBody"><?php echo $noteBody; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>

                            <input type="hidden" name="addNoteConfirmed" value="set">
                            <input type="submit" class="btn btn-success" role="button" id="addNote" value="Add a new note" class="btn btn-success btn-lg">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php

    }
    if ($subjectLine == '' && isset($_POST['addNoteConfirmed'])) {
        $isValid=1;

        ?> <span class="error">*Subject Line is required!</span>
        <div id="main-Div">
            <h2>Add Note</h2>
            <form enctype="multipart/form-data" action="#" method="post">
                <table>
                    <tr>
                        <td>Author Name :</td>
                        <td><input name="authorName" value="<?php echo $authorName; ?>" id="authorName" type="text" style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Subject Line :</td>
                        <td><input name="subjectLine" value="<?php echo $subjectLine; ?>" id="subjectLine" type="text" style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Note Body:</td>
                        <td><textarea id="noteBody" name="noteBody"><?php echo $noteBody; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>

                            <input type="hidden" name="addNoteConfirmed" value="set">
                            <input type="submit" class="btn btn-success" role="button" id="addNote" value="Add a new note" class="btn btn-success btn-lg">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php

    }

    elseif ($authorName != '') {
        $isValid = 2;
    }



}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
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
            width: 600px;
            height: 600px;
        }

        #second-Div {

            margin-left: 100px;
            margin-bottom: 100px;
            margin-right: 100px;
            background-color: #cccccc;
            width: 600px;
            height: 300px;
        }

        input, textarea {
            width: 250px;
            border-style: solid;
            border-width: 2px;
            display: inline-block;
        }

        #noteBody {
            height: 200px;
            resize: none;
        }

        .error {
            color: red;
        }


    </style>
</head>
<body>
<?php
if ($isValid==2) {
    $note = new \massa\p3\Note();
    $fileRep = new \massa\p3\myFileRepository();
    $note->setAuthorName($authorName);
    $note->setNoteBody($noteBody);
    $note->setSubjectLine($subjectLine);
    $fileRep->SaveNote($note);

    echo '<div id="second-Div">';
    echo '<h2>The new Note has been added!!!</h2>';
    echo '<a href="index.php" role="button" class="btn btn-primary btn-lg">Home</a>';
    echo '</div>';
} elseif($isValid==0) {
    ?>


    <div id="main-Div">
        <h2>Add Note</h2>
        <form enctype="multipart/form-data" action="#" method="post">
            <table>
                <tr>
                    <td>Author Name :</td>
                    <td><input name="authorName" id="authorName" type="text" style="margin-top: 10px"></td>
                </tr>
                <tr>
                    <td>Subject Line :</td>
                    <td><input name="subjectLine" id="subjectLine" type="text" style="margin-top: 10px"></td>
                </tr>
                <tr>
                    <td>Note Body:</td>
                    <td><textarea id="noteBody" name="noteBody"></textarea></td>
                </tr>
                <tr>
                    <td>

                        <input type="hidden" name="addNoteConfirmed" value="set">
                        <input type="submit" class="btn btn-success" role="button" id="addNote" value="Add a new note" class="btn btn-success btn-lg">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php

}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
