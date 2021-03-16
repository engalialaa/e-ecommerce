@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الاقسام الرئيسية
                                </li>
                            </ol>
                        </div>
                    </div>

                    <br>
                <form action="" method="get" >
                <div class="row">
                <div class="col-md-8">
                    <input class="form-control" name="search" type="text" placeholder="@lang('site.Search')" aria-label="Search" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">@lang('site.Search')<i class="fas fa-search"></i></button>
                    
                    @if(auth()->user()->haspermission('maincategories_create'))     
                    <a href="{{route('maincategories.create')}}" class='btn btn-primary'>@lang('site.add')<i class="fas fa-plus"></i></a>
                    @else
                    <a href="#" class='btn btn-info'>@lang('site.add')<i class="fas fa-plus disabled"></i></a>
                    @endif
                    </div>
                </div>
                </form>

                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الاقسام الرئيسية </h4>
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
                                    <div class="card-body card-dashboard">
                                    @if($maincategories->count() > 0 )
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>القسم </th>
                                                <th> اللغة</th>
                                                 <th>الحالة</th>
                                                 <th>صوره القسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($maincategories as $category)
                                                    <tr>
                                                        <td>{{$category -> name}}</td>
                                                        <td>{{get_default_lang()}}</td>
                                                        <td>{{$category -> getActive()}}</td>
                                                        <td><img src="{{$category-> image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>                                                

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href=""
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href=""
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>


                                                                <a href=""
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    @if($category -> active == 0)
                                                                        تفعيل
                                                                        @else
                                                                        الغاء تفعيل
                                                                    @endif
                                                                </a>


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        

                                            </tbody>
                                        </table>
                               
                                   
                                   @else
                                  <h2>@lang('site.no_deta_found')</h2>
                                  @endif
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
