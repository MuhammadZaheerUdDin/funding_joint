<?php

namespace App\Http\Controllers\Bank;

use App\Http\Requests\FileFormRequest;
use App\Model\Users\User;
use App\Model\Bank\BankStatement;
use App\Model\Bank\BankDetails;
use Illuminate\Cache\FileStore;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Model\Users\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankStatementController extends Controller
{

    protected $fileExtensionAllowed;


    public function __construct()
    {
        $this->fileExtensionAllowed = collect(['pdf', 'png', 'jpg']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();

        $files = $user->bankStatement()->get();

        $bankStatement = new bankStatement();

        return view('bankdetails.upload-bank-statement', ['bankStatement' => $bankStatement, 'files' => $files]);

    }

    /**
     * Store a newly created resource in storage.
     * @param FileFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileFormRequest $request)
    {
        $file = $request->file("bank_statement_file");

        $validator = Validator::make($request->all(), [
            'bank_statement_file' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect('upload-bank-statement');
        }

        if($this->fileExtensionAllowed->contains($file->getClientOriginalExtension())){


            if ($file->isValid()) {

                $user = Auth::user();

                $timestamp =  'user-'.$user->id.'-bankStatement-' . time();

                $newFilename =  $timestamp.'.'.$file->getClientOriginalExtension();

                Storage::disk('bankStatements')->put($newFilename, file_get_contents($file));
            }

            $record = new BankStatement();
            $record->user_id = Auth::id();
            $record->statement_name = $newFilename;
            $record->save();

            $user = Auth::user();

            $files = $user->bankStatement()->get();
            $bankStatement = new bankStatement();


            return redirect('upload-bank-statement')->with('msg', 'File uploaded');


        }else{

            Session::flash('msg', "The uploaded file is not allowed. Please upload pdf, png jpg");

            return redirect('upload-bank-statement')->with('msg', "The uploaded file is not allowed. Please upload pdf, png jpg");

        }

        return view('bankdetails.upload-bank-statement', ['bankStatement' => $bankStatement, 'files' => $files]);
    }

    /**
     * @method download
     * @description Download's the file that the user added
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id,Request $request)
    {

        $document = BankStatement::findOrFail($id);

        $path = storage_path("app/public/bankStatements/$document->statement_name");

        $user = Auth::user();

        if (($user->id == $document->user_id) || $user->user_type == 1) {
            if($request->action ==="view")
                return response()->file($path);
            else
                return response()->download($path);
        } else {
            return response();
        }


    }
}
