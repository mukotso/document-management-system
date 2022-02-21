<?php

namespace App\Repositories;

use App\Interfaces\DocumentAccessRepositoryInterface;
use App\Mail\AccessRequest;
use App\Models\Document;
use App\Models\DocumentAccessRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DocumentAccessRequestRepository implements DocumentAccessRepositoryInterface
{
    public function getMyRequests()
    {
        return DocumentAccessRequest::all();
    }

    public function createRequest(array $accessRequestDetails)
    {
        return DocumentAccessRequest::create($accessRequestDetails);


    }
    public function updateRequest($accessRequest, array $newDetails)
    {
        return $accessRequest->update($newDetails);
    }

    public function deleteRequest($accessRequestId)
    {
        return  DocumentAccessRequest::destroy($accessRequestId);
    }

//    public function rejectRequest($accessRequest, array $newDetails)
//    {
//        return $accessRequest->update($newDetails);
//    }
//
//    public function approveRequest($accessRequest)
//    {
//        return  $accessRequest->update(['status'=>'approved']);
//    }

}
