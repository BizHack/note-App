<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/4/2016
 * Time: 10:38 PM
 *
 *
 * Description: This page will show note information. In this page user will be able to edit and delete that specific
 * note or go back to home page. By clicking on edit button, it will redirect user to editNote.php and by clicking
 * on delete button, it will first ask user if they want to delete the note or nor.
 * If so, it will redirect it to deleteNote.php and if not it will allow user to go back to note information page.
 */

require_once 'myFileRepository.php';
require_once 'Note.php';
$fileRepo = new \massa\p3\myFileRepository();
if (!empty($_GET['id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    $noteId = $_GET['id'];
    $note = $fileRepo->getNoteById($noteId);
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

            #main-Div {

                margin-left: 100px;
                margin-bottom: 100px;
                margin-right: 100px;
                background-color: #cccccc;
                width: 800px;
                height: 300px;
            }


        </style>
    </head>
    <body>
    <div id="main-Div">
        <h2>Note Information</h2>
        <table class="table table-bordered">
            <tr class="info">
                <td>Author Name :</td>
                <td><?php echo $note->getAuthorName(); ?></td>
            </tr>
            <tr class="info">
                <td>Note Body:</td>
                <td><?php echo $note->getNoteBody(); ?></td>
            </tr>
            <tr class="info">
                <td>Date Created/Updated:</td>
                <td><?php echo $note->getDate(); ?></td>
            </tr>
            <tr class="info">
                <td>
                    <form enctype="multipart/form-data" method="post" action="editNote.php">
                        <input type="hidden" name="editPushed" value="<?php print $note->getNoteID(); ?>">
                        <input type="submit" value="Edit Notes" class="btn btn-lg btn-info" role="button">
                    </form>
                </td>
                <td>
                    <form enctype="multipart/form-data" action="#" method="post">
                        <input type="hidden" name="deletePushed" value="<?php print $note->getNoteID(); ?>">
                        <input type="submit" name="deleteNote" value="Delete Note" role="button"
                               class="btn btn-sm btn-warning">

                    </form>
                </td>
            </tr>
            <tr>
                <td><a href="index.php" class="btn btn-sm btn-primary">Home</a></td>
            </tr>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php


} //elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_GET['id'])) {
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['deletePushed'])) {

    //$noteId = $_GET['id'];
    $noteId = $_POST['deletePushed'];
    $note = $fileRepo->getNoteById($noteId);
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Confirmation</title>
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
        <h2> Warning!</h2>
        <table class="table">
            <tr>
                <td><h4>Are you sure you want to delete the book by "<?php echo $note->getAuthorName(); ?>" ?</h4></td>
            </tr>
            <tr>
                <td>
                    <form enctype="multipart/form-data" method="post" action="deleteNote.php">
                        <input type="hidden" name="deleteConfirmed" value="<?php print $noteId; ?>">
                        <input type="submit" name="deleteSubmitted " value="Confirm" role="button"
                               class="btn btn-warning btn-lg">
                    </form>
                </td>
                <td>
                    <a href="viewNote.php?id=<?php echo $noteId; ?>" class="btn btn-sm btn-primary">Back</a>
                </td>
            </tr>

        </table>


    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php


} else {
    $noteId = '';
}
?>