<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AzureStorageConnectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_azure_storage_connection()
    {
        // Mock the Azure storage disk
        Storage::fake('azure');

        // Create a fake file
        $file = UploadedFile::fake()->image('test-image.jpg');

        // Store the file in Azure Blob Storage
        $path = $file->store('test-images', 'azure');

        // Assert that the file was stored
        $this->assertNotNull($path);

        // Check if the file exists in Azure
        $this->assertTrue(Storage::disk('azure')->exists($path));

        // Optionally, you can delete the file after the test
        Storage::disk('azure')->delete($path);
    }
} 