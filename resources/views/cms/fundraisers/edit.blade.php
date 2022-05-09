@extends('cms.parent')

@section('title','Temp')
@section('page-lg','Temp')
@section('main-pg-md','CMS')
@section('page-md','Temp')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.create_fundraisers')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- enctype="multipart/form-data" --}}
                    <form id="create-form">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">{{__('cms.title')}}</label>
                                <input type="text" value="{{$fundRaiser->title}}" class="form-control" id="title" placeholder="{{__('cms.title')}}">
                            </div>
                            <div class="form-group">
                                <label for="intro">{{__('cms.intro')}}</label>
                                <input type="text" value="{{$fundRaiser->intro}}" class="form-control" id="intro" placeholder="{{__('cms.intro')}}">
                            </div>
                            <div class="form-group">
                                <label for="desc">{{__('cms.desc')}}</label>
                                <textarea  class="form-control" id="desc">{{$fundRaiser->desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('cms.price')}}</label>
                                <input type="text" value="{{$fundRaiser->price}}" class="form-control" id="price" placeholder="{{__('cms.price')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div> --}}
                                </div>
                                <img height="100" src="{{asset('img/'.$fundRaiser->image)}}" />
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.type')}}</label>
                                <select class="form-control" id="type">
                                    <option value="public">public</option>
                                    <option value="special">special</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.owner')}}</label>
                                <select class="form-control" id="owner">
                                    <option value="owner">Society's own</option>
                                    <option value="user1">user1</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
    function performStore() {
        // alert('Perform Store - FUNCTION JS');
        // console.log('performStore');
        // var type = $('#type option:selected').val();
        // data.append('type', type);
        // var owner = $('#owner option:selected').val();
        // data.append('owner', owner);
        //application/x-www-form-urlencoded
        var formData = new FormData();
        formData.append('title', document.getElementById('title').value);
        formData.append('intro', document.getElementById('intro').value);
        formData.append('desc', document.getElementById('desc').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('type', document.getElementById('price').value);
        formData.append('owner', document.getElementById('owner').value);
        if(document.getElementById('image').files[0] != undefined) {
            formData.append('image',document.getElementById('image').files[0]);
        }
        formData.append('_method','PUT');
        axios.post('/cms/admin/fundRaiser/{{$fundRaiser->id}}',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection
