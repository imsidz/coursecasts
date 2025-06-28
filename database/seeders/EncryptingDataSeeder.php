<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncryptingDataSeeder extends BigDataSecuritySeeder
{
    protected int $discussionId = 487;
    protected string $title = 'Best Practices for Encrypting Data In-Transit and At-Rest';
    protected array $tagNames = ['encryption', 'data-in-transit', 'data-at-rest'];
    protected string $postFile = 'encrypting_data_posts.php';
}