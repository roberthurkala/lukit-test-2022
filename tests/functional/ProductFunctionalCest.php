<?php

namespace App\Tests\functional;

use App\Tests\_support\Page\ProductPage;
use App\Tests\FunctionalTester;
use Codeception\Util\HttpCode;

/**
 * vendor/bin/codecept run functional ProductFunctionalCest
 */
class ProductFunctionalCest
{
    public function index(FunctionalTester $I)
    {
        $I->wantTo('Lista produktów');
        $I->amOnRoute('admin_product_index');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeNumberOfElements('tbody tr', 6);
    }

    public function add(FunctionalTester $I)
    {
        $I->wantTo('Dodawanie produktów');
        $I->amOnRoute('admin_product_new');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->fillField(ProductPage::FIELD_NAME, 'Skarpetki');
        $I->fillField(ProductPage::FIELD_DESCRIPTION, 'Zielone rozmiar 12');
        $I->fillField(ProductPage::FIELD_PRICE, '12');
        $I->selectOption(ProductPage::FIELD_CATEGORY, 'Spodnie');
        $I->click('Zapisz');
        $I->amOnRoute('admin_product_index');
        $I->seeNumberOfElements('tbody tr', 7);
    }
}