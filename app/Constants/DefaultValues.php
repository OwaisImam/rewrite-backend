<?php

namespace App\Constants;

class DefaultValues
{
    const INACTIVE = false;
    const VERIFIED = 'verified';
    const ACTIVE = true;
    const LIMIT = 25;

    const CATEGORIES = [
        [
            "name" => "Artists",
            "description" => "Groundbreaking African American artists that shaped history.",
            "status" => true
        ],
        [
            "name" => "Scientist",
            "description" => "Highly influential scientists everyone should know about.",
            "status" => true
        ],
        [
            "name" => "Cowboys & Samurai",
            "description" => "Learn about the first Black samurai, lawmen, and cowboys.",
            "status" => true
        ],
        [
            "name" => "Engineers",
            "description" => "Black highly influential scientists everyone should know about.",
            "status" => true
        ],
        [
            "name" => "Activists",
            "description" => "Learn about the hidden figures of Black History.",
            "status" => true
        ],
        [
            "name" => "Politicians & Leaders",
            "description" => "People who paved the way for future generations.",
            "status" => true
        ],
    ];
}