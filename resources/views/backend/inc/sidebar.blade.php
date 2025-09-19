<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i> {{-- Ana səhifə üçün uyğun ikon --}}
                        <span key="t-dashboards">Ana səhifə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.banner.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Banner</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.banner-details.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Banner Details</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.portfolios.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Portfolios</span>
                            </a>
                        </li>


                         <li>
                            <a href="{{route('admin.mobil_programs.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Mobil Programs</span>
                            </a>
                        </li>

                         <li>
                            <a href="{{route('admin.company_abouts.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Company About</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{route('admin.work_flows.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Work Flow</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.partners.index')}}" class="waves-effect">
                                <i class="bx bx-group"></i> 
                                <span key="t-chat">Partners</span>
                            </a>
                        </li>


                        
                       

                       


                    </ul>
                </li>

                <ul class="metismenu list-unstyled" id="side-menu">
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-home-circle"></i> {{-- Ana səhifə üçün uyğun ikon --}}
                            <span key="t-dashboards">Xidmətlər</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">


                            <li>
                                <a href="{{ route('admin.service-category.index') }}" class="waves-effect">
                                    <i class="bx bx-group"></i>
                                    <span key="t-chat">Kategoriyalar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>






                <li>
                    <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                        <i class="bx bx-slider-alt"></i> {{-- Sayt parametrləri üçün uyğun ikon --}}
                        <span key="t-chat">Sayt Parametrləri</span>
                    </a>
                </li>

            </ul>



        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->