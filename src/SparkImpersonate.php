<?php

namespace Lucacri\SparkImpersonate;

use Laravel\Nova\Fields\Field;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Resource;

class SparkImpersonate extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'spark-impersonate';
	public $textAlign = 'center';
	public $meta = [
		'hideText'    => true,
		'redirect_to' => '/',
	];

	public function __construct($user = null)
	{
		parent::__construct(null, null, null);
		if (method_exists(auth()->user(), 'canImpersonate') && !auth()->user()->canImpersonate()) {
			$this->component = null;
			return;
		}
		if ($user != null) {
			if (is_numeric($user) || is_string($user)) {
				$this->withMeta(['id' => $user instanceof Model ? $user->id : $user]);
			} else {
				$user = $user instanceof Resource ? $user->resource : $user;
				if (method_exists($user, 'canBeImpersonated') && !$user->canBeImpersonated()) {
					$this->component = null;
					return;
				}
				$this->withMeta(['id' => $user instanceof Model ? $user->id : $user]);
			}
		}
		$this->exceptOnForms();
	}

}
