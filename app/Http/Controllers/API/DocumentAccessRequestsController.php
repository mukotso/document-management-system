<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DocumentAccessRequestRequest;
use App\Interfaces\DocumentAccessRepositoryInterface;
use App\Models\DocumentAccessRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentAccessRequestsController extends Controller
{
    //    constructor dependency injection
    //documentAccess Repository
    public $documentAccessRepository;

    public function __construct(DocumentAccessRepositoryInterface $documentAccessRepository)
    {
        $this->documentAccessRepository = $documentAccessRepository;
    }


    public function index()
    {
        $myRequests = $this->documentAccessRepository->getMyRequests();
        return response()->json($myRequests, 200);
    }

    public function store(DocumentAccessRequestRequest $request)
    {
        $documentAccessRequest = $this->documentAccessRepository->createRequest($request->all());
        return response()->json($documentAccessRequest, 201);
    }

    public function update(DocumentAccessRequestRequest $request,DocumentAccessRequest $documentAccessRequest)
    {
        $documentAccessRequestDetails = $this->documentAccessRepository->updateRequest( $documentAccessRequest,$request->all());
        return response()->json($documentAccessRequestDetails, 201);
    }

    public function destroy(DocumentAccessRequest $document)
    {
        $this->documentAccessRepository->deleteRequest($document->id);
        return response()->json(200);
    }

//    public function approve(DocumentAccessRequest $documentAccessRequest)
//    {
//        $this->documentAccessRepository->approveRequest($documentAccessRequest);
//        return response()->json(200);
//    }

//    public function reject( DocumentAccessRequestRequest $request ,DocumentAccessRequest $document)
//    {
//        $this->documentAccessRepository->rejectRequest($document ,$request->all()) ;
//        return response()->json(200);
//    }
}
