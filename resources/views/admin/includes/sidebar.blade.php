 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="{{ config('web.icon')??asset('admin/assets/images/faces/face8.jpg') }}" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ auth()->user()->name }}</p>

          </div>
        </a>
      </li>
      <li class="nav-item nav-category">Main Menu</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.home') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::currentRouteName()=='admin.user.index' ||Route::currentRouteName()=='admin.user.create' ||Route::currentRouteName()=='admin.user.edit')?'active':'' }}">
        <a class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-users">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Route::currentRouteName()=='admin.user.index' ||Route::currentRouteName()=='admin.user.create' ||Route::currentRouteName()=='admin.user.edit')?'show':'' }}" id="ui-users">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.user.create') }}">Add User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">All Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.categories') }}">Categories</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (Route::currentRouteName()=='admin.company.index' ||Route::currentRouteName()=='admin.company.create' ||Route::currentRouteName()=='admin.company.edit')?'active':'' }}">
        <a class="nav-link" data-toggle="collapse" href="#ui-companies" aria-expanded="false" aria-controls="ui-companies">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Companies</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Route::currentRouteName()=='admin.company.index' ||Route::currentRouteName()=='admin.company.create' || Route::currentRouteName()=='admin.company.edit')?'show':'' }}" id="ui-companies">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.company.create') }}">Add Company</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.index') }}">All Companies</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.companies.industries') }}">Industries</a>
              </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ (Route::currentRouteName()=='job.index' ||Route::currentRouteName()=='job.create' ||Route::currentRouteName()=='job.edit')?'active':'' }}">
        <a class="nav-link" data-toggle="collapse" href="#ui-jobs" aria-expanded="false" aria-controls="ui-jobs">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Jobs</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Route::currentRouteName()=='admin.company.index' ||Route::currentRouteName()=='admin.company.create' || Route::currentRouteName()=='admin.company.edit')?'show':'' }}" id="ui-jobs">
          <ul class="nav flex-column sub-menu">

              <li class="nav-item">
                <a class="nav-link" href="{{ route('job.index') }}">Jobs</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('job.type.index') }}">Jobs types</a>
              </li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('project.index') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Projects</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('cms.index') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">CMS Pages</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('seo.index') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">SEO Setting</span>
        </a>
      </li>

      <li class="nav-item {{ (Route::currentRouteName()=='setting.general' ||Route::currentRouteName()=='setting.mail')?'active':'' }}">
        <a class="nav-link" data-toggle="collapse" href="#ui-setting" aria-expanded="false" aria-controls="ui-setting">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Setting</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Route::currentRouteName()=='setting.general' || Route::currentRouteName()=='setting.mail')?'show':'' }}" id="ui-setting">
          <ul class="nav flex-column sub-menu">

              <li class="nav-item">
                <a class="nav-link" href="{{ route('setting.general') }}">General Setting</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('setting.mail') }}">Mail Configuration</a>
              </li>
          </ul>
        </div>
      </li>

    </ul>
  </nav>
  <!-- partial -->
