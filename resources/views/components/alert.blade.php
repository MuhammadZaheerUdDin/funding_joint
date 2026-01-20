<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 13/11/2018
 * Time: 16:48
 */
?>

<div class="alert alert-{{$type or 'info'}} alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"><i class="zmdi zmdi-close"></i></a>
    {{$content or 'Change this content'}}
</div>
