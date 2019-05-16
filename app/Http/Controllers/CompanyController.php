<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UploadFileService;
use App\Models\Company;

class CompanyController extends Controller
{
	private $model;

	public function __construct(Company $model)
    {
        $this->middleware('auth', ['except'=>[]]);
        $this->model = $model;
        
    }

    public function index()
    {
    	return view('company.index');
    }
    /**
     * [store description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    
    public function store(Request $request)
    {
    	$input=$request->except(['file','_token']);
        if ( $request->file('file') ) {
                $file_id=UploadFileService::uploadImage($request->file('file'));
                //Tao file
               $input['file_id']=$file_id;
                //Tao staff
            }
    	$this->model->create($input);

    	return redirect()->route('company.index');
    }
}
