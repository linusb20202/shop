<div class="dashboard-menu sticky">
    <div class="navbar navbar-default">
        <nav class="navbar navbar-me">
            <div class="container">
                <div class="nevicatio-menu">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo e(URL::to('users/dashboard')); ?>">Dashboard</a></li>
                            <li class="dropdown">
                                <a href="<?php echo e(URL::to('services/management')); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Selling <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('gigs/management')); ?>">Manage Gigs</a></li>
                                    <li><a href="<?php echo e(URL::to('gigs/create')); ?>">Create New Gig</a></li>
                                    <li><a href="<?php echo e(URL::to('gigs/myofferedgig')); ?>">My Offered Gigs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="<?php echo e(URL::to('services/management')); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Buying <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('services/management')); ?>">Manage Requests</a></li>
                                    <li><a href="<?php echo e(URL::to('services/create-request')); ?>">Post Request</a></li>
                                    <li><a href="<?php echo e(URL::to('my-saved-gigs')); ?>">My Saved Gigs</a></li>
                                    <li><a href="<?php echo e(URL::to('gigs/offeredgig')); ?>">Offered Gigs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="<?php echo e(URL::to('buyer-requests')); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Buyer Requests <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('buyer-requests')); ?>">Active Requests</a></li>
                                    <li><a href="<?php echo e(URL::to('services/offers-sent')); ?>">Offers Sent</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="<?php echo e(URL::to('selling-orders')); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Orders <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('selling-orders')); ?>">Selling Orders</a></li>
                                    <li><a href="<?php echo e(URL::to('buying-orders')); ?>">Buying Orders</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="<?php echo e(URL::to('earnings')); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Earnings <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('earnings')); ?>">Earnings</a></li>
                                    <li><a href="<?php echo e(URL::to('payments/history')); ?>">PayPal History</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Contacts <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(URL::to('buyer-contacts')); ?>">Buyer Contacts</a></li>
                                    <li><a href="<?php echo e(URL::to('seller-contacts')); ?>">Seller Contacts</a></li>
                                </ul>
                            </li>
                            </li>
                            <li><a href="<?php echo e(URL::to( 'users/notifications')); ?>">Notifications</a></li>
                            <li><a href="<?php echo e(URL::to( 'users/settings')); ?>">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
                                            $(window).scroll(function () {
                                                if ($(this).scrollTop() > 5) {
                                                    $(".navbar-me").addClass("fixed-me");
                                                } else {
                                                    $(".navbar-me").removeClass("fixed-me");
                                                }
                                            });
        </script><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/elements/topmenu.blade.php ENDPATH**/ ?>