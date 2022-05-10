<!doctype html>
<html lang="ar"  dir="rtl" style="direction: rtl">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>qalbi</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
	<!-- CSS Files -->
    <link href="{{ asset('assets/front2/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/front2/css/gsdk-bootstrap-wizard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/front2//css/demo.css') }}" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- CSS Just for demo purpose, don't include it in your project -->
</head>
<style>

body{
    background-color:#737680;
}
header{
    background-color: #fff;
    box-shadow: #ECF0FA;
    color: #000;
}
header img{
    width: 30%;
}
.info p{
    color: #302e2e;
}
header h4{
    color: #16736C;
    margin-top: 15px;
font-size: 19px;
}
input[type="file"] {
    border: 1px solid #a19a9a;
    padding: 10px;
}
.info .pp p{
        color: #302e2e;
    margin-top: 16px;
    }
    .info .pp p span{
        color: #16736C;
    font-size: 12px;
    }
    .form-select {
    font-size: 19px;
}
</style>
<body>

<div class="image-container set-full-height">
    <!--   Creative Tim Branding   -->


	<!--  Made With Get Shit Done Kit  -->


    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-12 container">

            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card px-2" data-color="orange" id="wizardProfile">
                    {{-- <form method="POST" class="formm" id="" action="" class="signup-form2" enctype="multipart/form-data">
                     @csrf --}}
                        <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                    	<div class="wizard-header text-center pb-3">
                            <h2 class="py-4" style="color:#666262;">Register a donation request</h2>

                    	</div>

						<div class="wizard-navigation">
							<ul>
	                            <li ><a href="#about" data-toggle="tab">personal information</a></li>
                                <li><a href="#code" data-toggle="tab">activation code</a></li>
	                            <li><a href="#contact" data-toggle="tab">contact information</a></li>
	                            <li><a href="#data" data-toggle="tab">The reason for the need for donations</a></li>
                                <li><a href="#attachments" data-toggle="tab"> attachments</a></li>
	                        </ul>

						</div>


                        <div class="tab-content form1">
                            <div class="tab-pane px-3" id="about">
                                <form method="POST" class="formm" id="signup-form" action="{{route('application.store')}}" class="signup-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                <div class="row">
                                    <div class="col-md-4 py-3  col-sm-12 px-2">
                                        <label for="owner_name" class="form-label">name</label>
                                        <input type="text" class="form-control"  name="owner_name" id="owner_name" placeholder="اسم المريض" />
                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="" class="form-label">gender</label>
                                        <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                          </select>
                                    </div>

                                    <div class="col-md-4  py-3 col-sm-12 form-password">
                                        <label for="password" class="form-label"> phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone"  placeholder="9865442713093" />

                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12">
                                        <label for="your_avatar" class="form-label">email</label>
                                        <div class="form-file">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="mo@gmail.com"/>

                                        </div>
                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">id number</label>
                                        <input type="text" class="form-control" name="id_number" id="" placeholder=" " />
                                    </div>

                                </div>
                                </form>
                            </div>
                            <div class="tab-pane container" id="code">
                                <form method="POST" class="formm" id="signup-form2" action="" >
                                <div class="row px-5 mt-5 pt-5">
                                    <label class="col-2 form-label" style="font-size: 20px;padding-top: 7px;color: #504e4e;">activation code</label>
                                    <div class="col-4">
                                        <input class="form-control" type="text" name="code"/>
                                        <p>يرجي مراجعة البريد اللكتروني</p>
                                    </div>
                                </div>
                            <input type='button' id="submit2" class='btcode btn   btn-fill btn-warning btn-wd btn-sm' name='next' value='ارسال' />
                            <div id="msg_success" class="w-50 mx-4 mt-2 alert alert-success" role="alert"
                            style="display: none">
                         يرجي اكمال التسجيل
                        </div>
                        <div id="msg_error" class="w-50 mx-4 alert alert-error" role="alert"
                            style="display: none;background-color: #de2525; color:#fff">
                          يرجي التأكد من كود التفعيل
                        </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="contact">
                                <form method="POST" class="formm" id="signup-form3" action="{{route('application.storeother')}}" class="signup-form2" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="email" class="form-label">nationality</label>
                                        <input type="text" class="form-control" name="nationality" id="nationality"  placeholder="الجنسية " />
                                    </div>

                                    <div class="col-md-4 py-3  col-sm-12 px-2">
                                        <label for="username" class="form-label">city</label>
                                        <select class="form-select" name="city" id="city" aria-label="Default select example">
                                            <option value="الرياض">الرياض</option>
                                            <option value="الدرعية">الدرعية </option>
                                            <option value="الدوادمي">الدوادمي</option>
                                            <option value="القويعية">القويعية</option>
                                            <option value="الأفلاج">الأفلاج </option>
                                            <option value="سدير">سدير</option>
                                            <option value="شقراء">شقراء</option>
                                            <option value="عفيف">عفيف </option>
                                            <option value="ضرماء">ضرماء</option>
                                            <option value="رماح">رماح</option>
                                            <option value="حريملاء">حريملاء </option>
                                            <option value="الغاط">الغاط</option>
                                            <option value="الخرج">الخرج</option>
                                            <option value="المجمعة">المجمعة </option>
                                            <option value="الحريق">الحريق</option>
                                            <option value="وادي الدواسر">وادي الدواسر</option>
                                            <option value="الزلفي">الزلفي </option>
                                            <option value="حوطة تميم">حوطة تميم</option>
                                            <option value="السليل">السليل </option>
                                            <option value="المزاحمية">المزاحمية </option>
                                            <option value="ثادق">ثادق </option>
                                          </select>
                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="username" class="form-label"> neighborhood</label>
                                        <select class="form-select" name="neighborhood" id="neighborhood" aria-label="Default select example">
                                            <option value="حي الملز.">حي الملز.</option>
                                            <option value="حي الفاخرية.">حي الفاخرية.</option>
                                            <option value="حي البطحاء.">حي البطحاء.</option>
                                            <option value="حي المرقب.">حي المرقب.</option>
                                            <option value="حي المربع.">حي المربع.</option>
                                            <option value="حي الصالحية.">حي الصالحية.</option>
                                            <option value="وحي الديرة.">وحي الديرة.</option>
                                            <option value="حي الازدهاء.">حي الازدهاء.</option>
                                            <option value="حي قرناطة.">حي قرناطة.</option>
                                            <option value="حي الربيع.">حي الربيع.</option>
                                            <option value="حي المرسلات.">حي المرسلات.</option>
                                            <option value="حي الصحافة.">حي الصحافة.</option>
                                            <option value="حي الغدير.">حي الغدير.</option>
                                            <option value="حي المغرزات.">حي المغرزات.</option>
                                            <option value="حي النخيل.">حي النخيل.</option>
                                            <option value="حي النخيل الشرقي.">حي النخيل الشرقي.</option>
                                            <option value="حي النخيل الغربي.">حي النخيل الغربي.</option>
                                            <option value="حي النفل.">حي النفل.</option>
                                            <option value="حي الورود.">حي الورود.</option>
                                            <option value="حي الملقا.">حي الملقا.</option>
                                            <option value="حي المروج.">حي المروج.</option>
                                            <option value="حي الواحة.">حي الواحة.</option>
                                            <option value="حي العقيق.">حي العقيق.</option>
                                            <option value="وحي الرائد.">وحي الرائد.</option>
                                            <option value="حي الريان.">حي الريان.</option>
                                            <option value="حي النسيم.">حي النسيم.</option>
                                            <option value="حي الشهداء.">حي الشهداء.</option>
                                            <option value="حي الربوة.">حي الربوة.</option>
                                            <option value="حي الروضة.">حي الروضة.</option>
                                            <option value="حي غرناطة.">حي غرناطة.</option>
                                            <option value="حي النهضة.">حي النهضة.</option>
                                            <option value="حي الفلاح.">حي الفلاح.</option>
                                            <option value="حي الجزيرة.">حي الجزيرة.</option>
                                            <option value="حي النظيم.">حي النظيم.</option>
                                            <option value="حي اليرموك.">حي اليرموك.</option>
                                            <option value="حي السلي.">حي السلي.</option>
                                            <option value="حي إشبيليا.">حي إشبيليا.</option>
                                            <option value="حي القدس.">حي القدس.</option>
                                            <option value="حي الرواد.">حي الرواد.</option>
                                            <option value="حي الحمراء.">حي الحمراء.</option>
                                            <option value="حي المغرزات.">حي المغرزات.</option>
                                            <option value="حي قرطبة.">حي قرطبة.</option>
                                            <option value="حي الريان.">حي الريان.</option>
                                            <option value="حي الخليج.">حي الخليج.</option>
                                            <option value="حي إشبيلية.">حي إشبيلية.</option>
                                            <option value="حي الشميسي.">حي الشميسي.</option>
                                            <option value="حي المصانع.">حي المصانع.</option>
                                            <option value="حي المروة.">حي المروة.</option>
                                            <option value="حي المنصورة.">حي المنصورة.</option>
                                            <option value="حي بن تركي.">حي بن تركي.</option>
                                            <option value="حي الحاير.">حي الحاير.</option>
                                            <option value="حي الشفاء.">حي الشفاء.</option>
                                            <option value="حي الشعلان.">حي الشعلان.</option>
                                            <option value="حي بدر وحي السويدي.">حي بدر وحي السويدي.</option>
                                            <option value="حي الفواز.">حي الفواز.</option>
                                            <option value="حي اليمامة.">حي اليمامة.</option>
                                            <option value="حي الحزم.">حي الحزم.</option>
                                            <option value="حي شبرا.">حي شبرا.</option>
                                            <option value="حي العزيزية.">حي العزيزية.</option>
                                            <option value="حي الدريهمية.">حي الدريهمية.</option>
                                            <option value="حي الدار البيضاء.">حي الدار البيضاء.</option>
                                            <option value="وحي نمار.">وحي نمار.</option>
                                            <option value="حي البديعة،.">حي البديعة،.</option>
                                            <option value=" حي ظهرة البديعة"> حي ظهرة البديعة</option>
                                            <option value="حي جامعة الملك سعود، .">حي جامعة الملك سعود، .</option>
                                            <option value="حي شبرا">حي شبرا</option>
                                            <option value="حي لبن، ">حي لبن، </option>
                                            <option value="حي عرقة، .">حي عرقة، .</option>
                                            <option value="حي السويدي.">حي السويدي.</option>
                                            <option value="حي العريجاء">حي العريجاء</option>
                                            <option value="حي الدرعية">حي الدرعية</option>

                                        </select>
                                    </div>

                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="email" class="form-label">The name of the closest contact person</label>
                                        <input type="text" class="form-control" name="relativeـname" id="email" placeholder=" " />
                                    </div>
                                    <div class="col-md-4  py-3 col-sm-12 form-password">
                                        <label for="phoneـrelative" class="form-label">The mobile number of the nearest person</label>
                                        <input type="text" class="form-control" name="phoneـrelative" id="phoneـrelative"  placeholder="" />

                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">relative relation</label>
                                        <input type="text" class="form-control" name="relative" id="email" placeholder=" " />
                                    </div>
                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">salary</label>
                                        <input type="text" class="form-control" name="salary" id="email" placeholder=" " />
                                    </div>


                                    <div class="col-md-4 py-3 col-sm-12 px-2">
                                        <label for="username" class="form-label"> current job</label>
                                        <input type="text" class="form-control" name="current_job" id="email" placeholder=" " />
                                    </div>



                                </div>
                            </div>
                            <div class="tab-pane text-center px-4" id="data">

                                    <div class=" row">
                                        <div class="col-md-8 d-flex py-3  col-sm-12 px-2">
                                            <label for="username" class="form-label mt-5"style="width:180px">Reason for asking for donations</label>
                                            <textarea  class="form-control" name="owner_condition" rows="8"></textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class="tab-pane px-2" id="attachments">
                                <div class="row px-2" style="">
                                    <div class="col-md-4 py-2 my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">id photo</label>
                                        <input type="file" name="id_photo" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                    <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">medical report</label>
                                        <input type="file" name="medical_report" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                    <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">housing contract</label>
                                        <input type="file" name="housing_contract" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                    <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">definition salary </label>
                                        <input type="file" name="definition_salary" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                    <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">visa photo </label>
                                        <input type="file" name="visa_photo" accept="image/png, image/jpeg, application/pdf">
                                    </div>
                                    <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                        <label for="username" class="form-label">other </label>
                                        <input type="file" name="other" accept="image/png, image/jpeg, application/pdf">
                                    </div>

                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='previous' />

                            </div>

                            <div class="pull-left">
                                <input type='button' id="submit1" class='btcode btn btn-next  btn-fill btn-warning btn-wd btn-sm' name='next' value='next' />
                                <input type='button' id="sendd" class='btcode btn btn-next  btn-fill btn-warning btn-wd btn-sm' name='next' value='next' />
                                <input type='button' id="submit3"   class='btcode btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='next' />

                                <input type='button' id="save" class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='save'>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    {{-- </form> --}}
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->



</div>

</body>

	<!--   Core JS Files   -->
    <script src="{{asset('assets/admin/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>

	<script src="{{ asset('assets/front2/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->	<script src="{{ asset('assets/front2/js/gsdk-bootstrap-wizard.js') }}"></script>

    <script src="{{ asset('assets/front2/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/front2/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<script src="{{ asset('assets/front2/js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->


</html>
