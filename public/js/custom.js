var windowWidth = window.innerWidth;
var windowHeight = window.innerHeight;

/********************************/
/*common method for select2 ajax*/
/********************************/
utlt["select2_ajax"] = function (selector, ajaxUrl, extraParam){
	extraParam = extraParam == undefined ? [] : extraParam;
	$(selector).select2({
		ajax: {
			url: utlt.siteUrl(ajaxUrl),
			dataType: 'json',
			placeholder: 'search',
			delay: 400,
			data: function (params) {
                return Object.assign({
                    search: params.term, // search term
                    page: params.page
                },extraParam);
            },
            
            processResults: function (data, params) {
                params.page = params.page || 1;
			   	return {
			   		results: data.items,
			   		pagination: {
			   			more: (params.page * data.pegination) < data.total_count
			   		}
			   	};
			},
		cache: true
		},
		escapeMarkup: function (markup) { return markup; },
		minimumInputLength: 1,

	});
}

utlt["cLog"] = function(url){
    console.log(url);
}

/*********************************/
/*common method for get all value*/
/*********************************/
utlt["GetAll"] =  function(url, htmlId, name, check, relationalCol, relationalName){
    
    check = typeof check == "undefined" ? 0 : check;
    relationalCol = typeof relationalCol == "undefined" ? false : relationalCol;
    relationalName = typeof relationalName == "undefined" ? false : relationalName;

    var htmlData = '';
    if(!check)
        htmlData = '<option value="" disabled selected> Select '+name+' </option>';
    else
        htmlData = '<option value="" disabled> Select '+name+' </option>';

    $.ajax({
        url : utlt.siteUrl(url)

    }).done(function(resData){
        $.each(resData,function(ind, val){                    
            let optionName = ((relationalCol != false) ? val[relationalCol][relationalName]+' >> ' : '') + val.name

            if(check == val.id){                        
                htmlData +=  '<option value = "'+val.id+'" selected >'+optionName+'</option>';                        
            }
            else{
                htmlData +=  '<option value = "'+val.id+'">'+optionName+'</option>';
            }                    
        });
        $(htmlId).html(htmlData);

    }).fail(function(failData){
        utlt.cLog(arguments);
    });
}
/*End getAll elements method*/



/****************************************/
/*common add method for insert form data*/
/****************************************/
utlt['Add'] = function(url, dataTable, withFile, successCallBackFun){

    $('#addForm .has-error').removeClass('has-error');
    $('#addForm').find('.help-block').empty();

    let ajaxOption = {
        url : utlt.siteUrl(url),
        type : "POST"        
    };

    if(typeof withFile == undefined || withFile == null)
        ajaxOption.data = $('#addForm').serialize();
    else{
        ajaxOption.processData = false;
        ajaxOption.contentType = false;        
        let formData = new FormData($('#addForm')[0]);        
        ajaxOption.data = formData;
    }

    $.ajax(ajaxOption).done(function(resData){
        $(dataTable).DataTable().ajax.reload();
        if(resData == 'fail')
            utlt.showMsg('danger',"<strong>NO network connection :( mail send failed</strong>");
        else{
            if(typeof successCallBackFun == "function")
                successCallBackFun();
            else
                utlt.showMsg('success',"<strong>Successfuly Added!! :-)</strong>");
        }

        $('#modalAdd').modal('hide');
        $('.modal-backdrop').removeClass('modal-backdrop fade in');


    }).fail(function(failData){

        $.each(failData.responseJSON.errors, function(inputName, errors){

            $("#addForm [name^="+inputName+"]").parent().removeClass('has-error').addClass('has-error');
            if(typeof errors == "object"){
                $("#addForm [name^="+inputName+"]").parent().find('.help-block').empty();

                $.each(errors, function(indE, valE){
                    $("#addForm [name^="+inputName+"]").parent().find('.help-block').append(valE+"<br>");
                });

            }
            else{
                $("#addForm [name^="+inputName+"]").parent().find('.help-block').html(valE);
            }

        });

    });
}
/*end add method*/



