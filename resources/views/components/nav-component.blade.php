<nav class="navbar bg-dark">
  <div class="container-fluid justify-content-between align-items-center">
  
    <div class="d-flex gap-3 align-items-center"> 
        <a class="navbar-brand text-white" href="{{ route('users.show', Auth::user()) }}">
          <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" width="50px" height="50px" class="rounded-circle">
        </a>
    </div>

    <div class="page-nav ">
        <ul class="list-unstyled text-light d-flex align-items-center gap-4">
          <li> <a href="{{ route('post.index') }}" class="text-decoration-none text-light"> Posts </a> </li>
          <li><a href="{{ route('category.index') }}" class="text-decoration-none text-light"> Category </a> </li>
          <li> <a href="{{ route('post.trash.index') }}" class="text-decoration-none text-light"> Trashed Posts </a> </li>
          <!-- <li><a href="#" class="text-decoration-none text-light"> Posts </a> </li> -->
        </ul>

    </div>

    <div class="btn-group d-flex gap-4 ">
        <button type="button" class="btn btn-light dropdown-toggle ml-2 border rounded" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li><button class="dropdown-item" type="button"> <a href="{{ route('users.edit', Auth::user()) }}" class="text-decoration-none text-dark">Edit User </a></button></li>
            <li><button class="dropdown-item" type="button"><a href="{{ route('users.logout')}}" class="text-decoration-none text-dark">Log Out </a></button></li>
          </ul>

    </div>
  </div>
</nav>