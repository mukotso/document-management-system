<?php

namespace App\Interfaces;


interface DocumentRepositoryInterface
{
    public function getAllDocuments();
    public function deleteDocument($documentId);
    public function createDocument(array $documentDetails);
    public function updateDocument($document, array $newDetails);
}
