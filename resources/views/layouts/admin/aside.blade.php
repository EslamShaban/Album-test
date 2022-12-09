    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path}}" style="width:50px;height:50px">
        <div>
          <p class="app-sidebar__user-name">{{ auth()->user()->name}}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{ route('index') }}"><i class="app-menu__icon fal fa-home fa-lg"></i><span class="app-menu__label">{{ __('admin.dashboard') }}</span></a></li>

        <li class="treeview">
          <a class="app-menu__item" href="{{ route('albums.index') }}">
            <i class="app-menu__icon fas fa-users fa-lg"></i>
            <span class="app-menu__label">Albums</span>
          </a>
        </li>

      </ul>
    </aside>
