$(document).ready(function(){
    if($("#frmUpdateAdminSetupProfile").length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            mobile_number: {
                required: true,
            },
            email: {
                required: true,
                maxlength: 253,
                email: true,
            },
            new_password: {
                required: true,
                minlength: 8
            },
            confim_password: {
                required: true,
                minlength: 8
            },
        };
        if($("#img_uploaded").val() == "no") {
            rules.image = {
                required: true,
            }
        }
        PX.ajaxRequest({
            element: "frmUpdateAdminSetupProfile",
            validation: true,
            script: "admin/setup/profile",
            rules,
            afterSuccess: {
                type: "inflate_redirect_response_data"
            }
        });
    }
    //vpx_attach
})