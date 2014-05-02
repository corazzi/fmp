<?php 

use Cartalyst\Sentry\Users\Eloquent\User as SentryModel;


class User extends SentryModel {

    protected $table = 'users';


    /**
     * A user's favorite snippets
     *
     * @return mixed
     */

    public function snippet_favorites()
    {
        return $this->belongsToMany('Snippet', 'snippets_favorite');
    }

    /**
     * A user's vote's
     *
     * @return mixed
     */

    public function snippet_ratings()
    {
        return $this->belongsToMany('Snippet', 'snippets_rating');
    }

    /**
     * Snippet comments
     *
     * @return mixed
     */

    public function snippet_comments()
    {
        return $this->belongsToMany('Snippet', 'snippets_comment')->withTimestamps();
    }


}