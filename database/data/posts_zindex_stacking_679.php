<?php

return [
    [
        'body' => 'What does z-index actually represent?',
        'user_id' => 180,
        'visible' => true,
        'created_at' => '2025-07-21 08:00:00',
        'updated_at' => '2025-07-21 08:00:00',
    ],
    [
        'body' => 'Why do some z-index values not work as expected?',
        'user_id' => 181,
        'visible' => true,
        'created_at' => '2025-07-21 08:15:00',
        'updated_at' => '2025-07-21 08:15:00',
    ],
    [
        'body' => 'How does stacking context form in CSS?',
        'user_id' => 182,
        'visible' => true,
        'created_at' => '2025-07-21 08:30:00',
        'updated_at' => '2025-07-21 08:30:00',
    ],
    [
        'body' => 'What elements create a new stacking context?',
        'user_id' => 183,
        'visible' => true,
        'created_at' => '2025-07-21 08:45:00',
        'updated_at' => '2025-07-21 08:45:00',
    ],
    [
        'body' => 'Why does z-index not affect flex items sometimes?',
        'user_id' => 184,
        'visible' => true,
        'created_at' => '2025-07-21 09:00:00',
        'updated_at' => '2025-07-21 09:00:00',
    ],
    [
        'body' => 'Does transform affect stacking context?',
        'user_id' => 185,
        'visible' => true,
        'created_at' => '2025-07-21 09:15:00',
        'updated_at' => '2025-07-21 09:15:00',
    ],
    [
        'body' => 'How to debug z-index issues in DevTools?',
        'user_id' => 186,
        'visible' => true,
        'created_at' => '2025-07-21 09:30:00',
        'updated_at' => '2025-07-21 09:30:00',
    ],
    [
        'body' => 'What’s the default stacking order in HTML?',
        'user_id' => 187,
        'visible' => true,
        'created_at' => '2025-07-21 09:45:00',
        'updated_at' => '2025-07-21 09:45:00',
    ],
    [
        'body' => 'Why does z-index require positioning?',
        'user_id' => 188,
        'visible' => true,
        'created_at' => '2025-07-21 10:00:00',
        'updated_at' => '2025-07-21 10:00:00',
    ],
    [
        'body' => 'Can z-index be negative?',
        'user_id' => 189,
        'visible' => true,
        'created_at' => '2025-07-21 10:15:00',
        'updated_at' => '2025-07-21 10:15:00',
    ],
    // 15 posts for July 22
    ...array_map(function ($i) {
        return [
            'body' => "Understanding stacking behavior in complex layouts #{$i}",
            'user_id' => rand(190, 205),
            'visible' => false,
            'created_at' => "2025-07-22 " . str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00',
            'updated_at' => now(),
        ];
    }, range(11, 25)),
    // 15 posts for July 24
    ...array_map(function ($i) {
        return [
            'body' => "Practical use of z-index in UI components #{$i}",
            'user_id' => rand(206, 220),
            'visible' => false,
            'created_at' => "2025-07-24 " . str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00',
            'updated_at' => now(),
        ];
    }, range(26, 40)),
];
