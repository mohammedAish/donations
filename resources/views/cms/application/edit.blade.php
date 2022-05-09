@extends('cms.parent')

@section('title',__('cms.applications'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.applications'))
@section('page-md',__('cms.index'))

@section('styles')

@endsection

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor mt-5 pt-5" id="kt_content">

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                   الطلبات
                </h3>
            </div>

        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="kt-portlet__body " >
                <div class="row">
                    <div class="col-md-4 py-3  col-sm-12 px-2">
                        <label for="username" class="form-label">اسم المريض</label>
                        <div>
                            <label for="" class="labelborder form-control">{{$application->owner_name}}</label>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="" class="form-label"> الجنس</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->gender}}</label>
                        </div>
                    </div>

                    <div class="col-md-4  py-3 col-sm-12 form-password">
                        <label for="password" class="form-label">رقم الجوال</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->phone}}</label>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 col-sm-12">
                        <label for="your_avatar" class="form-label">البريد الالكتروني</label>
                        <div class="form-file">
                            <div>
                                <label for="" class="labelborder form-control"> {{$application->email}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="username" class="form-label"> رقم الهوية</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->id_number}}</label>
                        </div>
                    </div>

                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="email" class="form-label">الجنسية</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->nationality}}</label>
                        </div>
                    </div>

                    <div class="col-md-4 py-3  col-sm-12 px-2">
                        <label for="username" class="form-label">المدينة</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->city}}</label>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="username" class="form-label"> الحي</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->neighborhood}}</label>
                        </div>
                    </div>

                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="email" class="form-label">اسم أقرب شخص للاتصال</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->relativeـname}}</label>
                        </div>
                    </div>
                    <div class="col-md-4  py-3 col-sm-12 form-password">
                        <label for="password" class="form-label">رقم الجوال لأقرب شخص</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->relativeـphone}}</label>
                        </div>

                    </div>
                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="username" class="form-label"> صلة القرابة</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->relative}}</label>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 col-sm-12 px-2">
                        <label for="username" class="form-label"> الراتب الشهري</label>
                        <div>
                            <label for="" class="labelborder form-control"> {{$application->salary}}</label>
                        </div>                        </div>


                        <div class="col-md-8  py-3  col-sm-12 px-2">
                            <label for="username" class="form-label"style="width:180px">سبب طلب  المعونة </label>
                            <textarea  class="form-control" name="patient_condition" rows="8">{{$application->owner_condition}}</textarea>
                        </div>

                    <div class="tab-pane px-2 pt-5" id="attachments">
                        <div class="row px-2" style="">
                            <div class="col-md-4 py-2 my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">صورة هوية المريض</label>
                                 <a href="#" class="pop">
                                @if($application->id_photo != NULL)
                              @if(pathinfo($application->id_photo)
                                ['extension']=='pdf')

                                     <embed type="application/pdf" src="{{asset('img/'.$application->id_photo)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                   @else
                                   <img src="{{asset('img/'.$application->id_photo)}}" style="width:100%; height:200px;">
                                   @endif
                                   @endif
                            </div>
                        </a>
                            <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">تقرير طبي حديث و مفصل </label>
                                 <a href="#" class="pop">
                                @if($application->medical_report != NULL)

                                @if(pathinfo($application->medical_report)
                                 ['extension']=='pdf')

                                      <embed type="application/pdf" src="{{asset('img/'.$application->medical_report)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                    @else
                                    <img src="{{asset('img/'.$application->medical_report)}}" style="width:100%; height:200px;">
                                    @endif
                                    @endif
                                      </a>
                            </div>
                            <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">صورة من عقد إيجار السكن / فاتورة كهرباء</label>
                                 <a href="#" class="pop">
                                @if($application->housing_contract != NULL)

                                @if(pathinfo($application->housing_contract)
                                 ['extension']=='pdf')

                                      <embed type="application/pdf" src="{{asset('img/'.$application->housing_contract)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                    @else
                                    <img src="{{asset('img/'.$application->housing_contract)}}" style="width:100%; height:200px;">
                                    @endif
                                    @endif
                                      </a>
                            </div>
                            <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">تعريف من الكفيل بالراتب للمريض أو ولي أمره  </label>
                                 <a href="#" class="pop">
                                @if($application->definition_salary != NULL)

                               @if(pathinfo($application->definition_salary)
                                ['extension']=='pdf')

                                     <embed type="application/pdf" src="{{asset('img/'.$application->definition_salary)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                   @else
                                   <img src="{{asset('img/'.$application->definition_salary)}}" style="width:90%; height:200px;">
                                   @endif
                                   @endif
                                 </a>
                            </div>
                            <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">صورة تأشيرة الزيارة  </label>
                                 <a href="#" class="pop">
                                @if($application->visa_photo != NULL)

                                @if(pathinfo($application->visa_photo)
                                 ['extension']=='pdf')

                                      <embed type="application/pdf" src="{{asset('img/'.$application->visa_photo)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                    @else
                                    <img src="{{asset('img/'.$application->visa_photo)}}" style="width:90%; height:200px;">
                                    @endif
                                    @endif
                                  </a>
                            </div>
                            <div class="col-md-4 py-2  my-3 col-sm-12 px-2">
                                <label for="username" class="form-label">إقامته او شهادة الميلاد أو جواز السفر /إذا كان المريض طفلا  </label>
                                 <a href="#" class="pop">
                                @if($application->other != NULL)

                                @if(pathinfo($application->other)
                                 ['extension']=='pdf')

                                      <embed type="application/pdf" src="{{asset('img/'.$application->other)}}" width="100%" height="300px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
                                    @else
                                    <img src="{{asset('img/'.$application->other)}}" style="width:90%; height:200px;">
                                    @endif
                                    @endif
                                  </a>
                            </div>


                        </div>


                    </div>

                </div>
                </div>
                <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="text-center">

                        <div class="">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route('application.index')}}" class="btn btn-secondary">الغاء</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <img src="" class="imagepreview" style="width: 100%;" >
                </div>
              </div>
            </div>
          </div>
        <!--end::Form-->
    </div>
        </div>
        @endsection

        @section('scripts')

        <script>
            $(function() {
                $('.pop').on('click', function() {
                    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                    $('#imagemodal').modal('show');
                });
        });
        </script>
        @endsection
