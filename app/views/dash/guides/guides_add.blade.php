@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Add Guide')

{{-- Page content --}}
@section('content')

<div class="page-header">
	<div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-book"></i> @yield('title')</h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('user-guides') }}">User Guides</a>
    <a class="unavailable">Add Guide</a>  
</div>

<div class="inner-content">

	<div class="large-4 large-push-8 columns user-guides">
		<div class="content-box">
			<p>Ever spent hours trying to fix or create something? Did you find a easier way to do that task? Why not share it with the <b>webrepo.io</b> community, we would love to hear about it.</p>
            <p>Guides can cover all ranges of web development you can include code and images in your guides by using webrepos custom <span class="markdown" data-reveal-id="markdownModal"><a>Markdown</a></span>.</p>
            <small>As always, abusing the sites features will result in you being banned. (just not worth it!)</small>
		</div>

	</div>


	<div class="large-8 large-pull-4 columns">
		<div class="content-box">

			<form class="add" method="post" action="{{ route('add-guide') }}" role="form">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="large-12 columns">
                    <label for="title">Guide Title <small>Please be descriptive as possible</small></label>
                    <input class="{{ $errors->first('title', ' error') }}" type="text" name="title" value="{{ Input::old('title') }}" />
                    {{ $errors->first('title', '<small class="error">:message</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="hidden_tags">Tags <small>3 max</small></label>
                    <input id="tm-input" class="tags" type="text" name="tags" placeholder="Add tag"/>
                    {{ $errors->first('hidden-tags', '<small class="error">The tags field is required.</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="content">Guide Content <small class="markdown" data-reveal-id="markdownModal"><a>Markdown Enabled (?)</a></small></label>
                    <textarea id="resize" rows="15" class="{{ $errors->first('content', ' error') }}" name="content" type="text">{{ Input::old('content') }}</textarea>
                    {{ $errors->first('content', '<small class="error">:message</small>') }}
                </div>

                <div class="large-12 columns">
                    <button class="tiny" type="submit">Publish</button>
                </div>


			</form>
		</div>
	</div>


    <div id="markdownModal" class="reveal-modal medium" data-reveal>
        <h2>Markdown</h2>
        <p>Because we like our users we decided it should take little to no effort to format your posts. To make this possible we have created a custom markdown which can be seen in action below.</p>
        <table>
  <thead>
    <tr>
      <th width="200">Markdown</th>
      <th width="600">Usage</th>
      <th width="200">Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>[code][/code]</td>
      <td>[code] <br>
           public function helloWorld() { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;echo "Hello World"; <br>
           } <br>
           [/code]
       </td>
      <td>
<pre><code style="background:#e3e3e3;">public function helloWorld() { 
    echo "Hello World"; 
} 
</code></pre>
</td>
    </tr>
    <tr>
      <td>[b][/b]</td>
      <td>[b] So Bold Son [/b]</td>
      <td><b>So Bold Son</b></td>
    </tr>
    <tr>
      <td>[i][/i]</td>
      <td>[i] So Italic Bro [/i]</td>
      <td><em>So Italic Bro</em></td>
    </tr>
  </tbody>
</table>
        <a class="close-reveal-modal">&#215;</a>
    </div>

</div>
@stop