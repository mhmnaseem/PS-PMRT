
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar User panel -->
        <div class="user-panel" >
            <div class="pull-left image" style="margin-bottom: 30px;">

            </div>
            <div class="pull-left info">
                <p >{{ Auth::user()->name }}</p>

            </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview">


                    <li class=""><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> DashBoard</a></li>


            </li>
            <li class="treeview">


            <li class=""><a href="{{route('admin.profile')}}"><i class="fa fa-address-card"></i> Profile </a></li>


            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-superpowers"></i> <span>Admins</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{route('admin.index')}}"><i class="fa fa-circle-o"></i> All Admins</a></li>
                    <li class=""><a href="{{route('admin.create')}}"><i class="fa fa-plus"></i> New Admin</a></li>

                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Partners</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{route('partner.index')}}"><i class="fa fa-circle-o"></i> All Partners</a></li>
                    <li class=""><a href="{{route('partner.create')}}"><i class="fa fa-plus"></i> New Partner</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>PM'S</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{route('pms.index')}}"><i class="fa fa-circle-o"></i> All PM'S</a></li>
                    <li class=""><a href="{{route('pms.create')}}"><i class="fa fa-plus"></i> New PM</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Projects</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{route('admin-project-assign.index')}}"><i class="fa fa-circle-o"></i> All Projects</a></li>
                    <li class=""><a href="{{route('admin-project-assign.create')}}"><i class="fa fa-plus"></i> New Project</a></li>

                </ul>
            </li>




            <li class="treeview">


            <li class=""><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>


            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>