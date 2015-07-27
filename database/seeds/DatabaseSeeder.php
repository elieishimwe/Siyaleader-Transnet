<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Position;

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


    }
}
