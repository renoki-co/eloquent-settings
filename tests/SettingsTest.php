<?php

namespace Rennokki\Settings\Test;

use Rennokki\Settings\Test\Models\User;

class SettingsTest extends TestCase {

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\Rennokki\Settings\Test\Models\User::class)->create();
    }

    public function testGettingTheValueForNonExisting()
    {
        $this->assertEquals($this->user->getSettingValue('is_online', 'string'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'int'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'integer'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'bool'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'boolean'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'float'), null);
        $this->assertEquals($this->user->getSettingValue('is_online', 'double'), null);
    }

    public function testSettingCreationWithCastsForBooleanTrue()
    {
        $this->user->newSetting('is_online', true);

        $this->assertEquals($this->user->getSettingValue('is_online'), '1');
        $this->assertEquals($this->user->getSettingValue('is_online', 'string'), '1');
        $this->assertEquals($this->user->getSettingValue('is_online', 'int'), 1);
        $this->assertEquals($this->user->getSettingValue('is_online', 'integer'), 1);
        $this->assertEquals($this->user->getSettingValue('is_online', 'bool'), true);
        $this->assertEquals($this->user->getSettingValue('is_online', 'boolean'), true);
        $this->assertEquals($this->user->getSettingValue('is_online', 'float'), 1.0);
        $this->assertEquals($this->user->getSettingValue('is_online', 'double'), 1.0);

        $this->user->newSetting('is_online', true, 'bool');

        $this->assertEquals($this->user->getSettingValue('is_online'), '1');
        $this->assertEquals($this->user->getSettingValue('is_online', 'string'), '1');
        $this->assertEquals($this->user->getSettingValue('is_online', 'int'), 1);
        $this->assertEquals($this->user->getSettingValue('is_online', 'integer'), 1);
        $this->assertEquals($this->user->getSettingValue('is_online', 'bool'), true);
        $this->assertEquals($this->user->getSettingValue('is_online', 'boolean'), true);
        $this->assertEquals($this->user->getSettingValue('is_online', 'float'), 1.0);
        $this->assertEquals($this->user->getSettingValue('is_online', 'double'), 1.0);
    }

    public function testSettingCreationWithCastsForBooleanFalse()
    {
        $this->user->newSetting('is_subscribed', false);

        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'string'), '0');
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'int'), 0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'integer'), 0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'float'), 0.0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'double'), 0.0);

        $this->user->newSetting('is_subscribed', false, 'boolean');

        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'string'), '0');
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'int'), 0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'integer'), 0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'float'), 0.0);
        $this->assertEquals($this->user->getSettingValue('is_subscribed', 'double'), 0.0);
    }

    public function testSettingCreationWithCastsForInteger()
    {
        $this->user->newSetting('coins', 10);

        $this->assertEquals($this->user->getSettingValue('coins', 'string'), '10');
        $this->assertEquals($this->user->getSettingValue('coins', 'int'), 10);
        $this->assertEquals($this->user->getSettingValue('coins', 'integer'), 10);
        $this->assertEquals($this->user->getSettingValue('coins', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('coins', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('coins', 'float'), 10.0);
        $this->assertEquals($this->user->getSettingValue('coins', 'double'), 10.0);

        $this->user->newSetting('coins', 10, 'integer');

        $this->assertEquals($this->user->getSettingValue('coins', 'string'), '10');
        $this->assertEquals($this->user->getSettingValue('coins', 'int'), 10);
        $this->assertEquals($this->user->getSettingValue('coins', 'integer'), 10);
        $this->assertEquals($this->user->getSettingValue('coins', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('coins', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('coins', 'float'), 10.0);
        $this->assertEquals($this->user->getSettingValue('coins', 'double'), 10.0);
    }

    public function testSettingCreationWithCastsForFloat()
    {
        $this->user->newSetting('height', 10);

        $this->assertEquals($this->user->getSettingValue('height', 'string'), '10');
        $this->assertEquals($this->user->getSettingValue('height', 'int'), 10);
        $this->assertEquals($this->user->getSettingValue('height', 'integer'), 10);
        $this->assertEquals($this->user->getSettingValue('height', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('height', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('height', 'float'), 10.0);
        $this->assertEquals($this->user->getSettingValue('height', 'double'), 10.0);

        $this->user->newSetting('height', 10, 'float');

        $this->assertEquals($this->user->getSettingValue('height', 'string'), '10');
        $this->assertEquals($this->user->getSettingValue('height', 'int'), 10);
        $this->assertEquals($this->user->getSettingValue('height', 'integer'), 10);
        $this->assertEquals($this->user->getSettingValue('height', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('height', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('height', 'float'), 10.0);
        $this->assertEquals($this->user->getSettingValue('height', 'double'), 10.0);
    }

    public function testSettingCreationWithCastsForString()
    {
        $this->user->newSetting('nickname', '@rennokki');

        $this->assertEquals($this->user->getSettingValue('nickname', 'string'), '@rennokki');
        $this->assertEquals($this->user->getSettingValue('nickname', 'int'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'integer'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('nickname', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('nickname', 'float'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'double'), null);

        $this->user->newSetting('nickname', '@rennokki', 'string');

        $this->assertEquals($this->user->getSettingValue('nickname', 'string'), '@rennokki');
        $this->assertEquals($this->user->getSettingValue('nickname', 'int'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'integer'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'bool'), false);
        $this->assertEquals($this->user->getSettingValue('nickname', 'boolean'), false);
        $this->assertEquals($this->user->getSettingValue('nickname', 'float'), null);
        $this->assertEquals($this->user->getSettingValue('nickname', 'double'), null);
    }

    public function testSettingCreation()
    {
        $this->user->newSetting('existence_code', 'this_is_a_secret_code');
        $this->assertEquals($this->user->getSettingValue('existence_code'), 'this_is_a_secret_code');
    }

    public function testSettingCreationWhenItAlreadyExists()
    {
        $this->user->newSetting('existence_code', 'this_is_a_secret_code');
        $this->assertEquals($this->user->getSettingValue('existence_code'), 'this_is_a_secret_code');

        $this->user->newSetting('existence_code', 'this_is_another_secret_code');
        $this->assertEquals($this->user->getSettingValue('existence_code'), 'this_is_another_secret_code');
    }

    public function testSettingUpdateWithoutExisting()
    {
        $this->assertEquals($this->user->getSettingValue('existence_code'), null);

        $this->user->updateSetting('existence_code', 'this_is_a_secret_code');
        $this->assertEquals($this->user->getSettingValue('existence_code'), 'this_is_a_secret_code');
    }

    public function deleteSettingWithoutExisting()
    {
        $this->assertEquals($this->user->getSettingValue('i_do_not_exist'), null);

        $this->assertEquals($this->user->deleteSetting('i_do_not_exist'), false);
        $this->assertEquals($this->user->getSettingValue('i_do_not_exist'), null);
    }

    public function deleteSetting()
    {
        $this->newSetting('i_exist', 'i_exist_here_i_am');

        $this->assertEquals($this->user->deleteSetting('i_exist'), true);
        $this->assertEquals($this->user->getSettingValue('i_exist'), null);
    }
}