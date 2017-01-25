<?php

/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/3/2016
 * Time: 9:13 PM
 *
 * Description: This page will implement the functions defined in INoteRepository.php interface.
 * It will save a note in NoteDB.sqlite file, inquiring all notes information from the database, add, delete notes and get
 * specific information about a note by providing its id. In this project, we used PDO libraries for connecting to the
 * database and do CRUD in them.
 */
namespace massa\p3;
require_once 'INoteRepository.php';
date_default_timezone_set('America/Chicago');

class myFileRepository implements INoteRepository
{
    private $fileName = 'data/NoteDB.sqlite';
    private $dbh;

    public function SaveNote($note)
    {
        /*
                $dataArray = $this->getAllNotes();
                $dataArray[$note->getNoteID()] =$note;
                $serialData=serialize($dataArray);
                file_put_contents($this->fileName,$serialData);
*/
        $dataArray = $this->getAllNotes();

        if (array_key_exists($note->getNoteID(), $dataArray)) {
            try {
                $dbh = new \PDO('sqlite:' . $this->fileName);
                $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE note SET subjectLine='" . $note->getSubjectLine() . "', authorName='" . $note->getAuthorName() . "', date='" . $note->getDate() . "', noteBody='" . $note->getNoteBody() . "', numOfChar=" . $note->getNumOfChar() . "  WHERE id=" . $note->getNoteID();
              //  $sql = "UPDATE note SET subjectLine= :subjectLine, authorName= :authorName , date= :date, noteBody= :noteBody, numOfChar= :numOfChar  WHERE id= :id";


                // Prepare statement
                $stmt = $dbh->prepare($sql);
/*
                $stmt->bindParam(':subjectLine',$note->getSubjectLine() , PDO::PARAM_STR, 12);
                $stmt->bindParam(':authorName', $note->getAuthorName() , PDO::PARAM_STR, 12);
                $stmt->bindParam(':noteBody', $note->getNoteBody() , PDO::PARAM_STR, 12);
                $stmt->bindParam(':date', $note->getDate() , PDO::PARAM_STR, 12);
                $stmt->bindParam(':numOfChar', $note->getNumOfChar(), PDO::PARAM_INT);
                $stmt->bindParam(':id', $note->getNoteID(), PDO::PARAM_INT);
*/
                // execute the query
                $stmt->execute();

                // echo a message to say the UPDATE succeeded
                echo $stmt->rowCount() . " records UPDATED successfully";
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            $conn = null;

        } else {
            //echo "No note key found";
            try {
                $dbh = new \PDO('sqlite:' . $this->fileName);
                $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


                $dbh->exec("INSERT INTO note (subjectLine,noteBody,authorName,date,numOfChar) VALUES ('" . $note->getSubjectLine() . "','" . $note->getNoteBody() . "','" . $note->getAuthorName() . "','" . $note->getDate() . "'," . $note->getNumOfChar() . ")");


                $dbh = null;
            } catch (PDOException $e) {
                echo $e->getMessage();
                echo '<a href="index.php" role="button" class="btn btn-primary btn-lg">Home</a>';
                exit(0);
            }
        }


    }

    public function getAllNotes()
    {

        try {
            // $dbh = new PDO("sqlite:C:/wamp/www/Lab3/DB/massa_lab3data.sqlite");
            $dataArray = array();
            $dbh = new \PDO('sqlite:' . $this->fileName);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM note";
            foreach ($dbh->query($sql) as $row) {
                $note = new Note();
                $note->setNoteID($row['id']);
                $note->setAuthorName($row['authorName']);
                $note->setNoteBody($row['noteBody']);
                $note->setDate($row['date']);
                $note->setSubjectLine($row['subjectLine']);

                $dataArray[$note->getNoteID()] = $note;


            }
            return $dataArray;
            $dbh = null;
        } catch
        (PDOException $e) {
            echo $e->getMessage();
        }


        /*
        //$data=file($this->fileName) or die("Error: there is no file called data.txt exists!");
        $data = file_get_contents($this->fileName);
        if ($data) {
            $dataArray = unserialize($data);
            return $dataArray;
        } else {
            return array();
        }
        */

    }

    public function addNote($note)
    {
        // TODO: Implement addNote() method.
    }

    public function deleteNote($note)
    {
        /*
        $noteArray = $this->getAllNotes();
        $id = $note->getNoteID();
        if (array_key_exists($id, $noteArray)) {
            unset($noteArray[$id]);
            $serialData = serialize($noteArray);
        }
        file_put_contents($this->fileName, $serialData);
        echo 'The Note has been deleted';
        */

        try {
            $dbh = new \PDO('sqlite:' . $this->fileName);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $noteArray = $this->getAllNotes();
            $id = $note->getNoteID();
            if (array_key_exists($id, $noteArray)) {
                // sql to delete a record
                $sql = "DELETE FROM note WHERE id=".$id;
                // use exec() because no results are returned
                $dbh->exec($sql);
            }
            echo "Record deleted successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $dbh = null;


    }

    public function getNoteById($id)
    {
        $notearray = $this->getAllNotes();
        if (array_key_exists($id, $notearray)) {
            return $notearray[$id];
        }
    }
}