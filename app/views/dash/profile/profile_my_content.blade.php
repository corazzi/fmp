@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'My Content')

{{-- Page content --}}
@section('content')

<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-user"></i> @yield('title')</h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('me-home') }}">Profile</a>
    <a class="unavailable">My Content</a>  
</div>

<div class="inner-content">

    <div class="large-3 columns">

        @include('layout/profile_nav')

    </div>

    <div class="large-9 columns">
        <div class="content-box">
            

        <dl class="tabs" data-tab>
            <dd class="active"><a href="#favorites">Favourite</a></dd>
            <dd><a href="#my-snippets">My Snippets</a></dd>
            <dd><a href="#my-guides">My Guides</a></dd>
            <dd><a href="#resources">Resources</a></dd>
        </dl>

        <div class="tabs-content">
            
            <div class="content active" id="favorites">

                <div class="me-content">

                    <p>All the guides and snippets you have favorite can bee seen here for future reference.</p>
                   

                    <h5 style="margin:1rem 0;"><b>Favourite Snippets</b></h5>
                
                @if (isset($fav_snippets))
                
                    @if ($fav_snippets->count())

                    <table>
                        
                        <thead>
                            <th width="350">Name</th>
                            <th width="350">Tags</th>
                            <th width="300">Actions</th>
                        </thead>
                        <tbody>

                    @foreach ($fav_snippets as $fsnip)

                            <tr>
                                <td>{{ $fsnip->title }}</td>


                                <?php 

                                    $tags = explode( ',', $fsnip->tags); 
                                    $spaced_tags = str_replace(' ', '', $tags); 

                                ?>

                                <td> 

                                    @foreach ($spaced_tags as $tag)
                                        <a href="{{ route('view-tags-snippets', $tag) }}"><span class="label">{{ $tag }}</span></a>
                                    @endforeach

                                </td>
                          
                                <td>
                                    <a href="{{ route('view-snippet', $fsnip->slug) }}" class="is-feed-edit" title="View Snippet"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                    @endforeach

                        </tbody>
                    </table>

                    @endif

                @else 


                  <p>You have yet to favourite any snippets.</p>

                @endif


                    <h5 style="margin:1rem 0;"><b>Favourite Guides</b></h5>
@if (isset($fav_guides))
                    @if ($fav_guides->count())

                    <table>
                        
                        <thead>
                            <th width="350">Name</th>
                            <th width="550">Tags</th>
                            <th width="100">Actions</th>
                        </thead>
                        <tbody>

                        @foreach ($fav_guides as $fguide)
                            <tr>
                                <td>{{ $fguide->title }}</td>

                                <?php 

                                    $tags = explode( ',', $fguide->tags); 
                                    $spaced_tags = str_replace(' ', '', $tags); 

                                ?>

                                <td> 

                                    @foreach ($spaced_tags as $tag)
                                        <a href="{{ route('view-tags-guides', $tag) }}"><span class="label">{{ $tag }}</span></a>
                                    @endforeach

                                </td>


                                <td>
                                    <a href="{{ route('view-guide', $fguide->slug) }}" class="is-feed-edit" title="View Guide"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                       @endforeach

                        </tbody>
                    </table>

                    @endif

                @else 


                  <p>You have yet to favourite any guides.</p>

                @endif

                </div>
                

            </div>
            
            <div class="content" id="my-snippets">
                
                <div class="me-content">
                    
                    <p>Here you can view all of your private and public snippets you have submitted to webrepo.</p>

                    @if ($all_snippets->count())

                    <table>
                        
                        <thead>
                            <th width="400">Name</th>
                            <th width="400">Tags</th>
                            <th width="100">State</th>
                            <th width="100">Actions</th>
                        </thead>
                        <tbody>

                            @foreach($all_snippets as $snippet)
                            <tr>
                                <td>{{ $snippet->title }}</td>
                                <?php 

                                    $tags = explode( ',', $snippet->tags); 
                                    $spaced_tags = str_replace(' ', '', $tags); 

                                ?>

                                <td> 

                                    @foreach ($spaced_tags as $tag)
                                        <a href="{{ route('view-tags-snippets', $tag) }}"><span class="label">{{ $tag }}</span></a>
                                    @endforeach

                                </td>
                                <td>{{ $snippet->state }}</td>
                                <td>
                                    
                                    <a href="{{ route('delete-snippet', $snippet->slug) }}" class="is-feed-delete" title="Delete Snippet"><i class="fa fa-times"></i></a>
                                    <a href="{{ route('edit-snippet', $snippet->slug) }}" class="is-feed-edit" title="Edit Snippet"><i class="fa fa-pencil"></i></a>

                                </td>

                            
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    @else 

                    <p>You have yet to save a snippet, why not save one now? <a class="green-link" href="{{ route('add-snippet') }}"></a></p>

                    @endif
                </div>


            </div>


            <div class="content" id="my-guides">
                
                <div class="me-content">


                    <p>Here you can view all of your guides you have submitted to webrepo.</p>

                    @if ($all_snippets->count())

                    <table>
                        
                        <thead>
                            <th width="500">Name</th>
                            <th width="300">Tags</th>
                            <th width="200">Actions</th>
                        </thead>
                        <tbody>

                            @foreach($all_guides as $guide)
                            <tr>
                                <td>{{ $guide->title }}</td>
                                <?php 

                                    $tags = explode( ',', $guide->tags); 
                                    $spaced_tags = str_replace(' ', '', $tags); 

                                ?>

                                <td> 

                                    @foreach ($spaced_tags as $tag)
                                        <a href="{{ route('view-tags-guides', $tag) }}"><span class="label">{{ $tag }}</span></a>
                                    @endforeach

                                </td>
                                <td>

                                    <a href="{{ route('delete-guide', $guide->slug) }}" class="is-feed-delete" title="Delete Guide"><i class="fa fa-times"></i></a>
                                    <a href="{{ route('edit-guide', $guide->slug) }}" class="is-feed-edit" title="Edit Guide"><i class="fa fa-pencil"></i></a>


                                </td>

                            
                            </tr>
                            @endforeach
                            
                        </tbody>

                    </table>

                    @else 

                    <p>You have yet to save a guide with webrepo, why not save one now? <a class="green-link" href="{{ route('add-guide') }}"></a></p>

                    @endif
                    

                </div>

            </div>


            <div class="content" id="resources">
                
               <div class="me-content">
                   
                    
                    <p>Here you can view all of the resources you have previously submitted to the resource section. If a resource shows as not activated it hasnt been allowed by an admin to be on the live site yet, please be patient.</p>




                    @if ($all_resources->count())

                    <table>
                        
                        <thead>
                            <th width="500">Name</th>
                            <th width="300">Tags</th>
                            <th width="200">Activated</th>
                        </thead>
                        <tbody>

                            @foreach($all_resources as $resource)
                            <tr>
                                <td>{{ $resource->title }}</td>
                                <?php 

                                    $tags = explode( ',', $resource->tags); 
                                    $spaced_tags = str_replace(' ', '', $tags); 

                                ?>

                                <td> 

                                    @foreach ($spaced_tags as $tag)
                                        <span class="label">{{ $tag }}</span>
                                    @endforeach

                                </td>
                                <td>

                                  {{ ($resource->activated == 1 ? "Yes" : "No") }}

                                </td>

                            
                            </tr>
                            @endforeach
                            
                        </tbody>

                    </table>

                    @else 

                    <p>You have yet to save a guide with webrepo, why not save one now? <a class="green-link" href="{{ route('add-guide') }}"></a></p>

                    @endif



               </div>
 
            </div>


        </div>


        </div>
    </div>

</div>

@stop