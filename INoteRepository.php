<?php

/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 10/3/2016
 * Time: 6:37 PM
 */
namespace massa\p3;
interface INoteRepository
{
    public function SaveNote($note);
    public function getAllNotes();
    public function addNote($note);
    public function deleteNote($note);
    public function getNoteById($id);

}