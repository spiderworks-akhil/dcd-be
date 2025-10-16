@extends('admin._layouts.default')
@section('content')
<!-- Top Bar Start -->
            <div class="topbar">
                <!-- Navbar -->
                <nav class="navbar-custom">
                    @include('admin._partials.profile_menu')

                    <ul class="list-unstyled topbar-nav mb-0">
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li>
                        <!-- <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="#" role="button"><i class="fas fa-plus mr-2"></i>New Task</a>
                            </div>
                        </li> -->
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content dashboard-home">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Dashboard</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Admin</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="row">


                    <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #e5f1fd;">
                                <div class="card-header">
                                    Total Number of Pages 
                                </div>
                                <div class="card-body" >
                                     <h4>99</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #e5def0;">
                                <div class="card-header">
                                   News Published (English)
                                </div>
                                <div class="card-body" >
                                     <h4>150</h4>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #d6edd9;">
                                <div class="card-header">
                                  News Published (Arabic)
                                </div>
                                <div class="card-body" >
                                     <h4>150</h4>
                                </div>
                            </div>
                        </div>

                          <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #f6f0d8;">
                                <div class="card-header">
                                  Blogs Published (English)
                                </div>
                                <div class="card-body" >
                                     <h4>105</h4>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #ffe0cb;">
                                <div class="card-header">
                                  Blogs Published (Arabic)
                                </div>
                                <div class="card-body" >
                                     <h4>105</h4>
                                </div>
                            </div>
                        </div>


                            <div class="col-md-4">
                            <div class="card dashboard_list" style="background: #eceff6;">
                                <div class="card-header">
                                  Events Published 
                                </div>
                                <div class="card-body" >
                                     <h4>52</h4>
                                </div>
                            </div>
                        </div>



                             <div class="col-md-6" style=" margin-bottom:50px;">
                            <div class="card dashboard_news  " style="height:100%;  " >
                                <div class="card-header">
                                 Recent News published (English) 
                                </div>
                                <div class="card-body" >


                                      <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="mr-3"/>
                                        <div>
                                            <h4>Sheikha Latifa honours winners of Holy Quran competition, praises qualitative shift witnessed at event</h4>
                                            <p>April 27, 2025 SOCIO-CULTURE</p>
                                        </div> 
                                      </div>
                                      <hr/>

                                       <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="mr-3"/>
                                        <div>
                                            <h4>  UAE finish with 21 medals in Fazza Para Athletics GP 2025 </h4>
                                            <p>April 27, 2025 SOCIO-CULTURE</p>
                                        </div> 
                                      </div>

                                      <hr/>


                                       <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="mr-3"/>
                                        <div>
                                            <h4>  2025 Fazza International C’ships: Strategic partner and sponsors announced </h4>
                                            <p>April 27, 2025 SOCIO-CULTURE</p>
                                        </div> 
                                      </div>
                                </div>
                            </div>
                        </div>


                          <div class="col-md-6" style=" margin-bottom:50px;" >
                            <div class="card dashboard_news dashboard_news_arabic  " style="height:100%; " >
                                <div class="card-header">
                                 آخر الأخبار المنشورة
                                </div>
                                <div class="card-body" >


                                      <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="ml-3"/>
                                        <div>
                                            <h4>  نادي دبي لأصحاب الهمم» يكرّم أبطال مهرجانه الرمضاني</h4>
                                            <p>٧ أبريل الثقافة الاجتماعية ٢٠٢٥</p>
                                        </div> 
                                      </div>
                                      <hr/>

                                       <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="ml-3"/>
                                      <div>
                                            <h4>  نادي دبي لأصحاب الهمم» يكرّم أبطال مهرجانه الرمضاني</h4>
                                            <p>٧ أبريل الثقافة الاجتماعية ٢٠٢٥</p>
                                        </div> 
                                      </div>

                                      <hr/>


                                       <div class="dashboard_news_list flex items-center"> 
                                        <img src="{{asset('admin/assets/images/logbg.png')}}" class="ml-3"/>
                                       <div>
                                            <h4>  نادي دبي لأصحاب الهمم» يكرّم أبطال مهرجانه الرمضاني</h4>
                                            <p>٧ أبريل الثقافة الاجتماعية ٢٠٢٥</p>
                                        </div> 
                                      </div>
                                </div>
                            </div>
                        </div>



                        


 


                         

                        <!-- <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Header 
                                </div>
                                <div class="card-body" >
                                    <div class="form-group  ">
                                        <a href="{{route('admin.static-pages.edit',[encrypt(42)])}}"  target="_blank"> view </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card flex justify-between">
                                <div class="card-header">
                                    Footer
                                </div>
                                <div class="card-body">
                                    <div class="form-group  ">
                                        <a href="{{route('admin.static-pages.edit',[encrypt(43)])}}"  target="_blank"> view </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>

                </div><!-- container -->

                @include('admin._partials.footer')
            </div>
            <!-- end page content -->
@endsection
