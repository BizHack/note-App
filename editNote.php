<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/8/2016
 * Time: 11:33 PM
 *
 *
 * Description: It will show current information of that specific note and it will allow user to change author name
 * and note body with the condition of not leave the author name field empty.
 * After submitting the edited version of the note, it will change it in the database file.
 */

require_once 'myFileRepository.php';
require_once 'Note.php';
date_default_timezone_set('America/Chicago');
$fileRepo = new \massa\p3\myFileRepository();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['editPushed'])) {
    //echo 'Edit Works';
    $noteId = $_POST['editPushed'];
    $note = $fileRepo->getNoteById($noteId);
    $authorName = $note->getAuthorName();
    $noteBody = $note->getNoteBody();
    $subjectLine=$note->getSubjectLine();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Note</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style type="text/css">


            #button, #button1 {
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

            input, textarea {
                width: 250px;
                border-style: solid;
                border-width: 2px;
                display: inline-block;
            }

            #noteBody, #noteBody1 {
                height: 200px;
                resize: none;
            }

            .error {
                color: red;
            }


        </style>

    </head>
    <body>
    <h2>Edit Note</h2>
    <div id="main-Div">
        <form enctype="multipart/form-data" action="#" method="post">
            <table>
                <tr>
                    <td>Author Name :</td>
                    <td><input name="authorName" value="<?php echo $authorName; ?>" id="authorName" type="text"
                               style="margin-top: 10px"></td>
                </tr>
                <tr>
                    <td>Subject Line :</td>
                    <td><input name="subjectLine" value="<?php echo $subjectLine; ?>" id="subjectLine" type="text"
                               style="margin-top: 10px"></td>
                </tr>
                <tr>
                    <td>Note Body:</td>
                    <td><textarea name="noteBody" id="noteBody1"><?php echo $noteBody; ?></textarea></td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="editSubmitted" value="<?php print $noteId; ?>">
                        <input id="button1" type="submit" class="btn btn-success btn-lg" value="Edit Note">
                    </td>

                </tr>

            </table>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['editSubmitted'])) {
   // echo 'edit works';
    $fileRep = new \massa\p3\myFileRepository();
    $noteId = $_POST['editSubmitted'];
    $note = $fileRepo->getNoteById($noteId);
//    $authorName=$_POST['authorName'];
//    $noteBody=$_POST['noteBody'];
    $authorName = isset($_POST['authorName']) ? htmlspecialchars(trim($_POST['authorName'])) : '';
    $noteBody = isset($_POST['noteBody']) ? htmlspecialchars(trim($_POST['noteBody'])) : '';
    $subjectLine = isset($_POST['subjectLine']) ? htmlspecialchars(trim($_POST['subjectLine'])) : '';
    if ($authorName == '' || $subjectLine=='') {
        if($authorName==''){
            ?>
            <span class="error">*Author name is required!</span>
            <?php
        }
        if($subjectLine==''){
            ?>
            <span class="error">*Subject line is required!</span>
            <?php

        }
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Note</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <style type="text/css">


                #button, #button1 {
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

                input, textarea {
                    width: 250px;
                    border-style: solid;
                    border-width: 2px;
                    display: inline-block;
                }

                #noteBody, #noteBody1 {
                    height: 200px;
                    resize: none;
                }

                .error {
                    color: red;
                }


            </style>

        </head>
        <body>
        <h2>Edit Note</h2>
        <div id="main-Div">
            <form enctype="multipart/form-data" action="#" method="post">
                <table>
                    <tr>
                        <td>Author Name :</td>
                        <td><input name="authorName" value="<?php echo $authorName; ?>" id="authorName" type="text"
                                   style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Subject Line :</td>
                        <td><input name="subjectLine" value="<?php echo $subjectLine; ?>" id="subjectLine" type="text"
                                   style="margin-top: 10px"></td>
                    </tr>
                    <tr>
                        <td>Note Body:</td>
                        <td><textarea name="noteBody" id="noteBody1"><?php echo $noteBody; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="editSubmitted" value="<?php print $noteId; ?>">
                            <input id="button1" type="submit" class="btn btn-success btn-lg" role="button"
                                   value="Edit Note">
                        </td>

                    </tr>

                </table>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </body>
        </html>

        <?php

    } else {
        $note->setAuthorName($authorName);
        $note->setNoteBody($noteBody);
        $note->setSubjectLine($subjectLine);
        $note->setDate(date('l F j\, Y \- h:i:s a'));
        $fileRep->SaveNote($note);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Note Edited</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <style type="text/css">

                #main-Div {

                    margin-left: 100px;
                    margin-bottom: 100px;
                    margin-right: 100px;
                    background-color: #cccccc;
                    width: 500px;
                    height: 200px;
                }

                }


            </style>
        </head>
        <body>
           <div id="main-Div">
               <h2>The new Note has edited!!!</h2>
               <a href="index.php" class="btn btn-primary btn-lg">Home</a>
           </div>
        </body>
        </html>

        <?php

    }

} else {
    echo 'The is nothing to edit';
}