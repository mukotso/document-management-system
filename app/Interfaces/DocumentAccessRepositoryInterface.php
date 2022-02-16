<?php

namespace App\Interfaces;


interface DocumentAccessRepositoryInterface
{
    public function getMyRequests();
    public function deleteRequest($id);
    public function createRequest(array $accessRequestDetails);
    public function updateRequest($accessRequest, array $newDetails);


//    public function approveRequest($id);
//    public function rejectRequest($accessRequest, array $newDetails);
}
