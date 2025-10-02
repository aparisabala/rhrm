$(document).ready(function(){

    if ($('#frmStoreCompany').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreCompany',
            validation: true,
            script: 'admin/company',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateCompany').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateCompany',
            validation: true,
            script: 'admin/company/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtCompanyName").length > 0) {
        let col_draft = [
            {
                data: 'id',
                title: 'ID'
            },
            {
                data: null,
                title: 'Serial',
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },
            {
                data: 'name',
                title: 'Name'
            },

            {
                data: 'created_at',
                title: 'Created At'
            },

            {
                data: null,
                title: 'Actions',
                class: 'text-end',
                render: function (data, type, row) {
                    return `<a href="${baseurl}admin/company/${data.id}/edit"
                        <span class="badge rounded-pill bg-info cursor-pointer me-2">
                            <span class="bx bxs-edit text-white fw-bold fs-14"></span>
                        </span>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtCompanyName', {
            select: true,
            url: 'admin/company/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtCompanyName(table, api, op) {
    PX.deleteAll({
        element: "deleteAllCompanyName",
        script: "admin/company/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllCompanyName",
        script: "admin/company/update-list",
        confirm: true,
        dataCols: {
            key: "ids",
            items: [
                {
                    index: 1,
                    name: "ids",
                    type: "input",
                    data: [],
                },
                {
                    index: 1,
                    name: "serial",
                    type: "input",
                    data: []
                }
            ]
        },
        api,
        afterSuccess: {
            type: "inflate_response_data"
        }
    });
    // PX?.dowloadPdf({ ...op, btn: "downloadCompanyNamePdf", dataTable: "yes" })
    // PX?.dowloadExcel({ ...op, btn: "downloadCompanyNameExcel", dataTable: "yes" })
}
