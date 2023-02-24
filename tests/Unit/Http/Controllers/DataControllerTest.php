<?php

namespace Http\Controllers;

use App\Models\DataModel;
use App\Models\User;
use Tests\TestCase;

class DataControllerTest extends TestCase
{

    public function test_data_can_be_created()
    {

        $user = User::factory(1)->create()->first();
        $token = $user->createToken('test_token')->plainTextToken;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->post('/api/data', [
            'data' => [
                'test' => 'ok'
            ]
        ]);
        $response->assertCreated();
    }

    public function test_data_can_be_updated()
    {
        $user = User::factory(1)->create()->first();
        $token = $user->createToken('test_token')->plainTextToken;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->post('/api/data', [
            'data' => [
                'test' => 'ok'
            ]
        ]);
        $data_id = json_decode($response->content())->id;
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->post('/api/data/update', [
            'id' => $data_id,
            'actions' => '$data->ok = true;'
        ]);
        file_put_contents('twt.json', $response->getContent());
        $response->assertOk();
    }

    public function test_data_can_be_displayed()
    {
        $randomId = DataModel::get()->first()->id;
        $response = $this->get('data/' . $randomId);
        $response->assertOk();
    }

    public function test_crud_table_is_displaying()
    {
        $response = $this->get('data/all');
        $response->assertOk();
    }

    public function test_404_for_non_existing_data()
    {
        $response = $this->get('data/0');
        $response->assertNotFound();
    }

    public function test_data_can_be_deleted()
    {
        $randomId = DataModel::get()->first()->id;
        $response = $this->delete('api/data/' . $randomId);
        $response->assertOk();
    }
}