/****************************************/
/***common  method for Edit form data****/
/****************************************/
utlt['Edit'] = function(url, id, dataTable, withFile, successCallBackFun){

    $('#edit_form .has-error').removeClass('has-error');
    $('#edit_form').find('.help-block').empty();

    let ajaxOption = {
        url : utlt.siteUrl(url)+'/'+id,
        type : "PUT",        
    };

    if(typeof withFile == undefined || withFile == null)
        ajaxOption.data = $('#edit_form').serialize();
    else{
        ajaxOption.processData = false;
        ajaxOption.contentType = false;        
        let formData = new FormData($('#edit_form')[0]);        
        ajaxOption.data = formData;
    }

    $.ajax(ajaxOption).done(function(resData){
        if(dataTable != null)
            $(dataTable).DataTable().ajax.reload();
        if(resData == 'fail')
            utlt.showMsg('danger',"<strong>NO network connection :(calander and mail send failed</strong>");
        else{
            if(typeof successCallBackFun == "function")
                successCallBackFun();
            else
                utlt.showMsg('info',"<strong>Successfuly Updated!! :-)</strong>");
        }

        $('#modalEdit').modal('hide');
        $('.modal-backdrop').removeClass('modal-backdrop fade in');

    }).fail(function(failData){
        $.each(failData.responseJSON.errors, function(inputName, errors){            
            $("#edit_form [name^="+inputName+"]").parent().removeClass('has-error').addClass('has-error');
            if(typeof errors == "object"){
                $("#edit_form [name^="+inputName+"]").parent().find('.help-block').empty();

                $.each(errors, function(indE, valE){
                    $("#edit_form [name^="+inputName+"]").parent().find('.help-block').append(valE+"<br>");
                });

            }
            else{
                $("#edit_form [name^="+inputName+"]").parent().find('.help-block').html(errors.toString());
            }

        });
    });
}
/*end Edit method*/

/************************************************/
/***common  method for Delete a specefic data****/
/************************************************/
utlt['Delete'] = function(url, dataTableId, modalId){
    
    axios.delete(utlt.siteUrl(url))
    .then(resData => {
        showToast("Successfuly Deleted!! :-)", 'warning')
        if (typeof dataTableId == 'string')
            $(dataTableId).DataTable().ajax.reload();
        if (typeof modalId == 'string'){
            $(modalId).modal('hide');
            $('.modal-backdrop').removeClass('modal-backdrop fade in');
        }
    }).catch(failData => {
        utlt.cLog(arguments);
        if(failData.response.data.message.search('SQLSTATE\\[23000\\]') != -1){
            if (typeof modalId == 'string') {
                $(modalId).modal('hide');
                $('.modal-backdrop').removeClass('modal-backdrop fade in');
                showToast(">Database Relation Exisit :-", 'error')
            }
            else{
                showToast(">Database Relation Exisit :-", 'error')
            }
        }
    });
}
/*end Delete method*/


/****************************************/
/*common add method for insert form data*/
/****************************************/
utlt['asyncFalseRequest'] = function (type, url, formId, dataTable, redirectUrl, returnData, successCallBackFun) {
    return new Promise((resolvePost, rejectPost) => {
        $(document).find(formId+' .submitBtn').addClass('disabled');
        if (typeof type == 'undefined') {
            showToast('Please use the request type', 'warning');
            $(document).find(formId+' .submitBtn').removeClass('disabled');
            rejectPost();
        }

        $(document).find(formId + ' .has-error').removeClass('has-error');
        $(document).find(formId).find('.help-block').empty();
        
        let axiosOption = {
            method: 'Post',
            url: utlt.siteUrl(url),
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };
        
        let formData = new FormData($(document).find(formId)[0]);
        formData.append("_method", type);
        axiosOption.data = formData;

        axios(axiosOption).then(resData => {
            if (resData == 'fail') {
                showToast("NO network connection :( mail send failed)", 'danger')
            }
            else {
                showToast("Successfull !!");
                $(document).find(formId).trigger("reset");
                
                if (typeof successCallBackFun == "function") {
                    successCallBackFun();
                }
                
                if (typeof returnData == 'string' && returnData == true) {
                    var Jreturn = resData;
                }
            }

            if (typeof redirectUrl == "string") {
                window.location.replace(siteUrl(redirectUrl));
            }

            if (typeof dataTable == "string") {
                $(dataTable).DataTable().ajax.reload();
            }

            if (typeof returnData != 'undefined' && returnData == true) {
                resolvePost(Jreturn);
            }
            else {
                $(document).find(formId+' .submitBtn').removeClass('disabled');
                resolvePost(true);
            }
            $(document).find(formId+' .submitBtn').removeClass('disabled');

        }).catch(failData => {
            setError(failData, formId);
            $(document).find(formId+' .submitBtn').removeClass('disabled');
            if((typeof failData.response.data.message != 'undefined') && failData.response.data.message.search('SQLSTATE\\[23000\\]') != -1){
                showToast("Database Error!!",'error');
            }
            
            resolvePost(false);
        });
    });
}

