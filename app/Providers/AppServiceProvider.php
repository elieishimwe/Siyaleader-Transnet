<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Position;
use App\Department;
use App\Province;
use App\District;
use App\Municipality;

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

        if (\Schema::hasTable('provinces'))
        {
            $provinces          = Province::all();
            $selectProvinces    = array();
            $selectProvinces[0] = "Select one";

            foreach ($provinces as $Province) {
               $selectProvinces[$Province->id] = $Province->name;
            }

             \View::share('selectProvinces',$selectProvinces);

        }

        if (\Schema::hasTable('districts'))
        {
            $districts          = District::all();
            $selectDistrict     = array();
            $selectDistricts[0] = "Select one";

            foreach ($districts as $district) {
               $selectDistricts[$district->id] = $district->name;
            }

             \View::share('selectDistricts',$selectDistricts);

        }

        if (\Schema::hasTable('municipalities'))
        {
            $municipalities          = Municipality::all();
            $selectMunicipalities    = array();
            $selectMunicipalities[0] = "Select one";
            foreach ($municipalities as $municipality) {
               $selectMunicipalities[$municipality->id] = $municipality->name;
            }

             \View::share('selectMunicipalities',$selectMunicipalities);

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
