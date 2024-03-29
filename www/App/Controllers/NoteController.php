<?php

namespace App\Controllers;
use App\Models\Note;

class NoteController extends CoreController

{
    /**
     * Display the home page (all user's notes)
     *
     * @return void
     */
    public function home(): void
    {
        $this->show('main/home', [
            'allNotes' => Note::findAll($_SESSION['currentUserId'])
        ]);
    }

    /**
     * Display one note
     *
     * @param int $id
     * @return void
     */
    public function display(int $noteId): void
    {
        $this->show('main/display', [
            'note' => Note::find($noteId, $_SESSION['currentUserId'])
        ]);
    }

    /**
     * Display the page for adding a note
     *
     * @return void
     */
    public function add(): void
    {
        $this->show('main/add-update', [
            'note' => new Note()
        ]);
    }

    /**
     * Processing the form for adding a note
     *
     * @return void
     */
    public function create(): void
    {
        $title = filter_input(INPUT_POST, 'title');
        $content = htmlspecialchars(filter_input(INPUT_POST, 'content'));

        /* Errors handling */
        $errorsList = [];

        if(empty($title) && empty($content)){
            $errorsList[] = 'Pour enregistrer une note, vous devez remplir au moins un des 2 champs';
        }

        if(strlen($title) > 100){
            $errorsList[] = 'La longueur maximale pour le titre est de 100 caractères';
        }

        /* Datas preparing */
        $note = new Note;
        $note->setTitle($title);
        $note->setContent($content);
        // TODO : change setUser_id argument with the id userObject
        $note->setUser_id($_SESSION['currentUserId']);
        
        /* Datas recording */
        if(empty($errorsList)){
            if($note->save()){
                // $this->addFlashMessage('Note ajoutée avec succès !');
                $this->redirect('note-home');
            }

            $errorsList[] = 'Erreur d\'enregisterment des données.';
        }

        $this->show('main/add-update', [
            'note' => $note,
            'errorsList' => $errorsList
        ]);
    }

    /**
     * Display the page for updating a note
     *
     * @param string $noteId
     * @return void
     */
    public function update($noteId): void
    {
        $this->show('main/add-update', [
            'note' => Note::find($noteId, $_SESSION['currentUserId'])
        ]);
    }

    /**
     * Processing the form for updating a note
     *
     * @param int $noteId
     * @return void
     */
    public function updatePost(int $noteId): void
    {
        $title = filter_input(INPUT_POST, 'title');
        $content = htmlspecialchars(filter_input(INPUT_POST, 'content'));

        /* Errors handling */
        $errorsList= [];

        if(empty($title) && empty($content)){
            $errorsList[] = 'Pour enregistrer une note, vous devez remplir au moins un des 2 champs';
        }

        if(strlen($title) > 100){
            $errorsList[] = 'La longueur maximale pour le titre est de 100 caractères';
        }

        /* Datas preparing */
        $note = Note::find($noteId, $_SESSION['currentUserId']);
        $note->setTitle($title);
        $note->setContent($content);

        /* Datas recording */
        if(empty($errorsList)){
            if($note->save()){
                $this->redirect('note-display', ['id' => $noteId]);
            }
            $errorsList[] = 'Erreur d\'enregisterment des données.';
        }

        $this->show('main/add-update', [
            'note' => $note,
            'errorsList' => $errorsList
        ]);
    }

    /**
     * Processing the delete of a note
     *
     * @param int $noteId
     * @return void
     */
    public function delete(int $noteId): void
    {
        $note = Note::find($noteId, $_SESSION['currentUserId']);
        
        if($note !== false){
            if($note->delete()){
                $this->addFlashMessage('Note supprimée avec succès !');
            } else {
                $this->addFlashMessage('Erreur de suppression de la note', 'danger');
            }
        } else {
            $this->addFlashMessage('Erreur de suppression de la note : la note n\'existe pas', 'danger');
        }

        $this->redirect('note-home');
    }

}