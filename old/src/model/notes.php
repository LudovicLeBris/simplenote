<?php

require_once('src/lib/database.php');

class Note {
    public int $noteID;
    public string $title;
    public string $creationDATE;
    public string $lastUpdateDATE;
    public string $content;
}

class NoteRepository 
{
    public DatabaseConnection $connection;

    private function _statement($sqlStatement)
    {
        return $this->connection->getConnection()->prepare($sqlStatement);
    }

    public function displayNotes($userConnected): array
    {
        
        $statement = $this->_statement(
            "SELECT noteID, title, creationDATE, lastUpdateDATE, content FROM notes WHERE userID = :userConnected"
        );
        $statement->execute(['userConnected' => $userConnected]);

        $notes = [];

        while (($row = $statement->fetch())) {
            $note = new Note();
            $note->noteID = $row['noteID'];
            $note->title = $row['title'];
            $note->creationDATE = $row['creationDATE'];
            $note->lastUpdateDATE = $row['lastUpdateDATE'];
            $note->content = $row['content'];

            $notes[] = $note;
        }

        return $notes;
    }

    public function displayNote($userConnected, $noteID): Note
    {
        $statement = $this->_statement(
            "SELECT noteID, title, creationDATE, lastUpdateDATE, content FROM notes 
            WHERE userID = :userConnected AND noteID = :noteID"
        );
        $statement->execute([
            'userConnected' => $userConnected,
            'noteID' => $noteID,
        ]);
        $row = $statement->fetch();
    
        $note = new Note();
        $note->noteID = $row['noteID'];
        $note->title = $row['title'];
        $note->creationDATE = $row['creationDATE'];
        $note->lastUpdateDATE = $row['lastUpdateDATE'];
        $note->content = $row['content'];
    
        return $note;
    }
    
    public function createNote($userConnected, $title, $content): bool
    {
        $statement = $this->_statement(
            "INSERT INTO notes (userID, title, creationDATE, lastUpdateDATE, content)
            VALUES (:userID, :title, :creationDATE, :lastUpdateDATE, :content)"
        );
    
        $date = date('Y/m/d H:i:s');
    
        $success = $statement->execute([
            'userID' => $userConnected,
            'title' => $title,
            'creationDATE' => $date,
            'lastUpdateDATE' => $date,
            'content' => $content,
        ]);
    
        return ($success > 0);
    
    }
    
    public function updateNote($userConnected, $noteID, $title, $content): bool
    {
        $statement = $this->_statement(
            "UPDATE notes SET title = :title, content = :content, lastupdateDATE = :updatedDate 
            WHERE noteID = :noteID AND userID = :userConnected"
        );
    
        $updatedDate = date('Y/m/d H:i:s');
    
        $success = $statement->execute([
            'title' => $title,
            'content' => $content,
            'updatedDate' => $updatedDate,
            'noteID' => $noteID,
            'userConnected' => $userConnected,
        ]);
    
        return ($success > 0);
    }
    
    public function deleteNote($userConnected, $noteID): bool
    {
        $statement = $this->_statement(
            "DELETE FROM notes WHERE noteID = :noteID AND userID = :userConnected"
        );
        $success = $statement->execute([
            'noteID' => $noteID,
            'userConnected' => $userConnected,
        ]);
    
        return ($success > 0);
    
    }

}        

