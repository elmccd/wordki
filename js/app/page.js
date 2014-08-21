function validateName(){
    var input = $('#register-form #name');
    var el = input.parent('.controls').find('.help-inline');
    if(input.val()!=''){
        input.closest('.control-group').addClass('success');
        el.fadeIn().css("display", "inline-block");
        el.html('<span class="label label-success"><i class="icon-ok icon-white"></i></span>');
        return true;
    } else {
        input.closest('.control-group').removeClass('success');
        el.fadeOut();
        el.html('');
        return false;
    }
}

function validatePassword(){
    var input = $('#register-form #password');
    var el = input.parent('.controls').find('.help-inline');
    if(input.val().length>5){
        input.closest('.control-group').addClass('success');
        el.fadeIn().css("display", "inline-block");
        el.html('<span class="label label-success"><i class="icon-ok icon-white"></i></span>');
        return true;
    } else {
        input.closest('.control-group').removeClass('success');
        el.fadeOut();
        el.html('');
        return false;
    }
}

function validatePassword2(){
    var input = $('#register-form #password-repeat');
    var el = input.parent('.controls').find('.help-inline');
    if(input.val()==$('#register-form #password').val() && input.val().length>5){
        input.closest('.control-group').addClass('success');
        el.fadeIn().css("display", "inline-block");
        el.html('<span class="label label-success"><i class="icon-ok icon-white"></i></span>');
        return true;
    } else {
        input.closest('.control-group').removeClass('success');
        el.fadeOut();
        el.html('');
        return false;
    }
}

function validateEmail(){
    var input = $('#register-form #mail');
    var el = input.parent('.controls').find('.help-inline');
    if(validateEmailFunc(input.val())){
        input.closest('.control-group').addClass('success');
        el.fadeIn().css("display", "inline-block");
        el.html('<span class="label label-success"><i class="icon-ok icon-white"></i></span>');
        return true;
    } else {
        input.closest('.control-group').removeClass('success');
        el.fadeOut();
        el.html('');
        return false;
    }
}

function validateEmailFunc(string){
    var atpos=string.indexOf("@");
    var dotpos=string.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=string.length)
    {
        return false;
    }
    return true;
}

function runAllValidate(){
    validateName();
    validatePassword();
    validatePassword2();
    validateEmail();
}
$('#register-form .input-block-level').keyup(function(){
    runAllValidate()
});


$('#register-form .input-block-level').focus(function(){
    runAllValidate()
});

$('#register-form .input-block-level').change(function(){
    runAllValidate()
});

$('#register-form button').click(function(e){


    if(validateName()===false){
        var input = $('#register-form #name');
        var el = input.parent('.controls').find('.help-inline');
        input.closest('.control-group').addClass('error');
        el.fadeIn().css("display", "inline-block");
        el.html('<span class="label label-error"><i class="icon-warning-sign icon-white"></i> Wypełnij poprawnie to pole!</span>');
    }

    if(validateName()!==false &&
    validatePassword()!==false &&
    validatePassword2()!==false &&
    validateEmail()!==false){
        $(this).submit();
    }
});