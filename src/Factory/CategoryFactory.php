<?php


namespace App\Factory;


use App\Entity\Category;

class CategoryFactory
{
    public function create(): Category
    {
        return (new Category());
    }
}