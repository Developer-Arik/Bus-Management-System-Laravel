$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('token')
    }
});

$("#toggle-offcanvas").click(function(){
 $("#offcanvas").fadeIn(280);
 $("body").addClass("overflow-hidden");
});
$('#offcanvas-close-button').click(function(){
 $("#offcanvas").fadeOut(280);
 $("body").removeClass("overflow-hidden");
});

$('.img-cont-single .icon').click(function(){
 console.log('Clicked');
});

const header_height = document.querySelector("header").clientHeight;

$(".spacer-header").css('height', header_height);

$( window ).height();

$("#otp-box").submit(function (e) {
    e.preventDefault();

    const email = $("#email-log").val();

    const code = $("#pad-log").val();

    $.ajax({
        type: "POST",
        url: "/ajax/verify-forgot-password",
        data: {
            "email" : email,
            "code" : code
        },
        dataType: "JSON",
        statusCode: {
            200 : function (data){
                $(".msg-box").html('');

                // alert(data.token);

                setTimeout(() => {
                    window.location.replace("/password-reset/"+data.token);
                },500);
            },
            400: function (data){
                $(".msg-box").html('');
                $('.msg-box').html(`
                <div class="alert alert-danger">
                    ${data.responseJSON.message}
                </div>`);
            },
            422 : function (data){
                $(".msg-box").html('');
                $('.msg-box').html(`
                <div class="alert alert-danger">
                    ${data.responseJSON.message}
                </div>`);
            }
        }
    });
});
$("#forgot-box").submit(function(e){
    e.preventDefault();

    const email = $("#email-log").val();
    if(email!=''){
        $(".msg-box").html(`
        <div class="alert alert-success">
            Loading...
        </div>`);
        $.ajax({
            type: "POST",
            url: "/ajax/forgot-password",
            data: {
                "email" : email
            },
            dataType: "JSON",
            statusCode: {
                200: function(data) {
                    $('#forgot-box').hide();
                    $("#otp-box").show();
                    $(".msg-box").html('');
                    $('.msg-box').html(`
                        <div class="alert alert-success">
                            ${data.message}
                        </div>
                    `);

                    setTimeout(() => {
                        $('#forgot-password-resend-email').removeClass('disabled');
                    },1000*60);
                },
                400: function(data){
                    $(".msg-box").html('');
                    $('.msg-box').html(`
                    <div class="alert alert-danger">
                        ${data.responseJSON.message}
                    </div>
                `);
                },
                422: function (data){
                    $(".msg-box").html('');
                    $('.msg-box').html(`
                    <div class="alert alert-danger">
                        ${data.responseJSON.errors.email}
                    </div>
                `);
                }
            }
        });
    }else{
        $(".msg-box").html('');
        $('.msg-box').html(`
            <div class="alert alert-danger">
                Email field is required
            </div>
        `);
    }
});
$("#forgot-password-resend-email").click(function(){
    const email = $("#email-log").val();

    $.ajax({
        type: "POST",
        url: "/ajax/forgot-password",
        data: {
            "email" : email
        },
        dataType: "JSON",
        statusCode: {
            200: function(){
                $('#forgot-box').hide();
                $("#otp-box").show();
                $(".msg-box").html('');
                $('.msg-box').html(`
                    <div class="alert alert-success">
                        Resend Email Succesfully
                    </div>
                `);
                $("#forgot-password-resend-email").addClass('disabled');

                setTimeout(() => {
                    $('#forgot-password-resend-email').removeClass('disabled');
                },1000*60);
            },
            400: function(data){
                $(".msg-box").html('');
                $('.msg-box').html(`
                <div class="alert alert-danger">
                    ${data.responseJSON.message}
                </div>
            `);
            },
            422: function (data){
                $(".msg-box").html('');
                $('.msg-box').html(`
                <div class="alert alert-danger">
                    ${data.responseJSON.errors.email}
                </div>
            `);
            }
        }
    });
});
