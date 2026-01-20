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
    <div class="col-md-4">
        <h4>{{$profile->first_name}} {{$profile->last_name}} </h4>
        {{ucfirst($profile->user->getRole())}} Profile
    </div>
    <div class="col-md-7">
        <div class="btn-grsoup profile-buttons  d-lg-inline-flex justify-content-end" role="group" aria-label="Basic example">
            <a href="{{route('admin.viewUser',['UserType'=>'investor',$profile->id,'view'=>'profile'])}}"
               class="btn btn-dark btn-md">Profile</a>
            <a href="{{route('admin.viewUser',['UserType'=>'investor',$profile->id,'view'=>'account',])}}" class="btn btn-dark btn-md">Account</a>
            <a href="{{route('admin.viewUser',['UserType'=>'investor',$profile->id,'view'=>'investments',])}}" class="btn btn-dark btn-md">Investments</a>
            <a href="{{route('admin.viewUser',['UserType'=>'investor',$profile->id,'view'=>'activity',])}}" class="btn btn-dark btn-md">Activity</a>
        </div>
    </div>
</div>

</div>
 -->