<div class="tool-box d-flex flex-row justify-content-end align-items-center bread-cum">
    <button data-prop='{"page": "addPage","server": "no"}' class="btn btn-primary btn-rounded waves-effect waves-light d-flex justify-items-center align-items-center viewAction fw-bold me-2">
        <span class="bx bx-plus fw-bold"></span> <span class="d-none d-md-block ms-1"> Add New </span>
    </button>
    @if(count($data['items']) > 0)
        <button class="btn btn-success btn-rounded waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold  me-2 updateAllCompanyName"><span class="bx bx-save"></span> <span class="d-none d-md-block ms-1"> Update  </span> </button>
        <button class="btn btn-danger btn-rounded waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold me-2 deleteAllCompanyName"><span class="bx bx-trash"></span> <span class="d-none d-md-block ms-1">  Delete   </span> </button>
        <button class="btn btn-info btn-rounded waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold  me-2" id="downloadLibAssociatePdf"  data-pdf-op='{"file_name":"{{ config('i.service_domain').'_lib associate_list'  }}"}'><span class="bx bxs-file-pdf"></span> <span class="d-none d-md-block ms-1"> PDF  </span> </button>
        <button class="btn btn-info btn-rounded waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold" id="downloadLibAssociateExcel"  data-excel-op='{"file_name":"{{ config('i.service_domain').'_lib associate_list'  }}"}'><span class="bx bxs-file-export"></span> <span class="d-none d-md-block ms-1"> Excel  </span> </button>
    @endif
</div>
