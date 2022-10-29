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