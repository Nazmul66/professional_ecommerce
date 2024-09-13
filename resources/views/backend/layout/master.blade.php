 
 @include('backend.include.css')


  <body> 
    <!-- Others Include-->
    @include('backend.include.others')


    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <!-- Header Includes -->
        @include("backend.include.header")

      </div>

      <!-- Page Body Start-->
      <div class="page-body-wrapper">

        <!-- Sidebar Includes-->
        @include('backend.include.sidebar')

        <div class="page-body">
          
            <!-- Main Body Content Here-->
            @yield('body-content')

        </div>

        <!-- Footer Includes-->
        @include("backend.include.footer") 

      </div>
    </div>
    
    <!-- Javascript Includes -->
    @include('backend.include.script')

  </body>
</html>