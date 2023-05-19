<?php

namespace Relations;

use App\Models\Image;
use App\Models\Zip;
use Tests\TestCase;

/**
 *
 */
class UserRelationTest extends TestCase
{

    /**
     * @return void
     */
    public function test_cascade_on_delete_images()
    {
        $user = $this->createUser();
        $images = Image::factory(5)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('images', 5);
        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

        $this->assertDatabaseMissing('images', [
            'user_id' => $user->id,
        ]);
    }

    public function test_cascade_on_delete_zip_archives()
    {
        $user = $this->createUser();
        $zips = Zip::factory(5)->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('zips', 5);
        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

        $this->assertDatabaseMissing('zips', [
            'user_id' => $user->id,
        ]);
    }


}
