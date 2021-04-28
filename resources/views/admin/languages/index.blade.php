@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    <h3 class="content-header-title"> اللغات <small>{{$languages->total()}}</small> </h3>

                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> اللغات
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
                    
                    @if(auth()->user()->haspermission('languages_create'))     
                    <a href="{{route('languages.create')}}" class='btn btn-primary'>@lang('site.add')<i class="fas fa-plus"></i></a>
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
                                    <h4 class="card-title">جميع لغات الموقع </h4>
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
                        
                                    @if($languages->count() > 0 )

                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th> الاسم</th>
                                                <th>الاختصار</th>
                                                <th>اتجاه</th>
                                                <th>الحالة</th>
                                                <th>أكشن</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($languages as $language)
                                                    <tr>
                                                        <td>{{$language -> name}}</td>
                                                        <td>{{$language -> abbr}}</td>
                                                        <td>{{$language -> direction}}</td>
                                                        <td>{{$language -> getActive()}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                         @if(auth()->user()->haspermission('languages_update'))   
                                                         <a href="{{route('languages.edit',$language->id)}}"
                                                         class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1 btn-sm"><i class="fa fa-edit" ></i> تعديل</a>
                                                        @else
                                                         <a href="#"
                                                         class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1 btn-sm disabled"> <i class="fa fa-edit" ></i> تعديل</a>
                                                        @endif
                                                        
                                                        @if(auth()->user()->haspermission('languages_delete'))   
                                                         <form action="{{route('languages.destroy',$language->id)}}"  method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete')}}
                                                        <button type="submit"  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 delete btn-sm"><i class="fa fa-trash" ></i>@lang('site.delete')</button>
                                                         </form>
                                                         @else
                                                         <button  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 delete btn-sm" disabled><i class="fa fa-trash" ></i>@lang('site.delete')</button>
                                                         @endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$languages->appends(request()->query())->links()}}
                                   
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
