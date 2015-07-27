<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Position;
use App\Department;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('positions'))
        {
            $positions          = Position::all();
            $selectPositions    = array();
            $selectPositions[0] = "Select one";

            foreach ($positions as $position) {
               $selectPositions[$position->id] = $position->name;
            }

             \View::share('selectPositions',$selectPositions);

        }

         if (\Schema::hasTable('departments'))
        {
            $departments          = Department::all();
            $selectDepartments    = array();
            $selectDepartments[0] = "Select one";

            foreach ($departments as $department) {
               $selectDepartments[$department->id] = $department->name;
            }

             \View::share('selectDepartments',$selectDepartments);

        }
    }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
