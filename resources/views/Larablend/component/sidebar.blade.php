<div class="sidebar" data-color="white" data-active-color="info">
    <div class="logo">
        <a href="{{config('app.url')}}" class="simple-text logo-mini">
            TGP
        </a>

        <a href="{{config('app.url')}}" class="simple-text logo-normal">
            {{config('app.name')}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="../assets/img/james.jpg"/>
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#userMenu" class="collapsed">
                    <span>Chet Faker <b class="caret"></b></span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="userMenu">
                    <ul class="nav">
                        <li>
                            <a href="javascript:;">
                                <span class="sidebar-mini-icon">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="sidebar-mini-icon">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="sidebar-mini-icon">S</span>
                                <span class="sidebar-normal">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">

            <li>
                <a data-toggle="collapse" href="#pagesExamples">
                    <i class="nc-icon nc-laptop"></i>
                    <p>Example 2
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li>
                            <a href="../examples/pages/pricing.html">
                                <span class="sidebar-mini-icon">C1</span>
                                <span class="sidebar-normal">Collapse 1</span>
                            </a>
                        </li>
                        <li>
                            <a href="../examples/pages/timeline.html">
                                <span class="sidebar-mini-icon">C2</span>
                                <span class="sidebar-normal">Collapse 2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>

