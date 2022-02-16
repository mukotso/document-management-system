<?php

namespace App\Repositories;

use App\Interfaces\DocumentRepositoryInterface;
use App\Models\DepartmentDocument;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function getAllDocuments()
    {
        return Document::all();
    }

    public function createDocument(array $documentDetails)
    {
        $document = Document::create($documentDetails);
        DepartmentDocument::create([
            'department_id' => $document->user->department_id,
            'document_id' => $document->id,
        ]);

        return $document;

    }

    public function updateDocument($document, array $newDetails)
    {
        return $document->update($newDetails);
    }

    public function deleteDocument($documentId)
    {
        return Document::destroy($documentId);
    }

}
