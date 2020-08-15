<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{asset('/adminLTE/dist/img/stack.jpg')}}"
           alt=""
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> Kita Stack</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/adminLTE/dist/img/ninja.png')}}" class=" " alt="User Image">
        </div>
        <div class="info">

          <!-- ini pakai eloquent relationship one to one -->

          <a href="#" class="d-block">{{Auth::User()->name}}</a>
          <!-- reputasi di taruh disini kan ?  -->

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/pertanyaans" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Forum Pertanyaan </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/erd" class="nav-link">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>Final Project's ERD</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p> Profile </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-lock nav-icon"></i>
                  <p> Password </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/../" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>