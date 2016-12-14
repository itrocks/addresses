<?php
namespace ITRocks\Addresses;

/**
 * This stores contact information and address
 *
 * @business
 * @representative first_name, last_name
 */
class Address
{

	/**
	 * @multiline
	 * @var string
	 */
	public $address;

	/**
	 * @var string
	 */
	public $first_name;

	/**
	 * @var string
	 */
	public $last_name;

	/**
	 * This is mandatory for all business objects, always get a view as string
	 *
	 * @return string
	 */
	public function __toString()
	{
		return trim($this->first_name . SP . $this->last_name);
	}

}
