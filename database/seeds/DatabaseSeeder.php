<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Position;
use App\Department;
use App\Province;
use App\District;
use App\Municipality;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    # =========================================================================
    # POSITIONS SEEDS
    # =========================================================================


        DB::table('positions')->delete();

        $positions = [
                ['name' => 'Acting Maintenance Manager', 'slug' => "Acting Maintenance Manager"] ,
                ['name' => 'Acting Technical Officer','slug' => 'Acting Technical Officer'],
                ['name' => 'Acting Technical supervisor repair line','slug' => 'Acting Technical supervisor repair line'],
                ['name' => 'Continuous improvement manager','slug' => 'Continuous improvement manager'],
                ['name' => 'Engineer In training','slug' => 'Engineer In training'],
                ['name' => 'Environment Manager','slug' => 'Environment Manager'],
                ['name' => 'Environment Officer','slug' => 'Environment Officer'],
                ['name' => 'Environmental Specialist','slug' => 'Environmental Specialist'],
                ['name' => 'Fire Officer','slug' => 'Fire Officer'],
                ['name' => 'Fire Services','slug' => 'Fire Services'],
                ['name' => 'Human Environment Manager','slug' => 'Human Environment Manager'],
                ['name' => 'Maintenance manager roads & tracks','slug' => 'Maintenance manager roads & tracks'],
                ['name' => 'Manager: Safety, Health & Environment','slug' => 'Manager: Safety, Health & Environment'],
                ['name' => 'Operations centre manager','slug' => 'Operations centre manager'],
                ['name' => 'Port Security Officer','slug' => 'Port Security Officer'],
                ['name' => 'Real Estate Manager','slug' => 'Real Estate Manager'],
                ['name' => 'Risk ','slug' => 'Risk'],
                ['name' => 'Risk Control Officer','slug' => 'Risk Control Officer'],
                ['name' => 'Risk Manager','slug' => 'Risk Manager'],
                ['name' => 'Risk Specialist','slug' => 'Risk Specialist'],
                ['name' => 'Security Operations Manager','slug' => 'Security Operations Manager'],
                ['name' => 'Senior Electrical Engineer','slug' => 'Senior Electrical Engineer'],
                ['name' => 'Senior Engineer','slug' => 'Senior Engineer'],
                ['name' => 'Senior Manager: Operations Cont','slug' => 'Senior Manager: Operations Cont'],
                ['name' => 'Senior Manager: Operations MW','slug' => 'Senior Manager: Operations MW'],
                ['name' => 'SHE Field Officer','slug' => 'SHE Field Officer'],
                ['name' => 'Supervisor','slug' => 'Supervisor'],
                ['name' => 'Supervisor [Earthworks]','slug' => 'Supervisor [Earthworks]'],
                ['name' => 'Technical manager Power supplies','slug' => 'Technical manager Power supplies'],
                ['name' => 'Technical Officer','slug' => 'Technical Officer'],
                ['name' => 'Technical Supervisor','slug' => 'Technical Supervisor'],
                ['name' => 'Technical Supervisor (Control Officer)','slug' => 'Technical Supervisor (Control Officer)'],
                ['name' => 'Technical Supervisor (Pier 1)','slug' => 'Technical Supervisor (Pier 1)'],
                ['name' => 'Technical Supervisor (Point)','slug' => 'Technical Supervisor (Point)'],
                ['name' => 'Technical Supervisor [Dockyard]','slug' => 'Technical Supervisor [Dockyard]'],
                ['name' => 'Technical Supervisor building & marine','slug' => 'Technical Supervisor building & marine'],
                ['name' => 'Technical Supervisor diving','slug' => 'Technical Supervisor diving'],
                ['name' => 'Technician','slug' => 'Technician'],
                ['name' => 'Track inspector','slug' => 'Track inspector'],
                ['name' => 'Trackmaster','slug' => 'Trackmaster'],
                ['name' => 'Waste Management Officer','slug' => 'Waste Management Officer'],

        ];

        foreach ($positions as $position) {
            Position::create($position);
        }


    # =========================================================================
    # DEPARTMENTS SEEDS
    # =========================================================================


        DB::table('departments')->delete();

        $departments = [
                ['name' => 'Bayhead Precinct', 'slug' => "Bayhead Precinct"] ,
                ['name' => 'Container Precinct', 'slug' => "Container Precinct"] ,
                ['name' => 'Continuous Improvement', 'slug' => "Continuous Improvement"] ,
                ['name' => 'Corporate Affairs', 'slug' => "Corporate Affairs"] ,
                ['name' => 'Customer Relations Management', 'slug' => "Customer Relations Management"] ,
                ['name' => 'Finance', 'slug' => "Finance"] ,
                ['name' => 'Harbour Master', 'slug' => "Harbour Master"] ,
                ['name' => 'Human Resources', 'slug' => "Human Resources"] ,
                ['name' => 'IMS/ICT', 'slug' => "IMS/ICT"] ,
                ['name' => 'Island view Precinct', 'slug' => "Island view Precinct"] ,
                ['name' => 'Legal & Compliance', 'slug' => "Legal & Compliance"] ,
                ['name' => 'Marine Operations', 'slug' => "Marine Operations"] ,
                ['name' => 'Maydon Wharf Precinct', 'slug' => "Maydon Wharf Precinct"] ,
                ['name' => 'New Business Development', 'slug' => "New Business Development"] ,
                ['name' => 'Planning & Development', 'slug' => "Planning & Development"] ,
                ['name' => 'Point Precinct', 'slug' => "Point Precinct"] ,
                ['name' => 'Port Engineer', 'slug' => "Port Engineer"] ,
                ['name' => 'Port Management', 'slug' => "Port Management"] ,
                ['name' => 'Procurement', 'slug' => "Procurement"] ,
                ['name' => 'Real Estate', 'slug' => "Real Estate"] ,
                ['name' => 'Security', 'slug' => "Security"] ,
                ['name' => 'SHEQ & Fire', 'slug' => "SHEQ & Fire"] ,
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }


    # =========================================================================
    # PROVINCES SEEDS
    # =========================================================================


        DB::table('provinces')->delete();

        $provinces = [
                ['name' => 'KZN', 'slug' => "KZN"] ,
                ['name' => 'EC', 'slug' => "EC"] ,
                ['name' => 'WC', 'slug' => "WC"] ,

        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }




