  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">{{ config('app.name', 'Agenda Infantil') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="image">
                        <img style="width:100%;" src="http://127.0.0.1:8000/images/{{ Auth::user()->user_image }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>                  
                        <a href="#" class="d-block">{{ agendaInfantil\Role::find(Auth::user()->rol_id)->rol_nombre }}</a>                                
                    </div>
                </div>
            </div>

           
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  @if( Auth::user()->rol_id == 1 || Auth::user()->rol_id == 4 )
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-school"></i>
                          <p>
                              Centros Escolares
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @if( Auth::user()->rol_id == 4 )
                            <li class="nav-item">
                                <a href="/centros/create" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Crear</p>
                                </a>
                            </li>
                          @endif
                          <li class="nav-item">
                              <a href="/centros" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Listar</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Usuarios
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/usuarios/create" class="nav-link">
                                  <i class="fa fa-plus nav-icon"></i>
                                  <p>Crear</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/usuarios/" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Listar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endif

                  @if( Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2 || Auth::user()->rol_id == 4 )
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-apple-alt"></i>
                          <p>
                              Aulas
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                           @if( Auth::user()->rol_id == 1 || Auth::user()->rol_id == 4)
                          <li class="nav-item">
                              <a href="/aulas/create" class="nav-link">
                                  <i class="fa fa-plus nav-icon"></i>
                                  <p>Crear</p>
                              </a>
                          </li>
                          @endif
                          <li class="nav-item">
                              <a href="/aulas" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Listar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endif

                  @if( Auth::user()->rol_id == 1 || Auth::user()->rol_id == 4)
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-baby"></i>
                          <p>
                              Alumnos
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/ninos/create" class="nav-link">
                                  <i class="fa fa-plus nav-icon"></i>
                                  <p>Crear</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/ninos" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Listar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-utensils"></i>
                          <p>
                              Menús
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/menus/create" class="nav-link">
                                  <i class="fa fa-plus nav-icon"></i>
                                  <p>Crear</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/menus" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Listar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endif
                  @if( Auth::user()->rol_id == 3 )
                                    
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book-open"></i>
                          <p>
                              Tutor
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/tutores" class="nav-link">
                                  <i class="fa fa-list nav-icon"></i>
                                  <p>Alumnos</p>
                              </a>
                          </li>
                         
                      </ul>
                  </li>
                  @endif
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
