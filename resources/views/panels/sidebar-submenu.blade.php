{{-- vertical-box-menu --}}
@if($configData['mainLayoutType'] == 'vertical-menu-boxicons')
<ul class="menu-content">
  @if (isset($menu))
    @foreach ($menu as $submenu)
      <li {{ $submenu->slug === Route::currentRouteName() ? 'class=active' : '' }}>
        <a href="@isset($submenu->url) {{asset($submenu->url)}} @endisset" class="d-flex align-items-center" @if(isset($submenu->newTab)){{"target=_blank"}}@endif>
          <i class="bx bx-chevron-right"></i>
        <span class="menu-item text-truncate">{{$submenu->name}}</span>
        </a>
        @if(isset($submenu->submenu))
          @include('panels.sidebar-submenu',['menu'=>$submenu->submenu])
        @endif
      </li>
    @endforeach
  @endif
</ul>
@endif
