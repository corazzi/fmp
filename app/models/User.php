<?php 


class User extends Base {

    protected $table = 'users';

    public function fullName()
    {
    	return "{$this->first_name} {$this->last_name}";;
    }

}