$('document').ready(function(){
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validateUsername(uname) {
        const re = /^[a-zA-Z0-9\_]+$/;
        return re.test(String(uname).toLowerCase());
    }

    var username_state = false;
    var email_state = false;
    var password_state = false;
    $('#username').on('keyup', function(){
        var username = $('#username').val();
        if (username == '') {
            username_state = false;
            return;
        }
        $.ajax({
            url: '../html/register.php',
            type: 'post',
            data: {
                'username_check' : 1,
                'username' : username,
            },

            success: function(response){
                if (response == 'taken' ) {
                    username_state = false;
                    $('#username').css({'border': '1.5px solid #000000'});
                    $('#username').parent().removeClass();
                    $('#username').parent().addClass("form_error");
                    $('#username').siblings("label").text('Username ❌ already taken...');
                }else if (response == 'not_taken' && validateUsername(username)) {
                    // border jadi ijo
                    $('#username').css({'border': '1.5px solid #1DB954'});
                    username_state = true;
                    $('#username').parent().removeClass();
                    $('#username').parent().addClass("form_success");
                    $('#username').siblings("label").text('Username ✔️');
                }else if (validateUsername(username) == false){
                    $('#username').css({'border': '1.5px solid #000000'});
                    $('#username').parent().removeClass();
                    $('#username').parent().addClass("form_error");
                    $('#username').siblings("label").text('Username ❌ - only allows alphanumeric & "_"');
                }
            }
        });
    });
     $('#email').on('keyup', function(){
        var email = $('#email').val();
        if (email == '') {
            email_state = false;
            return;
        }
        $.ajax({
            url: '../html/register.php',
            type: 'post',
            data: {
                'email_check' : 1,
                'email' : email,
            },
            success: function(response){
                if (response == 'taken' ) {
                email_state = false;
                    $('#email').css({'border': '1.5px solid #000000'});
                    $('#email').parent().removeClass();
                    $('#email').parent().addClass("form_error");
                    $('#email').siblings("label").text('Email address ❌ - email has been registered before...');
                }else if (response == 'not_taken' && validateEmail(email)) {
                    // border jadi ijo
                    $('#email').css({'border': '1.5px solid #1DB954'});
                    email_state = true;
                    $('#email').parent().removeClass();
                    $('#email').parent().addClass("form_success");
                    $('#email').siblings("label").text('Email address ✔️');
                }else if (validateEmail(email) == false){
                    $('#email').css({'border': '1.5px solid #000000'});
                    $('#email').parent().removeClass();
                    $('#email').parent().addClass("form_error");
                    $('#email').siblings("label").text('Email address ❌ - invalid format...');
                }
            }
        });
    });

    $('#password').on('keyup', function(){
        var confirmpassword = $('#confirmpassword').val();
        var password = $('#password').val();
        if (password == '') {
            password_state = false;
            return;
        }
        $.ajax({
            url: '../html/register.php',
            type: 'post',
            data: {
                'password_check' : 1,
                'password' : password,
            },
            success: function(response){
                if (password != confirmpassword) {
                    $('#confirmpassword').css({'border': '1.5px solid #000000'});
                    password_state = false;
                    $('#confirmpassword').parent().removeClass();
                    $('#confirmpassword').parent().addClass("form_error");
                    $('#confirmpassword').siblings("label").text('Confirm password ❌ - please enter the same password');
                }else{
                    // border jadi ijo
                    $('#confirmpassword').css({'border': '1.5px solid #1DB954'});
                    password_state = true;
                    $('#confirmpassword').parent().removeClass();
                    $('#confirmpassword').parent().addClass("form_success");
                    $('#confirmpassword').siblings("label").text('Confirm password ✔️');
                }
            }
        });
    });

    $('#confirmpassword').on('keyup', function(){
        var confirmpassword = $('#confirmpassword').val();
        var password = $('#password').val();
        if (confirmpassword == '') {
            confirmpassword_state = false;
            return;
        }
        $.ajax({
            url: '../html/register.php',
            type: 'post',
            data: {
                'confirm_password' : 1,
                'confirmpassword' : confirmpassword,
            },
            success: function(response){
                if (password != confirmpassword) {
                    $('#confirmpassword').css({'border': '1.5px solid #000000'});
                    password_state = false;
                    $('#confirmpassword').parent().removeClass();
                    $('#confirmpassword').parent().addClass("form_error");
                    $('#confirmpassword').siblings("label").text('Confirm password ❌ - please enter the same password');
                }else{
                    // border jadi ijo
                    $('#confirmpassword').css({'border': '1.5px solid #1DB954'});
                    password_state = true;
                    $('#confirmpassword').parent().removeClass();
                    $('#confirmpassword').parent().addClass("form_success");
                    $('#confirmpassword').siblings("label").text('Confirm password ✔️');
                }
            }
        });
    });

    $('#reg_btn').on('click', function(){
        var username = $('#username').val();
        var email = $('#email').val();
        var nama = $('#nama').val();
        var password = $('#password').val();
        if (username_state == false || email_state == false || password_state == false) {
            $('#error_msg').text('Please fix the errors in the form first');
            alert('Fix the errors in the form first');
       }else{
         // proceed with form submission
         $.ajax({
             url: '../html/register.php',
             type: 'post',
             data: {
                 'save' : 1,
                 'email' : email,
                 'nama' : nama,
                 'username' : username,
                 'password' : password,
             },
             success: function(response){
                 alert('user saved');
                 $('#username').val('');
                 $('#email').val('');
                 $('#password').val('');
                 window.location.href = ('../html/dashboard.php');
             }
         });
        }
    });
   });
