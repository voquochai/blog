<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
use App\Helpers\TemplateFactory;

class Template extends Facade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
    	return TemplateFactory::class;
    }
}