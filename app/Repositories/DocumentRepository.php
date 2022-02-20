<?php

namespace App\Repositories;

use App\Interfaces\DocumentRepositoryInterface;
use App\Models\Department;
use App\Models\DepartmentDocument;
use App\Models\Document;
use App\Models\DocumentAccessRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function getAllDocuments()
    {
        return Document::with('category','user')->get();
    }

    public function createDocument(array $documentDetails)
    {

//        $user = Auth::user();
//        dd($user);

            $filenameWithExt =$documentDetails['document'] ->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $documentDetails['document']->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Imagein storage folder
            $path = $documentDetails['document']->storeAs('public/documents', $fileNameToStore);

        $documentDetails['file_path']=$path;
        $documentDetails['uploaded_by']=2;
        $document = Document::create($documentDetails);
        DepartmentDocument::create([
            'department_id' => $document->user[0]->department_id,
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
    public function getAllDocumentsHistory()
    {
        return Document::onlyTrashed()->with('category','user')->get();
    }
    public function documentDownload($documentId){
        $document=Document::find($documentId);
      $file_path =$document->file_path;
        $name =$document->name;
        return Storage::download($file_path ,$name);

    }

    public function filterDepartmentDocuments($departmentId)
    {
        return Department::where('id',$departmentId)->with('documents')->get();
    }

    public function storeAccessRequest($documentDetails)
    {
        $documentDetails['user_id']=2;
        return DocumentAccessRequest::create($documentDetails);
    }

    public function myAccessRequest($userId)
    {

        return DocumentAccessRequest::where('user_id', $userId)->with('document', 'user')->get();
    }

    public function deleteDocumentAccessRequest($documentId)
    {
        return DocumentAccessRequest::destroy($documentId);
    }

    public function approveDocumentAccessRequest($documentDetails)
    {
//
        $documentAccessRequest = DocumentAccessRequest::where('id',$documentDetails['accessRequestId']);

        $userId = $documentDetails['userId'];
        $granted_at = now();
        $Days = $documentDetails['days'] * 1440;
        $Hours = $documentDetails['hours']  * 60;
        $Minutes = $documentDetails['minutes'] ;
        $grantedAccessTime = $Days + $Hours + $Minutes;


        $documentAccessRequest->granted_duration = $grantedAccessTime;
        $documentAccessRequest->update(['granted_at'=>$granted_at, 'granted_duration'=>$grantedAccessTime, 'granted_by'=>$userId, 'status'=>'approved']);
        return  $documentAccessRequest;
    }

    public function rejectDocumentAccessRequest($documentDetails)
    {
        $documentAccessRequest = DocumentAccessRequest::where('id',$documentDetails['accessRequestId']);
        $documentAccessRequest->update(['decline_reason'=>$documentDetails['decline_reason'], 'granted_by'=>$documentDetails['userId'], 'status'=>'rejected']);
        return  $documentAccessRequest;
    }

    public function getTemporaryDocuments($id)
    {

        $temporaryDocuments= DocumentAccessRequest::where('user_id',$id)->where('status','approved')->with('document')->get();
        foreach($temporaryDocuments as $temporaryDoc){
            $grantedDuration=$temporaryDoc->granted_duration;
            $temporaryDoc['days']= floor ($grantedDuration / 1440);
            $temporaryDoc['hours'] = floor (($grantedDuration - $temporaryDoc['days'] * 1440) / 60);
            $temporaryDoc['minutes']= $grantedDuration - ($temporaryDoc['days'] * 1440) - ($temporaryDoc['hours'] * 60);
        }
       return  $temporaryDocuments;
    }







}
