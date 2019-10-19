<?php

require_once 'vendor/autoload.php' ;

$token  =  'S=s1:U=958a1:E=1753966e23b:C=16de1b5b508:P=1cd:A=en-devtoken:V=2:H=2718142296fca14af8d729b1532454f2' ;
$sandbox  =  true ;
$china = false;

$client = new \Evernote\Client($token, $sandbox, null, null, $china);

$client -> getNote('the-note-guid');

$advancedClient = $client -> getAdvancedClient();

$userStore = $advancedClient->getUserStore();
$noteStore = $advancedClient->getNoteStore();

$user = $userStore->getUser();
$uname = $user->username;

$noteStore = $advancedClient->getNoteStore();
$notebooks = $noteStore->listNotebooks();
foreach($notebooks as $notebook){
    if ($notebook->name=="プロジェクトその１"){
        $notebookId = $notebook->guid;
        break;
    }
}
$filter = new \EDAM\NoteStore\NoteFilter();
$filter->notebookGuid = $notebookId;

$resultSpec = new \EDAM\NoteStore\NotesMetadataResultSpec();
$resultSpec->includeTitle = true;

$notes = $noteStore->findNotesMetadata($filter, 0, 250, $resultSpec);
$noteContents = [];

$counter=0;
foreach($notes->notes as $note){
    $title=$note->title;
    $noteId=$note->guid;
    $noteContents[$counter][0] = $title;
    $noteContents[$counter][1] = $noteStore->getNoteContent($noteId);
    $counter++;
}
$counter--;
$result = $noteContents[mt_rand(0, $counter)];