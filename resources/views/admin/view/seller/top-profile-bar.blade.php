<!-- <?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 17:16
 */
?>

<div class="profile__content">

<div class="row row-spacer top-profile-bar">
    <div class="col-12 col-md-3">
        <h4>{{$profile->first_name}} {{$profile->last_name}} </h4>
        {{ucfirst($profile->user->getRole())}} Profile
    </div>
    <div class="col-12 col-md-9">
        <div class="btn-group profile-buttons   d-fslex justify-scontent-end" role="group" aria-label="Basic example">
            <a href="{{route('admin.viewUser',['UserType'=>'seller',$profile->id,'view'=>'profile'])}}" class="btn btn-dark btn-md">
                <i class="zmdi zmdi-face"></i>
                <span class="d-none d-lg-inline">Profile</span>
            </a>
            <a href="{{route('admin.viewUser',['UserType'=>'seller',$profile->id,'view'=>'account',])}}" class="btn btn-dark btn-md">
                <i class="zmdi zmdi-account"></i>
                <span class="d-none d-lg-inline">Account</span>
            </a>
            <a href="{{route('admin.viewUser',['UserType'=>'seller',$profile->id,'view'=>'auctions',])}}" class="btn btn-dark btn-md">
                <i class="zmdi zmdi-view-list"></i>
                <span class="d-none d-lg-inline">Auctions</span>
            </a>
            <a href="{{route('admin.viewUser',['UserType'=>'seller',$profile->id,'view'=>'buyers',])}}" class="btn btn-dark btn-md">
                <i class="zmdi zmdi-accounts-list-alt"></i>
                <span class="d-none d-lg-inline">Buyers</span>
            </a>
            <a href="{{route('admin.viewUser',['UserType'=>'seller',$profile->id,'view'=>'activity',])}}" class="btn btn-dark btn-md">
                <i class="zmdi zmdi-format-list-numbered"></i>
                <span class="d-none d-lg-inline">Activity</span>
            </a>
        </div>
    </div>
</div>

</div>
 -->