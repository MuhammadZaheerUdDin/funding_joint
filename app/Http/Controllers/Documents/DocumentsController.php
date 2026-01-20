<?php

namespace App\Http\Controllers\Documents;

use App\Model\Identification\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{


    public function download($id, Request $request)
    {
        $document = Document::findOrFail($id);
        $path = $this->getDownloadLink($document);
        $user = Auth::user();
        if (($user->id == $document->user_id) || $user->user_type == 1) {
            if ($request->action === "view")
                return response()->file($path);
            else
                return response()->download($path);
        } else
            return response()->status(401);

    }

    /**
     * change name of the file to be uploaded
     * @param $file
     * @return string
     */
    public static function setDocumentName($file)
    {
        $ext = $file->getClientOriginalExtension();
        return "user_" . Auth::id() . "_document_" . time() . "." . $ext;
    }

    /**
     * Upload document and return the name of the document
     * @param $file
     * @param string $folder
     * @return string
     */
    public static function upload($file,$folder='identities')
    {
        $file_name = self::setDocumentName($file);
        Storage::disk($folder)->put($file_name, file_get_contents($file));
        return $file_name;
    }

    /**
     * Get Download link for a document will return link based on type
     * @param $document
     * @return string link
     */
    public function getDownloadLink($document)
    {
        if($document->type_proof ==="identity")
            $doc_folder = "identities";
        elseif($document->type_proof ==="address")
            $doc_folder = "proofs";
        else
            return redirect()->back()->withMessage('Could not download file!');


        return storage_path("app/public/$doc_folder/$document->file_name");
    }
}
