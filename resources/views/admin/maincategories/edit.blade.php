@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">  تعديل قسم  -> {{$maincategory->name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
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

                                    <form class="form"
                                        action="{{route('maincategories.update',$maincategory->id)}}" 
                                              method="POST"
                                              enctype="multipart/form-data">
                                              {{csrf_field()}}
                                            {{method_field('put')}}

                                            
                                                 <div class="form-group">
                                                      <label>@lang('site.image')</label>
                                                      <input class="form-control image" name="image" type="file">
                                                  </div>

                                                  <div class="form-group">
                                                    <img src="{{$maincategory->image_path}}"  style="width: 100px" class="img-thumbnail image-preview" alt="صوره القسم">
                                                    </div>
                                                    



                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <h4 class="form-section"><i class="ft-home"></i> بيانات القسم - {{__('site.'.$maincategory -> translation_lang)}}</h4>

                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم القسم
                                                                - {{__('site.'.$maincategory -> translation_lang)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$maincategory -> name}}"
                                                                   name="category[0][name]" required>
                                                       
                                                        </div>
                                                        
                                                

                                                    <div class="col-md-6 hidden">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار
                                                                اللغة {{__('site.'.$maincategory -> translation_lang)}} </label>
                                                            <input type="text" id="abbr"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$maincategory -> translation_lang}}"
                                                                   name="category[0][abbr]">
                                                        </div>
                                                    </div><!-- end of col-md-6 hidden-->
                                                    

                                              
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="category[0][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($maincategory -> active == 1)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة {{__('site.'.$maincategory -> translation_lang)}} </label>

                                                        </div>
                                                    
                                              


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="fas fa-minus-square"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </button>
                                            </div>  <!-- end of form-actions -->
                                </form>  <!-- end of form -->
                               
                                   
                                        <ul class="nav nav-tabs">
                                            @isset($maincategory -> categories)
                                                @foreach($maincategory -> categories   as $index =>  $translation)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($index ==  0) active @endif " id="homeLable-tab"  data-toggle="tab"
                                                           href="#homeLable{{$index}}" aria-controls="homeLable"
                                                            aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                            {{__('site.'.$translation -> translation_lang)}}</a>
                                                    </li>    <!-- end of li nav-item-->
                                                @endforeach
                                            @endisset
                                        </ul>  <!-- end of ul nav nav-tabs -->

                                        <div class="tab-content px-1 pt-1">

                                            @isset($maincategory -> categories)
                                                @foreach($maincategory -> categories   as $index =>  $translation)

                                                <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif  " id="homeLable{{$index}}"
                                                 aria-labelledby="homeLable-tab"
                                                 aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">


                                            <form class="form"
                                                        action="{{route('maincategories.update',$translation->id)}}"
                                                        method="POST"
                                                        enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                    {{method_field('put')}}

                                                        <input name="id" value="{{$translation -> id}}" type="hidden">

                                                        <div class="form-body">

                                                            <h4 class="form-section"><i class="ft-home"></i> بيانات القسم - {{__('site.'.$translation -> translation_lang)}}</h4>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1"> اسم القسم
                                                                            - {{__('site.'.$translation -> translation_lang)}} </label>
                                                                        <input type="text" id="name"
                                                                            class="form-control"
                                                                            placeholder="  "
                                                                            value="{{$translation -> name}}"
                                                                            name="category[0][name]" required>
                                                                    
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1"> أختصار
                                                                            اللغة {{__('site.'.$translation -> translation_lang)}} </label>
                                                                        <input type="text" id="abbr"
                                                                            class="form-control"
                                                                            placeholder="  "
                                                                            value="{{$translation -> translation_lang}}"
                                                                            name="category[0][abbr]">
                                                                    </div>
                                                                </div>   <!-- end of col-md-6 hidden -->
                                                            


                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mt-1">
                                                                        <input type="checkbox" value="1"
                                                                            name="category[0][active]"
                                                                            id="switcheryColor4"
                                                                            class="switchery" data-color="success"
                                                                            @if($translation -> active == 1)checked @endif/>
                                                                        <label for="switcheryColor4"
                                                                            class="card-title ml-1">الحالة {{__('site.'.$translation -> translation_lang)}} </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="fas fa-minus-square"></i> تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i> تعديل
                                                    </button>
                                                </div> <!-- enf of form-actions -->
                                                </div>

                                            </form>    <!-- end of form -->
                                     
                                               @endforeach
                                            @endisset
                                        </div>
                                 
                                        <!-- end of ab-content px-1 pt-1"-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>    <!-- // Basic form layout section end -->
            
            </div>
        </div>
    </div>

@endsection
