<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\DocumentRequest;
use App\Interfaces\DocumentRepositoryInterface;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Document;

class DocumentsController extends Controller
{
    //    constructor dependency injection
    public $docRepo;

    public function __construct(DocumentRepositoryInterface $docRepo)
    {
        $this->docRepo = $docRepo;
    }


    public function index()
    {
        $documents = $this->docRepo->getAllDocuments();
        return response()->json($documents, 200);
    }

    public function store(DocumentRequest $request)
    {
        $document = $this->docRepo->createDocument($request->all());
        return response()->json($document, 201);
    }

    public function update(DocumentRequest $request,  $document)
    {
        $documentDetails = $this->docRepo->updateDocument($request, $document);
        return response()->json($documentDetails, 201);
    }

    public function destroy(Document $document)
    {
        $this->docRepo->deleteDocument($document->id);
        return response()->json(200);
    }
}
