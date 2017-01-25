<?php

/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/3/2016
 * Time: 6:26 PM
 *
 *
 * Description: this class will define a note attributes and method contains noteID(it will generate an unique id),
 * subjectLine(the link for viewing more info of the note), noteBody, authorName, date(it will generate a date
 * time whenever user create/edit a note), numOfChar it will count characters number).
 * There is no set method for an id and the system could only get the id.
 */
namespace massa\p3;
date_default_timezone_set('America/Chicago');
class Note
{
    private $noteID;
    private $subjectLine;
    private $noteBody;
    private $authorName;
    private $date;
    private $numOfChar;

    /**
     * Note constructor.
     */
    public function __construct()
    {
        $this->noteBody='';
        $this->date=date('l F j\, Y \- h:i:s a');
        $this->subjectLine="Link";
    }


    /**
     * @return mixed
     */
    public function getNoteID()
    {
        return $this->noteID;
    }

    /**
     * @param mixed $noteID
     */
    public function setNoteID($noteID)
    {
        $this->noteID = $noteID;
    }


    /**
     * @return mixed
     */
    public function getSubjectLine()
    {
        return $this->subjectLine;
    }

    /**
     * @param mixed $subjectLine
     */
    public function setSubjectLine($subjectLine)
    {
        $this->subjectLine = $subjectLine;
    }

    /**
     * @return mixed
     */
    public function getNoteBody()
    {
        return $this->noteBody;
    }

    /**
     * @param mixed $noteBody
     */
    public function setNoteBody($noteBody)
    {
        $this->noteBody = $noteBody;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getNumOfChar()
    {
        $this->numOfChar=mb_strlen($this->getNoteBody());
        return $this->numOfChar;
    }




}