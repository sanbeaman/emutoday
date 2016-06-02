<?php

use Illuminate\Database\Seeder;

class PermissionsAndRolesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



			DB::table('roles')->insert([
					[
						'name' => 'admin_super',
						'label' => 'overall super admin'
					],
					[
						'name' => 'admin',
						'label' => 'almost all the  same permissions as super admin'
					],
					[
						'name' => 'editor_super',
						'label' => 'all permssions related to content editing'
					],
					[
						'name' => 'editor',
						'label' => 'most permssions related to content editing'
					],
			]);

	

			DB::table('permissions')->insert([
					[
						'name' => 'super',
						'label' => 'permision to do anything'
					],
					[
						'name' => 'admin',
						'label' => 'permision to do almost anything'
					],
					[
						'name' => 'edit_all',
						'label' => 'edit any story'
					],
					[
						'name' => 'edit_only',
						'label' => 'edit only created story'
					],
			]);
    }
}
