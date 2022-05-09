/*!

 =========================================================
 * Bootstrap Wizard - v1.1.1
 =========================================================

 * Product Page: https://www.creative-tim.com/product/bootstrap-wizard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/bootstrap-wizard/blob/master/LICENSE.md)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */

// Get Shit Done Kit Bootstrap Wizard Functions

searchVisible = 0;
transparent = true;


$(document).ready(function() {
    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    // Code for the Validator
    var $validator = $('.wizard-card .tab-content form').validate({
        rules: {
            owner_name: {
                required: true,
            },
            gender: {
                required: true,
            },
            id_number: {
                required: true,
            },

            phone: {
                required: true,
            },
            email: {
                required: true,
            },

        },
        messages: {
            owner_name: {
                owner_name: 'الاسم مطلوب <i class="zmdi zmdi-info"></i>'
            },
            gender: {
                gender: 'الجنس مطلوب <i class="zmdi zmdi-info"></i>'
            },
            phone: {
                phone: ' رقم الجوال مطلوب<i class="zmdi zmdi-info"></i>'
            },
            email: {
                email: 'البريد الالكتروني مطلوب <i class="zmdi zmdi-info"></i>'
            },
        },
    });

    // Wizard Initialization
    $('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
            var $valid = $('.wizard-card .tab-content form').valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
        },

        onInit: function(tab, navigation, index) {

            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            $width = 95 / $total;
            var $wizard = navigation.closest('.wizard-card');

            $display_width = $(document).width();

            if ($display_width < 600 && $total > 3) {
                $width = 50;
            }

            navigation.find('li').css('width', $width + '%');
            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);
            refreshAnimation($wizard, index);
            $('.moving-tab').css('transition', 'transform 0s');
        },

        onTabClick: function(tab, navigation, index) {

            var $valid = $('.wizard-card form').valid();

            if (!$valid) {
                return false;
            } else {
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead

            if ($current == 1) {
                $("#submit1").css('display', 'block');
                $("#submit3").css('display', 'none');
                $("#sendd").css('display', 'none');
                $($wizard).find('.btn-finish').hide();

            }
            if ($current == 2) {
                $("#submit1").css('display', 'none');
                $("#sendd").css('display', 'none');
                $("#submit3").css('display', 'none');
                $($wizard).find('.btn-finish').hide();
            }
            if ($current >= 3) {
                $("#submit1").css('display', 'none');
                $("#sendd").css('display', 'none');
                $("#submit3").css('display', 'block');
                $($wizard).find('.btn-finish').hide();
            }
            if ($current == 5) {
                $("#submit1").css('display', 'none');
                $("#sendd").css('display', 'none');
                $("#submit3").css('display', 'none');
                $($wizard).find('.btn-finish').show();
            }



            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function() {
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if (!index == 0) {
                $(checkbox).css({
                    'opacity': '0',
                    'visibility': 'hidden',
                    'position': 'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity': '1',
                    'visibility': 'visible'
                });
            }

            refreshAnimation($wizard, index);
        },


    });

    $('#submit1').on('click', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var form = $('#signup-form1')[0];

        var data = new FormData(form);
        var owner_name = $("input[name='owner_name']").val();
        data.append('owner_name', owner_name);
        var gender = $('#gender option:selected').val();
        data.append('gender', gender);
        var phone = $("input[name='phone']").val();
        data.append('phone', phone);
        var email = $("input[name='email']").val();
        data.append('email', email);
        var id_number = $("input[name='id_number']").val();
        data.append('id_number', id_number);


        $.ajax({
            method: 'post',
            url: "appstore",
            processData: false,
            contentType: false,
            data: data,
        });
    });
    $('#submit2').on('click', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var form = $('#signup-form2')[0];

        var data = new FormData(form);
        var code = $("input[name='code']").val();
        data.append('code', code);

        $.ajax({
            method: 'post',
            url: "storecode",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                if (data.status == true) {
                    $('#msg_success').show();
                    $("#sendd").css('display', 'block');
                } else {
                    $('#msg_error').show();
                }
            },
            error: function(reject) {
                ("#msg_error").append("error");

            }
        });
    });

    $('#save').on('click', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var form = $('#signup-form3')[0];

        var data = new FormData(form);
        var nationality = $("input[name='nationality']").val();
        data.append('nationality', nationality);

        var city = $('#city option:selected').val();
        data.append('city', city);
        var neighborhood = $('#neighborhood option:selected').val();
        data.append('neighborhood', neighborhood);

        var relativeـname = $("input[name='relativeـname']").val();
        data.append('relativeـname', relativeـname);
        var phoneـrelative = $("input[name='phoneـrelative']").val();
        data.append('phoneـrelative', phoneـrelative);
        var relative = $("input[name='relative']").val();
        data.append('relative', relative);
        var salary = $("input[name='salary']").val();
        data.append('salary', salary);
        var current_job = $("input[name='current_job']").val();
        data.append('current_job', current_job);
        var owner_condition = $("input[name='owner_condition']").val();
        data.append('owner_condition', owner_condition);
        var id_photo = $("input[name='id_photo']").val();
        data.append('id_photo', id_photo);
        var medical_report = $("input[name='medical_report']").val();
        data.append('medical_report', medical_report);
        var housing_contract = $("input[name='housing_contract']").val();
        data.append('housing_contract', housing_contract);
        var definition_salary = $("input[name='definition_salary']").val();
        data.append('definition_salary', definition_salary);
        var visa_photo = $("input[name='visa_photo']").val();
        data.append('visa_photo', visa_photo);
        var other = $("input[name='other']").val();
        data.append('other', other);
        $.ajax({
            method: 'post',
            url: "storeother",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {

                // Swal.fire({
                //       icon: 'success',
                //         width: '500px',
                //          height: '500px',
                //   timer: 2500,
                //   title: ' تم التسجيل بنجاح',
                //   showClass: {
                //     popup: 'animate__animated animate__fadeInDown'
                //   },
                //   hideClass: {
                //     popup: 'animate__animated animate__fadeOutUp'
                //   }

                // })

                Swal.fire({
                    title: ' تم التسجيل بنجاح',
                    imageUrl: 'https://cdn-icons-png.flaticon.com/512/189/189677.png?w=740',
                    imageWidth: 100,
                    imageHeight: 100,
                    showConfirmButton: false,
                    width: '500px',
                    height: '600px',
                    timer: 1500,
                })
                window.location.href = 'http://www.qalbi.sa/';
            }
        });
    });
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function() {
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked', 'true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked', 'true');
        }
    });

    $('.set-full-height').css('height', 'auto');
    //


});



//Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function() {
    $('.wizard-card').each(function() {
        $wizard = $(this);
        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s',

        });
    });
});

function refreshAnimation($wizard, index) {
    total_steps = $wizard.find('li').length;
    move_distance = $wizard.width() / total_steps;
    step_width = move_distance;
    move_distance *= index;

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform': 'translate3d(-' + move_distance + 'px, 0, 0)',
        'transition': 'all 0.3s ease-out',

    });
}

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};