  
<!--   include header section from header -->
  @include('components.header')

<!-- include banner -->
  @yield('banner')

 


<main role="main" class="container">
  <div class="row">
   @yield('content')


    


   @yield('sidebar')


  </div><!-- /.row -->

</main><!-- /.container -->

 @include('components.footer')
