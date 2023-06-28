<?php

namespace Tests\Browser\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use WithFaker;

    private $first_name;
    private $last_name;
    private $phone;
    private $email;
    private $password;
    private $password_confirmation;
    private $terms;

    /**
     * @group main
     * @group Register
     * @throws \Throwable
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->first_name = $this->faker()->firstName;
        $this->last_name = $this->faker()->lastName;
        $this->email = $this->faker()->email;
        $this->password = $this->faker->password(8, 16, true, true, true);
        $this->password_confirmation = $this->password;
        $this->terms = true;
    }

    /**
     * @group main
     * @group Register
     * @throws \Throwable
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

//    /**
//     * @group main
//     * @throws \Throwable
//     */
//    public function test_view()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/admin/register')
//                ->assertSee('Đăng Ký');
//        });
//    }

    /**
     * @group main
     * @throws \Throwable
     */
    public function test_register_phone_error_response()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/register')
                ->waitForInput('first_name')
                ->typeSlowly('@first_name', $this->first_name, 10)
                ->typeSlowly('@last_name', $this->last_name, 10)
                ->typeSlowly('input[name="phone"]', 'abcd#@111111')
                ->typeSlowly('@email', $this->email, 10)
                ->typeSlowly('@password', $this->password, 1)
                ->typeSlowly('@password_confirmation', $this->password_confirmation, 1)
//                ->click('#terms')
//                ->click('label.new-checkbox')
//                ->click('div.n-chk span.new-control-indicator')
                ->press('@register')
                ->waitForText('Trường số điện thoại phải là một số.')
                ->assertSee('Trường số điện thoại phải là một số.')
                ->pause(5000);
        });
    }

    /**
     * @group main
     * @throws \Throwable
     */
    public function test_register_phone2_error_response()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/register')
                ->waitForInput('first_name')
                ->typeSlowly('@first_name', $this->first_name, 10)
                ->typeSlowly('@last_name', $this->last_name, 10)
                ->typeSlowly('input[name="phone"]', '0123456789')
                ->typeSlowly('@email', $this->email, 10)
                ->typeSlowly('@password', $this->password, 1)
                ->typeSlowly('@password_confirmation', $this->password_confirmation, 1)
//                ->click('#terms')
//                ->click('label.new-checkbox')
//                ->click('div.n-chk span.new-control-indicator')
                ->press('@register')
                ->waitForText('Trường phone number có định dạng không hợp lệ.')
                ->assertSee('Trường phone number có định dạng không hợp lệ.')
                ->pause(5000);
        });
    }

    /**
     * @group main
     * @throws \Throwable
     */
    public function test_register_phone3_error_response()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/register')
                ->waitForInput('first_name')
                ->typeSlowly('@first_name', $this->first_name, 10)
                ->typeSlowly('@last_name', $this->last_name, 10)
                ->typeSlowly('input[name="phone"]', '096999099088')
                ->typeSlowly('@email', $this->email, 10)
                ->typeSlowly('@password', $this->password, 1)
                ->typeSlowly('@password_confirmation', $this->password_confirmation, 1)
//                ->click('#terms')
//                ->click('label.new-checkbox')
//                ->click('div.n-chk span.new-control-indicator')
                ->press('@register')
                ->waitForText('Độ dài của trường phone number phải nằm trong khoảng 10 and 11 chữ số.')
                ->assertSee('Độ dài của trường phone number phải nằm trong khoảng 10 and 11 chữ số.')
                ->pause(5000);
        });
    }
}
