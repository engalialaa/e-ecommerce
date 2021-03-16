@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">الاقسام الرئيسية</h3>
            
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('maincategories.index')}}"> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة قسم رئيسي
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
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
                                        <form class="form" action="{{route('maincategories.store')}}"  method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    {{method_field('post')}}

                                        <div class="form-body">

                                                <div class="form-group">
                                                      <label>الصوره</label>
                                                      <input class="form-control image" name="image" type="file" required>
                                                     </div>
                                                                   
                                                     <div class="form-group">
                                                    <img src="{{ asset('uploads/category_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                                                     </div>
                                                     <div class="row">
                                            @if( get_language()->count()> 0 )
                                                @foreach( get_language() as $index => $lang)
                                        
                                                <div class="col-md-6"> 
                                                 <h4 class="form-section"><i class="ft-home"></i> بيانات القسم @lang('site.'.$lang->abbr)</h4>

                                                        <div class="form-group">
                                                            <label for="projectinput1">اسم القسم @lang('site.'.$lang->abbr)</label>
                                                             <input type="text" value="" id="name" class="form-control" placeholder="" name="category[{{$index}}][name]">    
                                                                </div>
                                                     

                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار اللغة @lang('site.'.$lang->abbr)</label>
                                                             <input type="text" id="abbr" class="form-control"  placeholder="" value="" name="category[{{$index}}][abbr]">
                                                             </div>

                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="1" name="category[{{$index}}][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة @lang('site.'.$lang->abbr) </label>
                                                        </div>
                                                </div><!--  end of col-md-6 -->
                                        
                                            @endforeach
                                          @endif
                                    </div> <!--  end of row -->  


                                        </div><!-- end of form body -->


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
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
