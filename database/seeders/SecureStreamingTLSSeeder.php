<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecureStreamingTLSSeeder extends BigDataSecuritySeeder
{
    protected int $discussionId = 497;
    protected string $title = 'Securing Real-Time Streaming Data with TLS';
    protected array $tagNames = ['tls', 'real-time-streaming', 'data-security'];
    protected string $postFile = 'secure_streaming_tls_posts.php';
}