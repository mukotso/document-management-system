<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\DocumentAccessRequestRequest;
use App\Http\Requests\DocumentRequest;
use App\Interfaces\DocumentRepositoryInterface;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentAccessRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function update(DocumentRequest $request, Document $document)
    {
        $documentDetails = $this->docRepo->updateDocument($document, $request->all());
        return response()->json($documentDetails, 201);
    }

    public function destroy(Document $document)
    {
        $this->docRepo->deleteDocument($document->id);
        return response()->json(200);
    }
    public function history()
    {
        $documents = $this->docRepo->getAllDocumentsHistory();
        return response()->json($documents, 200);
    }

    public function download($documentId)
    {
        $documents = $this->docRepo->documentDownload($documentId);
        return response()->json($documents, 200);
    }
    public function filterDepartmentDocuments($documentId)
    {
        $documents = $this->docRepo->filterDepartmentDocuments($documentId);
        return response()->json($documents, 200);
    }
    public function storeAccessRequest(DocumentAccessRequestRequest  $request)
    {
        $documents = $this->docRepo->storeAccessRequest($request->all());
        return response()->json($documents, 200);
    }

    public function myAccessRequest($userId)
    {
        $myAccessDocuments = $this->docRepo->myAccessRequest($userId);
        return response()->json($myAccessDocuments, 200);
    }

    public function DestroyAccessRequest(DocumentAccessRequest $document)
    {
        $this->docRepo->deleteDocumentAccessRequest($document->id);
        return response()->json(200);
    }

    public function rejectAccessRequest(Request $request)
    {
        $this->docRepo->rejectDocumentAccessRequest($request->all());
        return response()->json(200);
    }

    public function approveAccessRequest(Request $request)
    {
        $this->docRepo->approveDocumentAccessRequest($request->all());
        return response()->json(200);
    }

    public function getTemporaryDocuments($id)
    {
       $temporaryDocuments= $this->docRepo->getTemporaryDocuments($id);
        return response()->json($temporaryDocuments,200);
    }






}
