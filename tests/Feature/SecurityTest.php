<?php

namespace Tests\Feature;

use App\Models\adminUser;
use App\Models\ForgotPasswordModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private array $uploaded = [];

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    protected function tearDown(): void
    {
        foreach ($this->uploaded as $path) {
            @unlink($path);
        }
        parent::tearDown();
    }

    private function admin(): adminUser
    {
        return adminUser::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);
    }

    public function test_guests_cannot_register_an_admin(): void
    {
        $this->postJson('/post-registration-admin', [
            'username' => 'evil',
            'email' => 'evil@example.com',
            'password' => 'secret123',
        ])->assertStatus(401);

        $this->assertDatabaseMissing('admin_users', ['email' => 'evil@example.com']);
    }

    public function test_guests_cannot_upload_or_delete(): void
    {
        $this->postJson('/uploadFile')->assertStatus(401);
        $this->postJson('/uploadFileNews')->assertStatus(401);

        DB::table('banner_uploads')->insert(['name' => 'a', 'bannertype' => 'long', 'uploader' => 'x', 'url' => 'x']);
        $this->delete('/dashboard/1')->assertRedirect('adminlogin');
        $this->assertDatabaseCount('banner_uploads', 1);
    }

    public function test_upload_cannot_keep_a_php_extension(): void
    {
        // a PNG header followed by PHP code, named shell.php
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==');
        $admin = $this->admin();

        $this->actingAs($admin, 'admin')
            ->postJson('/uploadFile', [
                'file' => UploadedFile::fake()->createWithContent('shell.php', $png . '<?php system($_GET["c"]); ?>'),
                'bannertype' => 'long', 'uploader' => 'me', 'url' => 'x',
            ])
            ->assertJson(['success' => 0]);
        $this->assertDatabaseCount('banner_uploads', 0);

        // a real image is stored under a random name, not the client's
        $response = $this->actingAs($admin, 'admin')
            ->postJson('/uploadFile', [
                'file' => UploadedFile::fake()->createWithContent('my banner.png', $png),
                'bannertype' => 'long', 'uploader' => 'me', 'url' => 'x',
            ])
            ->assertJson(['success' => 1]);

        $name = DB::table('banner_uploads')->value('name');
        $this->uploaded[] = base_path('files/' . $name);
        $this->uploaded[] = public_path('files/' . $name);

        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]{40}\.png$/', $name);
        $this->assertStringEndsWith($name, $response->json('filepath'));
    }

    public function test_reset_pin_needs_matching_email_and_works_once(): void
    {
        $user = User::create([
            'firstname' => 'A', 'lastname' => 'B', 'email' => 'user@example.com',
            'phone' => '123', 'password' => Hash::make('old-password'),
        ]);

        $this->post('/forgotpassword', ['email' => 'user@example.com'])->assertRedirect();
        $pin = ForgotPasswordModel::where('email', 'user@example.com')->value('pin');
        $this->assertMatchesRegularExpression('/^\d{6}$/', $pin);

        // right pin, wrong email
        $this->post('/recovery', ['email' => 'other@example.com', 'pin' => $pin, 'password' => 'hacked!!'])
            ->assertSessionHas('pinMsg');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));

        $this->post('/recovery', ['email' => 'user@example.com', 'pin' => $pin, 'password' => 'new-password'])
            ->assertSessionHas('recovery');
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));

        // the pin is gone after use
        $this->assertDatabaseMissing('forgot_password_models', ['email' => 'user@example.com']);
    }

    public function test_reset_pin_expires(): void
    {
        $user = User::create([
            'firstname' => 'A', 'lastname' => 'B', 'email' => 'user@example.com',
            'phone' => '123', 'password' => Hash::make('old-password'),
        ]);
        $reset = ForgotPasswordModel::create(['email' => 'user@example.com', 'pin' => '123456']);
        $reset->forceFill(['created_at' => now()->subHour()])->save();

        $this->post('/recovery', ['email' => 'user@example.com', 'pin' => '123456', 'password' => 'new-password'])
            ->assertSessionHas('pinMsg');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_forgot_password_does_not_reveal_unknown_emails(): void
    {
        $this->post('/forgotpassword', ['email' => 'nobody@example.com'])
            ->assertSessionHas('successfor')
            ->assertSessionMissing('noMail');
    }

    public function test_login_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->postJson('/post-login-admin', ['email' => 'a@b.c', 'password' => 'x']);
        }
        $this->postJson('/post-login-admin', ['email' => 'a@b.c', 'password' => 'x'])->assertStatus(429);
    }
}
