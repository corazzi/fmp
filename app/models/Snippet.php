<?php 

use Carbon\Carbon;

class Snippet extends Eloquent {

	protected $table = 'snippets';

    private function url()
    {
        return URL::route('public', $this->slug);
    }

    protected function getHumanTimestampAttribute($column)
    {
        if ($this->attributes[$column])
        {
            return Carbon::parse($this->attributes[$column])->diffForHumans();
        }

        return null;
    }

    public function getHumanCreatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("created_at");
    }

    public function getHumanUpdatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("updated_at");
    } 
	
}