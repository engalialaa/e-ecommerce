@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                
                <h3 class="content-header-title"> المشرفين </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admins.index')}}"> المشرفين </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة مشرف
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة مشرف </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                             
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                    @include('partials._errors')

                                        <form class="form" action="{{route('admins.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            
                                      {{csrf_field()}}
                                    {{method_field('post')}}

                                    <div class="form-body">
                                     <h4 class="form-section"><i class="ft-home"></i> بيانات  المشرفين </h4>
                                      <div class="row">

                                         <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="projectinput1">الاسم الاول</label>
                                               <input type="text" value="{{old('first_name')}}" id="first_name" class="form-control" placeholder="الاسم الاول" name="first_name" required>                                               
                                                </div>
                                                </div>

                                                
                                         <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="projectinput1">الاسم الاخير</label>
                                               <input type="text" value="{{old('last_name')}}" id="last_name" class="form-control" placeholder="الاسم الاخير" name="last_name" required>                                               
                                                </div>
                                                </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
    
                                                            <label for="projectinput1">البريد الاكترونى</label>
                                                            <input type="email" value="{{old('email')}}" id="email"
                                                                   class="form-control"
                                                                   placeholder="ادخل  البريد الالكترونى  "
                                                                   name="email" required>
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                                            
                                                  <div class="form-group">
                                                      <label>@lang('site.image')</label>
                                                      <input class="form-control image" name="image" type="file" required>
                                                  </div>

                                                                            
                                                  <div class="form-group">
                                                    <img src="{{ asset('uploads/admins_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                                                </div>



                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <div class="form-group">
            
                                                    <label for="projectinput1">كلمه المرور</label>
                                                    <input type="password" value="{{old('password')}}" id="password"
                                                          class="form-control"
                                                          placeholder="ادخل  كلمه المرور  "
                                                          name="password" required>
                                                  
                                                    </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <div class="form-group">
          
                                                    <label for="projectinput1"> تاكيد كلمه المرور </label>
                                                    <input type="password" value="{{old('password_confirmation')}}" id="password"
                                                          class="form-control"
                                                          placeholder="ادخل تاكيد كلمه المرور "
                                                          name="password_confirmation" required>
                                                  
                                                </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                      <label style="margin-bottom: 15px;">@lang('site.permissions')</label>

                                    @php

                                        $models = ['admins','maincategories','vendors','languages'];
                                        $crud   = ['create','read','update','delete']

                                    @endphp

                             <div class="box">
                            <div class="box d-flex p-0">
                              <ul class="nav nav-tabs active" style=" margin-left: 71%;">
                              @foreach($models as $index => $model)
                              <li class="nav-item"><a class="nav-link {{$index == 0 ? 'active' : '' }}" href="#{{$model}}" data-toggle="tab"> @lang('site.' .$model)</a></li>
                              @endforeach
                              </ul>
                            

                            </div><!-- /.card-header -->  
                            <div class="card-body">
                              <div class="tab-content">

                                @foreach($models as $index => $model)

                                <div class="tab-pane {{$index == 0 ? 'active' : '' }}" id="{{$model}}">

                                @foreach($crud as $prem)

                                <input  name="permissions[]" type="checkbox"  value="{{$model. '_' .$prem  }}"> <label style="margin-left: 10px;"> @lang('site.' .$prem) </label>
                                @endforeach                           
                                </div>
                                @endforeach
                          
                              </div>
                              <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                          </div>


                                      </div>


                                      <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="fas fa-minus-square"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-plus-square"></i> حفظ
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
