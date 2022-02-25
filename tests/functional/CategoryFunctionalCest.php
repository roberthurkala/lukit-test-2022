<?php


namespace App\Tests\functional;


use App\Tests\_support\Page\CategoryPage;
use App\Tests\FunctionalTester;
use Codeception\Util\HttpCode;

/**
 * vendor/bin/codecept run functional ProductFunctionalCest
 */
class CategoryFunctionalCest
{
    public function index(FunctionalTester $I)
    {
        $I->wantTo('Lista kategori');
        $I->amOnRoute('admin_category_index');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeNumberOfElements('tbody tr', 6);
    }

    public function add(FunctionalTester $I)
    {
        $I->wantTo('Dodawanie kategorii');
        $I->amOnRoute('admin_category_new');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->fillField(CategoryPage::FIELD_NAME, 'Skarpetki');
        $I->click('Zapisz');
        $I->amOnRoute('admin_category_index');
        $I->seeNumberOfElements('tbody tr', 7);
    }
}