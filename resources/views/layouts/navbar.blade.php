<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff; margin-bottom:25px;">
    <div class="container-fluid">

    <a href="/"><h2> Lojinha A</h2></a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">


    @guest

    <li class="nav-item">
        <a href="/login" class="nav-link">Login</a>
    </li>
    <li class="nav-item">
        <a href="/register" class="nav-link">Criar Conta</a>
    </li>


    @endguest
    @if(auth()->check())
    
        @if(auth()->check() && auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="/manage_products"> products </a>
            </li>

            <li class="nav-item">
            <a  class="nav-link" href="/create_produtcs">sig up new product</a>
            </li>
            <li class="nav-item">
            <a  class="nav-link" href="/manage_users">user manage</a>
            </li>
            
        @endif

        <li class="nav-item">
            <a href="/carrinho" class="nav-link"> Carrinho </a>
        </li>

        <li class="nav-item">

        <form action="{{url('/logout')}}" method="POST">
            @csrf
            <a href="/logout" class="nav-link" onclick="event.preventDefault();
            this.closest('form').submit();">
                <i class="fa fa-sign-in" style="font-size:22px;" aria-hidden="true"></i>
            </a>
        </form>

        </li>

    @endif

        </ul>
      </div>
    </div>
  </nav>
