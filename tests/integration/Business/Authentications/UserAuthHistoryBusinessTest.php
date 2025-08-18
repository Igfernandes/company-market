<?php

namespace Tests\Integration\Business\Authentications;

use App\Business\Authentications\UserAuthHistoryBusiness;
use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Models\Users\UsersAuthHistoryModel;
use CodeIgniter\Test\CIUnitTestCase;

class UserAuthHistoryBusinessTest extends CIUnitTestCase
{
    protected $namespace = 'App';

    private UserAuthHistoryBusiness $business;
    private UsersAuthHistoryModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->business = new UserAuthHistoryBusiness();
        $this->model = new UsersAuthHistoryModel();
    }

    /** @test */
    public function itShouldStoreUserAuthHistory()
    {
        // Arrange
        $userId = 1; // simula um usuário existente
        $userSettings = (object) [
            'ip'      => '127.0.0.1',
            'browser' => 'Chrome',
        ];

        // Act
        $this->business->store($userId, $userSettings);

        // Assert
        $record = $this->model
            ->where('user_id', $userId)
            ->first();

        $this->assertInstanceOf(UserAuthHistoryEntity::class, $record);
        $this->assertSame('127.0.0.1', $record->ip);
        $this->assertSame('Chrome', $record->browser);
        $this->assertSame($userId, $record->user_id);
    }
}
