<?php

//The sample perms that will be added to the Structure classes


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