utlt['asyncFalseStepRequeststep'] = function (type, url, formId, returnData, successCallBackFun) {
    $(document).find(formId+' .submitBtn').addClass('disabled');
    return new Promise((resolvePost, rejectPost) => {
        if (typeof type == 'undefined') {
            showToast('Please use the request type', 'warning');
            $(document).find(formId+' .submitBtn').removeClass('disabled');
            resolvePost(false);
        }

        $(document).find(formId + ' .has-error').removeClass('has-error');
        $(document).find(formId).find('.help-block').empty();
        
        let axiosOption = {
            method: 'Post',
            url: utlt.siteUrl(url),
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };
        
        let formData = new FormData($(document).find(formId)[0]);
        formData.append("_method", type);
        axiosOption.data = formData;

        axios(axiosOption).then(resData => {
            
            if (typeof successCallBackFun == "function") {
                successCallBackFun();
            }

            if (typeof returnData != 'undefined' && returnData == true) {
                resolvePost(resData);
            }
            else {
                $(document).find(formId+' .submitBtn').removeClass('disabled');
                resolvePost(true);
            }

            $(document).find(formId+' .submitBtn').removeClass('disabled');

        }).catch(failData => {
            setError(failData, formId);
            $(document).find(formId+' .submitBtn').removeClass('disabled');
            if((typeof failData.response.data.message != 'undefined') && failData.response.data.message.search('SQLSTATE\\[23000\\]') != -1){
                showToast("Database Error!!",'error');
            }

            resolvePost(false);
        });
    });
}

function setError(failData, formId) {
    $.each(failData.response.data.errors, function (inputName, errors) {
        try {
            
            let arrayInd = null;
            if (inputName.indexOf('.') > -1){
                nameArray = inputName.split('.');
                inputName = '';
                $.each(nameArray, function (index) {
                    if ($.isNumeric(nameArray[index]))
                        return false;
                    if (index > 0) {
                        inputName += '[';
                    }
                    inputName += nameArray[index];
                    if (index > 0) {
                        inputName += ']';
                    }
                });
                arrayInd = nameArray[(nameArray.length-1)];
            }

            inputSelector = $(document).find(formId + ' [name^="' + inputName + '"]');
            if (inputSelector.length > 1) {
                let newInputName = inputName + '[' + arrayInd + ']';
                let newInputSelector = $(document).find(formId + ' [name^="' + newInputName + '"]');
                if (typeof newInputSelector != 'undefined' && newInputSelector != null && newInputSelector.length != 0) {
                    inputSelector = newInputSelector;
                }
                else {
                    inputSelector = $(inputSelector)[arrayInd];
                }
            }
        
            $(inputSelector).closest('.form-group').removeClass('has-error').addClass('has-error');
            
            if (typeof errors == "object") {
                $(inputSelector).closest('.form-group').find('.help-block').empty();
                $.each(errors, function (indE, valE) {
                    if (arrayInd != null) {
                        valE = valE.split(('.' + arrayInd)).join('');
                        valE = valE.split('_').join(' ');
                    }
                    $(inputSelector).closest('.form-group').find('.help-block').append(valE + "<br>");
                });
                
            }
            else {
                $(inputSelector).closest('.form-group').find('.help-block').html(valE);
            }

            $(inputSelector).closest('.form-group').find('.help-block').removeClass('d-none');
        }
        catch{
            showToast('Please Check your Inputs', 'error');
        }

    });
}
/**
*   @abstract update status
*   @param url, url
*   @param status, changing status
*/
utlt['updateStatus'] = function(el, url, columnName, isConf){
    isConf = typeof isConf == "undefined" ? true : false;
    let isConfRes = true;
    let status  = (el.checked)?1:0;    
    let postData = { _token: $('meta[name="csrf-token"]').attr('content') };
    postData[columnName] = status;
    if(isConf){
        isConfRes = confirm("Are you sure want to cange the status!");        
    }

    if(isConfRes){
        $.post(utlt.siteUrl(url), postData, function (data) {
            if (data == 1) {
                showToast("Successfuly Updated!!");
            }
            else {
                showToast("Something went wrong!", 'error');
            }
        }).fail(function(){
            showToast("Something went wrong!", 'error');
            el.checked = !status;
        });
    }    
    else{
        el.checked = !status;
    }
}

/**
*   @abstract reset form
*   @param formId, formId
*/
utlt['resetForm'] = function (formId) {
    $(document).find(formId).trigger("reset");
}

/**
*   @abstract to show massege
*   @param type, Type of the massege
*   @param msg, Text of the massege
*   @param position, position of the massege
*   @param time, time to show of the massege
*/
function showToast(msg, type, position, time){
    let position_array = ['top-right', 'bottom-right', 'bottom-left', 'top-left', 'top-full-width', 'bottom-full-width', 'top-center','bottom-center'];
    let type_array = ['warning','info','error','warning'];

    time = (typeof time != 'undefined') ? (time*1000) : 2000;
    msg = (typeof msg != 'undefined') ? msg : 'Success!';
    type = ($.inArray(type, type_array) !== -1)?type:'success';
    position = ($.inArray(position, position_array) !== -1)?type:'top-right';

    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-" + position,
        "timeOut": time
    }

    toastr[type](msg);
}
/*end add method*/


setInterval(function(){
    $.get(utlt.siteUrl('alive'));
},1000 * 60 * 10);
