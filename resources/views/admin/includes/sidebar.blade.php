<div class="main-menu menu-fixed menu-light menu-accordion   menu-shadow " data-scroll-to-active="true">

    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

              <!-- الرئيسية -->
            <li class="nav-item">

              <a href=""><i class="la la-mouse-pointer"></i>

               <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span>

              </a>

            </li><!--end of li nav-item   --> 



            @if(auth()->user()->haspermission('maincategories_read'))
              <!-- الاقسام الرثيسيه  -->
             <li class="nav-item">
                    <a href="{{route('maincategories.index')}}"><i class="la la-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> الاقسام الرئيسية </span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{App\ModelsAdmin\MainCategories::count()}}</span>
                    </a>
             </li><!--end of li nav-item   --> 
             @endif

             @if(auth()->user()->haspermission('languages_read'))
              <!-- لغات الموقع -->
            <li class="nav-item">

                <a href="{{route('languages.index')}}"><i class="la la-home"></i>

                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{App\ModelsAdmin\Language::count()}}</span>
               </a>
               
            </li><!--end of li nav-item   -->
            @endif


            @if(auth()->user()->haspermission('admins_read'))
              <!-- المشرفين -->
              <li class="nav-item">
          <a href="{{route('admins.index')}}"><i class="la la-home"></i>
              <span class="menu-title" data-i18n="nav.dash.main">المشرفين</span>
              <span class="badge badge badge-info badge-pill float-right mr-2">{{App\ModelsAdmin\Admin::count()}}</span>
          </a>
          </li><!--end of li nav-item   --> 
          @endif

        </ul><!--end of ul navigation --> 

    </div><!--end of content --> 

 </div><!--end of main-menu --> 
