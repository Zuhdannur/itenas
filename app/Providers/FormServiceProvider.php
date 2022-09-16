<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('customText','components.form.text',['name','label' => null,'value' => null,'attributes' => []]);
        Form::component('customSelect','components.form.select',['name','items','label' => null,'value' => null,'attributes' => []]);
        Form::component('customDate','components.form.date',['name','label' => null,'value' => null,'attributes' => []]);
        Form::component('customTextarea','components.form.textarea',['name','label' => null,'value' => null,'disabled'=> false,'attributes' => []]);
    }
}
