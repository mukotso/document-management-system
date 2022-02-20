<?php

namespace App\Interfaces;


interface DocumentRepositoryInterface
{
    public function getAllDocuments();
    public function getAllDocumentsHistory();
    public function documentDownload($documentId);
    public function filterDepartmentDocuments($documentId);
    public function storeAccessRequest($documentDetails);
    public function myAccessRequest($userId);
    public function deleteDocument($documentId);
    public function deleteDocumentAccessRequest($documentId);
    public function rejectDocumentAccessRequest($AccessDetails);
    public function getTemporaryDocuments($id);
    public function approveDocumentAccessRequest( $AccessDetails);
    public function createDocument(array $documentDetails);
    public function updateDocument($document, array $newDetails);
}
