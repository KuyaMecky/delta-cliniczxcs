<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;
use Rap2hpoutre\LaravelLogViewer\BaseController;
use Storage;
use Str;

class DocumentAPIController extends AppBaseController
{
    /** @var DocumentRepository */
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;
    }
    
    /**
     *
     *
     * @return mixed
     */
    public function index()
    {
        $documents = Document::where('patient_id',auth()->user()->owner_id)->get();
        return $this->sendResponse($documents, "Document Retrieved Successfully");
    }

    /**
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDocumentTypes(): \Illuminate\Http\JsonResponse
    {
        $document_type = DocumentType::select(['id', 'name'])->get();
        return $this->sendResponse($document_type, "Document Retrieved Successfully");
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $input['patient_id'] = auth()->user()->owner_id;
        
        $this->documentRepository->store($input);

        return $this->sendSuccess('Document created successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        
        $input['patient_id'] = auth()->user()->owner_id;
        
        $this->documentRepository->updateDocument($input, $id);

        return $this->sendSuccess('Document updated successfully');
    }

    /**
     * @param $id
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->documentRepository->deleteDocument($id);

        return $this->sendSuccess('Document deleted successfully');
    }
    
    public function downloadDocs($id)
    {
        $document = Document::where('id', $id)->first();
        
        $documentMedia = $document->media[0];

        $url = $documentMedia->getUrl();

        return $this->sendResponse($url ?? '', "Document download URL");
    }
}
