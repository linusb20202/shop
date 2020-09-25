<style>
   #nav ul li:nth-child(n+5) ul {    
    left: auto;
    right: 0;
    
}
.try{
    background-color:white;
}
.try {
  transition-duration: 0.4s;
}

.try:hover {
  background-color: grey; /* Green */
  color: black;
}
</style>
<div class="dashboard-menu sticky">
    <div class="navbar navbar-default">
        <nav class="navbar navbar-me">
            <div class="container">
                <div class="nevicatio-menu nevicatio-menu-categoris">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="nav">
                        <ul class="nav navbar-nav" >
                             @if($globalCategories)
                            @foreach($globalCategories as $cat)
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a>
                                @if(isset($globalSubCategories[$cat->id]))
                                
                                 <ul class="dropdown-menu dropdown-menus dropdown-menu-categories" style="width:480px;">
                                    @foreach($globalSubCategories[$cat->id] as $subCat)
                                   
                                    <div class="col-sm-6 text-left" style="margin-top:15px;">
                                         <button clas="try" style="width:100%; border:none; background-color:white; text-align:left; " >
                                        <li >
                                            
                                            <a  href="{{URL::to( 'gigs/'.$cat->slug.'/'.$subCat->slug)}}" style="color:#777;" >
                                                {!! $subCat->name !!} 
                                            </a>
                                            
                                        </li>  
                                        </button>
                                    </div>  
                                    
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @if($loop->iteration == 8)
                                @break
                            @endif
                            @endforeach 
                            <?php /*<li class="dropdown">
                                <a href="javascript:void(0)"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menus">
                                    @foreach($globalCategories as $cat)
                                    @if($loop->iteration > 8)
                                        <li class="dropdown-submenu"><a href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a>
                                            @if(isset($globalSubCategories[$cat->id]))
                                                <ul class="dropdown-menu">
                                                    @foreach($globalSubCategories[$cat->id] as $subCat)                                
                                                        <li><a href="{{URL::to( 'gigs/'.$cat->slug.'/'.$subCat->slug)}}">{!! $subCat->name !!}</a>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                    @endforeach 
                                </ul>
                            </li> */?>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
                function () {
                    $('.dropdown-menus', this).not('.in .dropdown-menus').stop(true, true).slideDown("400");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menus', this).not('.in .dropdown-menus').stop(true, true).slideUp("400");
                    $(this).toggleClass('open');
                }
        );
    });</script>