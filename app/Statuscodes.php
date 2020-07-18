<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuscodes extends _BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'statuscodes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public $timestamps = false;

	/**
	 * The attributes which can be mass-assigned
	 *
	 * @var array
	 */
	protected $fillable = array('title');

	/**
	 * These attributes are NOT mass assignable
	 */
	protected $guarded = array('id', '_id');

	protected $appends = array();

	protected $relations = ['items'];

	protected static $rules = array(

		'save' => array(

		),
		'create' => array(

		),
		'update' => array(

		)

	);

	public function items() {

	    return $this->hasMany('Item');

	}

	public static function boot() {

	    parent::boot();

	    static::saving(function($m){
	    	$m->generateSlug();
	    });

	}

	public function generateSlug() {
	   return $this->slug = Str::slug($this->title);
	}



}