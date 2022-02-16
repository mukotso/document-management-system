<?php

namespace App\Repositories;

use App\Interfaces\DocumentRepositoryInterface;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function getAllDocuments()
    {
        return Document::all();
    }

    public function createDocument(array $documentDetails)
    {
        return Document::create($documentDetails);
    }
    public function updateDocument($document, array $newDetails)
    {
        return $document->update($newDetails);
    }

    public function deleteDocument($documentId)
    {
        return  Document::destroy($documentId);
    }

}
