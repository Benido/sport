<?php

//The sample perms that will be added to the Structure classes
$perms = [
  [
    "members_read"=> false,
    "members_write"=> false,
    "members_add"=> true,
    "members_products_add"=> false,
    "members_payment_schedules"=> false,
    "members_subscription_read"=> true,
    "payment_day_read"=> true,
    "members_statistics_read"=> true,
    "payment_schedules_read"=> false,
    "payment_schedules_write"=> false
  ],
  [
      "members_read"=> false,
    "members_write"=> true,
    "members_add"=> true,
    "members_products_add"=> false,
    "members_payment_schedules"=> false,
    "members_subscription_read"=> false,
    "payment_day_read"=> true,
    "members_statistics_read"=> true,
    "payment_schedules_read"=> false,
    "payment_schedules_write"=> false
  ],
  [
      "members_read"=> true,
    "members_write"=> true,
    "members_add"=> false,
    "members_products_add"=> false,
    "members_payment_schedules"=> true,
    "members_subscription_read"=> false,
    "payment_day_read"=> false,
    "members_statistics_read"=> false,
    "payment_schedules_read"=> false,
    "payment_schedules_write"=> false
  ],
  [
      "members_read"=> true,
    "members_write"=> false,
    "members_add"=> false,
    "members_products_add"=> false,
    "members_payment_schedules"=> true,
    "members_subscription_read"=> true,
    "payment_day_read"=> true,
    "members_statistics_read"=> true,
    "payment_schedules_read"=> true,
    "payment_schedules_write"=> true
  ],
  [
      "members_read"=> true,
    "members_write"=> true,
    "members_add"=> true,
    "members_products_add"=> false,
    "members_payment_schedules"=> true,
    "members_subscription_read"=> false,
    "payment_day_read"=> true,
    "members_statistics_read"=> false,
    "payment_schedules_read"=> true,
    "payment_schedules_write"=> false
  ],
  [
      "members_read"=> false,
    "members_write"=> true,
    "members_add"=> false,
    "members_products_add"=> true,
    "members_payment_schedules"=> false,
    "members_subscription_read"=> false,
    "payment_day_read"=> true,
    "members_statistics_read"=> false,
    "payment_schedules_read"=> false,
    "payment_schedules_write"=> false
  ],
    [
        "members_read"=> false,
        "members_write"=> false,
        "members_add"=> false,
        "members_products_add"=> true,
        "members_payment_schedules"=> true,
        "members_subscription_read"=> false,
        "payment_day_read"=> true,
        "members_statistics_read"=> false,
        "payment_schedules_read"=> false,
        "payment_schedules_write"=> false
    ],
    [
        "members_read"=> false,
        "members_write"=> true,
        "members_add"=> false,
        "members_products_add"=> true,
        "members_payment_schedules"=> true,
        "members_subscription_read"=> false,
        "payment_day_read"=> true,
        "members_statistics_read"=> true,
        "payment_schedules_read"=> false,
        "payment_schedules_write"=> false
    ]
];

function randomPerm () {
    return [
        "members_read"=> mt_rand(0, 1),
        "members_write"=> mt_rand(0, 1),
        "members_add"=> mt_rand(0, 1),
        "members_products_add"=> mt_rand(0, 1),
        "members_payment_schedules"=> mt_rand(0, 1),
        "members_subscription_read"=> mt_rand(0, 1),
        "payment_day_read"=> mt_rand(0, 1),
        "members_statistics_read"=> mt_rand(0, 1),
        "payment_schedules_read"=> mt_rand(0, 1),
        "payment_schedules_write"=> mt_rand(0, 1)
    ];
}