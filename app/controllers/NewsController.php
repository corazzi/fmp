<?php

class NewsController extends BaseController { 


	public function __construct()
	{
		parent::__construct();
		
		//check if the user is logged in
        $this->beforeFilter('auth');        
	}

	public function getNews()
	{

        $saved_feeds = News::where('user_id', Sentry::getUser()->id)->get();

        $feed_urls = News::where('user_id', Sentry::getUser()->id)->lists('url');

        $all_feeds = News::read_all_feeds($feed_urls);

        return View::make('dash.news.news_home', compact('all_feeds', 'saved_feeds'));
    }

	public function postNews()
	{
		
		$rules = array(
			'feed_url' => 'required'
		);

		//create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		//if validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			//oops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}


		//lets check if the user hasnt already saved 5 feeds
		//get all feeds where user_id
		$user_feeds = News::where('user_id', Sentry::getUser()->id)->get();

        //check the the saved user feeds are greater than or equal to 5
		if($user_feeds->count() >= 5)
		{
            Notification::error('You can only save 5 feeds!');
            return Redirect::route('news-home');
		}


        // get the feed 
		$news_url = FeedReader::read(e(Input::get('feed_url')));

        //check if its an RSS feed
		if($news_url->error())
		{
			//if it isnt show error
			Notification::error('That feed doesnt exist!');
			return Redirect::route('news-home');

		}		
        else 
        {

        	//else add to databse

		    $news = new News();
        
            $news->title    = $news_url->get_title(); //feed title
		    $news->url      = e(Input::get('feed_url')); //feed url
		    $news->user_id  = Sentry::getUser()->id; //user id


		    if($news->save())
		    {
		    	//if the feed was added to the database
			    Notification::success("Feed added!");
			    return Redirect::route("news-home");
		    }

            //feed wasnt saved
		    Notification::error("Something went wrong, try again!");
		    return Redirect::to('news-home');

        }


	}

	public function postDeleteNews($slug)
	{

		$feed_data = News::where('slug', $slug)->first();

		if (is_null($feed_data)) 
		{
			Notification::error("Feed doesnt exist");
			return Redirect::route('news-home');
		}
        else 
        {
        	$feed_data->delete();

        	Notification::success("Feed removed successfully");
        	return Redirect::route('news-home');

        }

	}

}