<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Requests\IdentityFormRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Identification\Document;
use App\Model\Users\Investor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;


class IdentificationController extends Controller
{



    protected $fileExtensionAllowed;


    public function __construct()
    {
        $this->fileExtensionAllowed = collect(['pdf', 'png', 'jpg', 'jpeg', 'gif']);
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
        //
        $user = Auth::user();

        $files = $user->identification()->get();

        $hasIdentity = 0;
        if($user->identification()->where('type_proof', 'identity')->get()->count() > 0){
            $hasIdentity = 1;
        }

        $hasAddress = 0;
        if($user->identification()->where('type_proof', 'address')->get()->count() > 0){
            $hasAddress = 1;
        }

        $proof = 0;
        if ($user->identification()->where('type_proof', 'identity')->get()->count() > 0 AND $user->identification()->where('type_proof', 'address')->get()->count() > 0) {
            $proof = 1;
        }


        $docs = new Document();

        $investor = new Investor();

        return view('investor.identity_verification', ['proof'=> $proof, 'files' => $files, 'docs' => $docs, 'investor' => $investor, 'hasAddress' => $hasAddress, 'hasIdentity' => $hasIdentity]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdentityFormRequest $request)
    {




        //
        try {

            $validator = Validator::make($request->all(), [
                'proof_documents' => 'required',
            ]);

            if ($validator->fails()) {

                return redirect('post-identity')
                    ->withErrors($validator)
                    ->withInput();
            }else{

                $file = $request->file("proof_documents");


                if($this->fileExtensionAllowed->contains($file->getClientOriginalExtension())){
                    $proof_type = $request->file_type == 'address' ? 'proofs' : 'identities';

                    if ($file->isValid()) {

                        $user = Auth::user();

                        $newFilename =  DocumentsController::upload($file,$proof_type);

                        $store = new Document();

                        $store->user_id = Auth::id();

                        $store->file_name = $newFilename;

                        $store->type_proof = $request['file_type'];

                        $store->save();

                    }




                }else{

                    Session::flash('msg', "The uploaded file is not allowed. Please upload pdf, png jpg");

                    return redirect('identity-verification')->with('msg', "The uploaded file is not allowed. Please upload pdf, png jpg");

                }



            }



        } catch (\Exception $exception) {

            echo $exception;
        }

        $user = Auth::user();

        $files = $user->identification()->get();

        $docs = new Document();

        $investor = new Investor();

        if ($user->identification()->where('type_proof', 'identity')->get()->count() > 0 AND
            $user->identification()->where('type_proof', 'address')->get()->count() > 0) {
            $proof = 1;
        } else {
            $proof = 0;
        }


        $hasIdentity = 0;
        if($user->identification()->where('type_proof', 'identity')->get()->count() > 0){
            $hasIdentity = 1;
        }


        $hasAddress = 0;
        if($user->identification()->where('type_proof', 'address')->get()->count() > 0){
            $hasAddress = 1;
        }


        return view('investor.identity_verification', ['files' => $files, 'docs' => $docs, 'investor' => $investor, 'proof' => $proof, 'hasAddress' => $hasAddress, 'hasIdentity' => $hasIdentity]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
