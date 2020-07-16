<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidates extends  _BaseModel 
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tbl_emp_candidates';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array(self::CREATED_AT, self::UPDATED_AT);

	/**
	 * The attributes which can be mass-assigned
	 *
	 * @var array
	 */
	protected $fillable = array('name');

	/**
	 * These attributes are NOT mass assignable
	 */
	protected $guarded = array('id', '_id');

	protected $appends = array();

	protected $relations = [];

	protected static $rules = array(

		'save' => array(

		),
		'create' => array(

		),
		'update' => array(

		)

	);
}
