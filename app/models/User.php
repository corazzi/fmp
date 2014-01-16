<?php 


class User extends Base {

    protected $table = 'users';

    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

}