# =========================================================================
# DISTRICTS SEEDS
# =========================================================================


        DB::table('districts')->delete();

        $districts = [
                ['name' => 'Richards Bay', 'slug' => "Richards Bay", 'province' => 1] ,
                ['name' => 'Durban', 'slug' => "Durban", 'province' => 1] ,
                ['name' => 'East London', 'slug' => "East London", 'province' => 2] ,
                ['name' => 'Ngqura', 'slug' => "Ngqura", 'province' => 2] ,
                ['name' => 'Port Elizabeth', 'slug' => "Port Elizabeth", 'province' => 2],
                ['name' => 'Mossel Bay', 'slug' => "Mossel Bay", 'province' => 2],
                ['name' => 'Cape Town', 'slug' => "Cape Town", 'province' => 3],
                ['name' => 'Saldanha ', 'slug' => "Saldanha ", 'province' => 3],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }

    # =========================================================================
    # MUNICIPALITIES SEEDS
    # =========================================================================


        DB::table('municipalities')->delete();

        $municipalites = [
                ['name' => 'Point', 'slug' => "Point", 'district' => 2] ,
                ['name' => 'Bayhead', 'slug' => "Bayhead", 'district' => 2] ,
                ['name' => 'Containers', 'slug' => "Containers", 'district' => 2] ,
                ['name' => 'Island view', 'slug' => "Island view", 'district' => 2] ,
                ['name' => 'Maydon Wharf', 'slug' => "Maydon Wharf", 'district' => 2] ,
        ];

        foreach ($municipalites as $municipality) {
            Municipality::create($municipality);
        }

    }
}
