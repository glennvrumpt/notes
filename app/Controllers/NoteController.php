<?php

namespace App\Controllers;

class NoteController
{
    public function index()
    {
        echo "List of notes";
    }

    public function show($id)
    {
        echo "Showing note with ID: " . $id;
    }

    public function store()
    {
        echo "Storing a new note";
    }

    public function update($id)
    {
        echo "Updating note with ID: " . $id;
    }

    public function destroy($id)
    {
        echo "Deleting note with ID: " . $id;
    }
}
