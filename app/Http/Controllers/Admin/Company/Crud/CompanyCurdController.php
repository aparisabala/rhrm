<?php

namespace App\Http\Controllers\Admin\Company\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\Crud\ValidateStoreCompany;
use App\Http\Requests\Admin\Company\Crud\ValidateUpdateCompany;
use App\Repositories\Admin\Company\Crud\ICompanyCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
class CompanyCurdController  extends Controller {

    use BaseTrait;
    public function __construct(private ICompanyCrudRepository $iCompanyCrudRepo) {
        $this->middleware(['auth:admin','HasSetAdminPassword','HasAdminAuth']);
    }

    public function index(Request $request)
    {
        $data = $this->iCompanyCrudRepo->index($request);
        return view('admin.pages.company.crud.index',compact('data'));
    }

    public function list(Request $request)
    {
        return  $this->iCompanyCrudRepo->list($request);
    }

    public function store(ValidateStoreCompany $request)
    {
        return $this->iCompanyCrudRepo->store($request);
    }

     public function show($id)
    {
        return [];
    }

    public function edit($id,Request $request)
    {
        $data = $this->iCompanyCrudRepo->index($request,$id);
        return view('admin.pages.company.crud.index', compact('data'));
    }

    public function update(Request $request, $id){
        return $this->iCompanyCrudRepo->update($request,$id);
    }

     public function deleteList(Request $request)
    {
       return  $this->iCompanyCrudRepo->deleteList($request);
    }

     public function updateList(Request $request)
    {
       return  $this->iCompanyCrudRepo->updateList($request);
    }



}
