<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vue-Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
    </head>

    <style>
        
        .mt-10{
            margin-top: 10px;
        }

        .level{
            display: flex;
        }

        .flex{
            flex: 1;
        }

    </style>

    <body>
        <div id="app">
            <template>
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <a class="navbar-brand" href="/">Blogs</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                            <a class="nav-link" href="/article/create">Create an Article <span class="sr-only">(current)</span></a>
                          </li>           
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Article
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/">All articles</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="/articles/popular">Popular articles</a>
                              <a class="dropdown-item" href="/article">Something else here</a>
                            </div>
                          </li>      
                            @if(auth()->check())     
                              <li class="nav-item">
                                <a class="nav-link" href="/profile/{{auth()->user()->name}}">Profile</a>
                              </li> 
                            @endif
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                      </div>
                    </nav>
                </div>
            </template>
            <div class="container">                
                @yield('contents')
                @yield('content')
            </div>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
