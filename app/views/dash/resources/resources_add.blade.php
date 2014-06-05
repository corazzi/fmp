@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Add Resource')

{{-- Page content --}}
@section('content')

<div class="page-header">
	<div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-rocket"></i> @yield('title')</h4>
        </div>
    </div>
</div>


<div class="breadcrumbs"> 
    <a href="{{ route('resources-home') }}">Resources</a>
    <a class="unavailable">Add Resource</a>  
</div>

<div class="inner-content">


	<div class="large-4 large-push-8 columns user-guides">
		<div class="content-box">
			<p>Got a link to a useful resource you think the community could benefit from? Awesome you can submit it to our resources system by using this form.</p>
			<p>All submitted resource links are revied by the staff of webrepo. This keeps out the spam and duplicates. So please dont not be offended if your link doesnt show up straight away!</p>
            <small>Submitting a bad link will result in your losing your account, you have been warned!</small>
		</div>

	</div>


	<div class="large-8 large-pull-4 columns">
		<div class="content-box">

			<form class="add" method="post" action="{{ route('add-resource') }}" role="form">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="large-12 columns">
                    <label for="title">Resource Name</label>
                    <input class="{{ $errors->first('title', ' error') }}" type="text" name="title" value="{{ Input::old('title') }}" />
                    {{ $errors->first('title', '<small class="error">:message</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="hidden_tags"> Tags <small>3 max</small></label>
                    <input id="tm-input" class="tags" type="text" name="tags" placeholder="Add tag"/>
                    {{ $errors->first('hidden-tags', '<small class="error">The tags field is required.</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="link">Resource URL</label>
                    <input class="{{ $errors->first('link', ' error') }}" type="text" name="link" value="{{ Input::old('link') }}" />
                    {{ $errors->first('link', '<small class="error">:message</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="content">Why should we add this to our library of resources?</label>
                    <textarea id="resize" rows="5" class="{{ $errors->first('description', ' error') }}" name="description" type="text">{{ Input::old('description') }}</textarea>
                    {{ $errors->first('description', '<small class="error">Please tell us why you want this resource to be shown</small>') }}
                </div>

                <div class="large-12 columns">
                    <button class="tiny" type="submit">Submit</button>
                </div>


			</form>
		</div>
	</div>


</div>


</div>


@stop