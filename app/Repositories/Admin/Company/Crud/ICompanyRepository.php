<?php

namespace App\Repositories\Admin\Company\Crud;

interface ICompanyRepository {

    public function list($request);
    public function index($request,$id=null);
    public function store($request);
    public function update($request,$id);

}
