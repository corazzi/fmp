<?php 


class Snippet extends Eloquent {

	protected $table = 'snippets';

    public function url()
    {
        return URL::route('public', $this->slug);
    }
	
}