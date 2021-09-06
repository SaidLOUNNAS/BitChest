
{{-- only admin --}}
@if (Auth::user()->status == 'admin')
<nav  id="sidebar" class="hidden position-fixed d-flex flex-column justify-content-between p-3">
    <div id="toggleNav" class="justify-content-center align-items-center">
        <i class="fas fa-lg fa-bars"></i>
    </div>
    <div >
        <a href="{{ route('home') }}">
            <div class="d-flex justify-content-center align-items-center flex-wrap border-bottom ">
                <span class="ml-2" id="logo">BitChest-Tools</span>
            </div>
        </a>
        <ul class="my-5 p-0">
            <a href="{{ route('currencies.index') }}">
                <li class="sidebar-item d-flex align-items-center mb-2 @if($section == 'currencies') active @endif">
                    <i class="fab fa-lg fa-bitcoin"></i>
                    <span class="text-capitalize ml-2">Market trades</span>
                </li>
            </a>
                <a href="{{ route('users.index') }}">
                    <li class="sidebar-item d-flex align-items-center mb-2 @if($section == 'users') active @endif">
                        <i class="fas fa-lg fa-users"></i>
                        <span class="text-capitalize ml-2">Users</span>
                    </li>
                </a>
            <a href="{{ route('account.edit') }}">
                <li class="sidebar-item d-flex align-items-center mb-2 @if($section == 'account') active @endif">
                    <i class="fas fa-lg fa-user-circle"></i>
                    <span class="text-capitalize ml-2">Profile</span>
                </li>
            </a>
        </ul>
    </div>

</nav>
    <div id="wrapper">
        <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div style="margin-left: 240px">
          <!-- Topbar -->
          <nav style="background-color: rgb(234, 239, 240) " class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <h2 id="logo">Dashboard</h2>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item no-arrow active">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" role="button"
                data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i><strong>Logout</strong>
                </a>
              </li>
            </ul>
          </nav>
          <!-- model of logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                  <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                  <a href="{{ route('logout') }}" class="btn btn-primary btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sidebar-item d-flex align-items-center">
                        Logout
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
{{-- only customer --}}
@elseif (Auth::user()->status == 'client')
</nav>
<div id="wrapper">
    <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content style="margin-left: 10px" -->
    <div >
      <!-- Topbar -->
      <nav style="background-color: rgb(234, 239, 240) " class="navbar navbar-expand navbar-light bg-black topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <h2 id="logo">BitChest</h2>
<ul  class="navbar-nav ml-auto">

<li  class="nav-item active" @if($section == 'currencies') active @endif">
    <a class="nav-link" href="{{ route('currencies.index') }}">Dashboard</a>
  </li>

<li class="nav-item active" @if($section == 'wallet') active @endif">
    <a class="nav-link" href="{{ route('wallet') }}">Wallet</a>
  </li>

<li class="nav-item active" @if($section == 'transactions') active @endif">
    <a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a>
  </li>

<li style="margin-right: 120px;" class="nav-item active" @if($section == 'wallet') active @endif">
    <a class="nav-link" style="font-weight: bold ;" href="#">Balance :
        <span id="balance">{{ session('balance') }} {{ config('currency')['symbol'] }}</span>
    </a>
</li>

<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('account.edit') }}" @if($section == 'account') active @endif>
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>
     </li>
    </ul>
      </nav>
      <style>#mainContainer #content{
          margin: 10rem;
      }</style>
      <!-- model of logout -->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
              <a href="{{ route('logout') }}" class="btn btn-primary btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="sidebar-item d-flex align-items-center">
                    Logout
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
