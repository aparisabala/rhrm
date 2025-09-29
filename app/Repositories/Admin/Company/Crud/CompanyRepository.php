<?php

namespace App\Repositories\Admin\Company\Crud;

use App\Http\Requests\Admin\Company\Crud\ValidateUpdateCompany;
use App\Models\Company;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;

class CompanyRepository extends BaseRepository implements ICompanyRepository {

    use BaseTrait;

    public function index($request,$id=null)
    {
       return $this->getPageDefault(Company::class,$id);
    }

    public function list($request)
    {
        $model = Company::query();
        return DataTables::of($model)
        ->editColumn('created_at', function($item) {
            return  Carbon::parse($item->created_at)->format('d-m-Y');
        })
        ->escapeColumns([])
        ->make(true);
    }

    public function store($request)
    {
        try {
            Company::create($request->all());
            return redirect()->back()->with('success', 'Company created successfully!');
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update($request,$id)
    {
        $row = Company::findOrFail($id);
        $row->fill($request->all());
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateCompany())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            try {
                $row->update($request->all());
                $data['extraData'] = ["inflate" => 'Action successfull'];
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                $this->saveError($this->getSystemError(['name'=>'LibAssociate_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">You made no changes </span>']);
        }
    }
}
