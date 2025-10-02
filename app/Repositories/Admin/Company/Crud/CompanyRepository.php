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
    public function __construct() {
        $this->LoadModels(['Company']);
    }
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

    public function updateList($request)
    {
        $i = Company::whereIn('id',$request->ids)->select(['id','name','serial'])->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                $value->serial = $request->serial[$value->id];
                if ($value->isDirty()) {
                    $dirty[$key] = "yes";
                }
            }
            if (count($dirty) > 0) {
                foreach ($i as $key => $value) {
                    $value->save();
                }
                $data['extraData'] = [
                    "inflate" => 'Updated successfully'
                ];
                return $this->response(['type' => 'success','data' => $data]);
            } else {
                return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success"> You made no changes </span>']);
            }

        } else {
            return $this->response(['type' => 'noUpdate', 'title' => 'Something went wrong, try again']);
        }
    }

    public function deleteList($request)
    {
        $errors = [];
        $i = Company::whereIn('id',$request->ids)->select(['id'])->get();
        if (count($i) > 0) {
            // $errors = $this->checkInUse([
            //     "rows" => $i,
            //     "search" => ["id","id"],
            //     "denined" => ["name","name"],
            //     "targetModel" => [$this->StudentAdmission,$this->ExamResult],
            //     "targetCol" => ["lib_category_id","lib_category_id"],
            //     "exists" => ["Class Category","Class Category"],
            //     "in" => ["Stduent Table","Result Table"]
            // ]);
            if (count($errors) > 0) {
                return $this->response(['type'=>'bigError','errors'=>$errors]);
            }
            foreach ($i as $key => $value) {
                $value->delete();
            }
            $data['extraData'] = [
                "inflate" => "Deleted successfuly",
                "redirect" => null
            ];
            return $this->response(['type' => 'success',"data"=>$data]);
        } else {
            return $this->response(['type' => 'noUpdate', 'title' => 'Something went wrong, try again']);
        }
    }

    public function store($request)
    {
        try {
            Company::create([ ...$request->all(),'serial' => $this->facSrWc($this->Company)]);
            $response['extraData'] = [
                'inflate' => 'Action succesfull'
            ];
            return $this->response(['type' => 'success', 'data' => $response]);
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
