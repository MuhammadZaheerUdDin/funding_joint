<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/6/2018
 * Time: 11:19 AM
 */
?>

@extends('layouts.admin.page')
@section('content')


    <h1>
        CONTENT EDITOR
    </h1>

    <hr>
    <form class="forms-sample" action="{{route('websitecontent.update',$id)}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
	    <div class="form-group clearfix fg_text" id="fg_title">

	        <label for="title" class="col-sm-2 control-label required">Title</label>
	        <div class="col-sm-10" id="div_title">
				<input class="form-control form-control" readonly="readonly" type="text" id="title" name="title" value="{{$edit->title}}">
	        </div>
	    </div>

	    

	    @if($edit->type == 1)
		    <div class="form-group clearfix fg_text" id="fg_title">

		        <label for="title" class="col-sm-2 control-label required">Content</label>
		        <div class="col-sm-10" id="div_title">
					<textarea id="editor" name="content">{{$edit->content}}</textarea>
		        </div>
		    </div>
	    @else
	    	<div class="form-group clearfix fg_text" id="fg_title">

		        <label for="title" class="col-sm-2 control-label required">Image</label>
		        <div class="col-sm-10" id="div_title">
					<input type="file" class="form-control" id="image" name="file" accept="image/*" required>
		        </div>
		    </div>
	    	
	    @endif

	    <div class="btn-toolbar" role="toolbar">

            <div class="pull-left">
            	<span class="waves-input-wrapper waves-effect waves-light"><input class="btn btn-primary" type="submit" value="Save"></span>
            </div>
        
        
            </div>
	</form>
    
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script>
    var wysiwygareaAvailable = !!CKEDITOR.plugins.get( 'wysiwygarea' );
    CKEDITOR.replace( 'editor' );
</script>

@endsection
