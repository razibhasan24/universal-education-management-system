<?php

namespace Tests\Feature;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InstitutionCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_institution_list_page_renders(): void
    {
        $institution = Institution::factory()->create(['name' => 'Alpha School']);

        $response = $this->get(route('admin.institutions.index'));

        $response->assertOk()
            ->assertViewIs('admin.institutions.index')
            ->assertSee('Alpha School')
            ->assertSee(route('admin.institutions.create'))
            ->assertSee(route('admin.institutions.edit', $institution));
    }

    public function test_search_field_filters_institutions(): void
    {
        Institution::factory()->create(['name' => 'Green Valley School', 'code' => 'GVS-001']);
        Institution::factory()->create(['name' => 'Bright Future College', 'code' => 'BFC-001']);

        $response = $this->get(route('admin.institutions.index', ['search' => 'Green Valley']));

        $response->assertOk()
            ->assertSee('Green Valley School')
            ->assertDontSee('Bright Future College');
    }

    public function test_empty_search_shows_all_institutions(): void
    {
        $a = Institution::factory()->create();
        $b = Institution::factory()->create();

        $response = $this->get(route('admin.institutions.index'));

        $response->assertOk()
            ->assertSee($a->name)
            ->assertSee($b->name);
    }

    public function test_search_with_no_results_shows_empty_state(): void
    {
        Institution::factory()->create(['name' => 'Green Valley School']);

        $response = $this->get(route('admin.institutions.index', ['search' => 'Nonexistent']));

        $response->assertOk()
            ->assertSee('No institutions found for')
            ->assertSee('Nonexistent')
            ->assertDontSee('Green Valley School');
    }

    public function test_pagination_renders_when_many_records(): void
    {
        Institution::factory()->count(16)->create();

        $response = $this->get(route('admin.institutions.index'));

        $response->assertOk()->assertViewHas('institutions');
    }

    public function test_create_form_renders(): void
    {
        $this->get(route('admin.institutions.create'))
            ->assertOk()
            ->assertViewIs('admin.institutions.form')
            ->assertSee('Add Institution')
            ->assertSee('name')
            ->assertSee('institution_type')
            ->assertSee('address');
    }

    public function test_store_validates_and_redirects_to_index(): void
    {
        $response = $this->post(route('admin.institutions.store'), $this->validData());

        $response->assertRedirect(route('admin.institutions.index'))
            ->assertSessionHas('success', 'Institution created successfully.');

        $this->assertDatabaseHas('institutions', ['name' => 'Greenwood School', 'code' => 'SCH-001']);
    }

    public function test_store_with_logo_upload(): void
    {
        Storage::fake('public');

        $response = $this->post(route('admin.institutions.store'), array_merge($this->validData(), [
            'logo' => UploadedFile::fake()->image('logo.png'),
        ]));

        $response->assertRedirect(route('admin.institutions.index'))
            ->assertSessionHas('success', 'Institution created successfully.');

        $this->assertNotNull(Institution::first()->logo);
    }

    public function test_store_validation_errors_are_shown(): void
    {
        $response = $this->from(route('admin.institutions.create'))
            ->post(route('admin.institutions.store'), [
                'code' => 'SCH-001',
            ]);

        $response->assertRedirect(route('admin.institutions.create'))
            ->assertSessionHasErrors(['name', 'institution_type', 'address']);
    }

    public function test_store_requires_unique_code(): void
    {
        Institution::factory()->create(['code' => 'DUPE-001']);

        $response = $this->from(route('admin.institutions.create'))
            ->post(route('admin.institutions.store'), array_merge($this->validData(), [
                'code' => 'DUPE-001',
            ]));

        $response->assertRedirect(route('admin.institutions.create'))
            ->assertSessionHasErrors(['code']);
    }

    public function test_show_page_renders(): void
    {
        $institution = Institution::factory()->create(['name' => 'Viewable School']);

        $response = $this->get(route('admin.institutions.show', $institution));

        $response->assertOk()
            ->assertViewIs('admin.institutions.show')
            ->assertSee('Viewable School')
            ->assertSee(route('admin.institutions.edit', $institution));
    }

    public function test_edit_form_renders_with_data(): void
    {
        $institution = Institution::factory()->create(['name' => 'Editable School', 'code' => 'ED-001']);

        $response = $this->get(route('admin.institutions.edit', $institution));

        $response->assertOk()
            ->assertViewIs('admin.institutions.form')
            ->assertSee('Edit Institution')
            ->assertSee('value="Editable School"', false)
            ->assertSee('value="ED-001"', false);
    }

    public function test_update_validates_and_redirects_to_index(): void
    {
        $institution = Institution::factory()->create([
            'name' => 'Old Name',
            'address' => 'Old Address',
            'code' => 'OLD-001',
        ]);

        $response = $this->put(route('admin.institutions.update', $institution), array_merge($this->validData(), [
            'name' => 'New Name',
        ]));

        $response->assertRedirect(route('admin.institutions.index'))
            ->assertSessionHas('success', 'Institution updated successfully.');

        $institution->refresh();
        $this->assertEquals('New Name', $institution->name);
    }

    public function test_update_validation_errors_are_shown(): void
    {
        $institution = Institution::factory()->create();

        $response = $this->from(route('admin.institutions.edit', $institution))
            ->put(route('admin.institutions.update', $institution), [
                'name' => '',
                'institution_type' => '',
                'address' => '',
            ]);

        $response->assertRedirect(route('admin.institutions.edit', $institution))
            ->assertSessionHasErrors(['name', 'institution_type', 'address']);
    }

    public function test_update_preserves_existing_code(): void
    {
        $institution = Institution::factory()->create(['code' => 'KEEP-001']);

        $response = $this->put(route('admin.institutions.update', $institution), array_merge($this->validData(), [
            'code' => 'KEEP-001',
            'name' => 'Updated Name',
        ]));

        $response->assertRedirect(route('admin.institutions.index'))
            ->assertSessionHas('success', 'Institution updated successfully.');

        $institution->refresh();
        $this->assertEquals('KEEP-001', $institution->code);
        $this->assertEquals('Updated Name', $institution->name);
    }

    public function test_destroy_deletes_and_redirects(): void
    {
        $institution = Institution::factory()->create(['name' => 'To Be Deleted']);

        $response = $this->delete(route('admin.institutions.destroy', $institution));

        $response->assertRedirect(route('admin.institutions.index'))
            ->assertSessionHas('success', 'Institution deleted successfully.');

        $this->assertModelMissing($institution);
        $this->assertDatabaseMissing('institutions', ['id' => $institution->id]);
    }

    private function validData(): array
    {
        return [
            'name' => 'Greenwood School',
            'institution_type' => 'school',
            'code' => 'SCH-001',
            'eiin' => '123456',
            'email' => 'greenwood@example.com',
            'phone' => '1234567890',
            'address' => '123 Main Street, Springfield',
            'status' => 'active',
        ];
    }
}