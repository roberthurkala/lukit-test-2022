<?php


namespace App\Tests\functional;


use App\Entity\Category;
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

    public function edit(FunctionalTester $I)
    {
        $I->wantTo('Edycja kategorii');

        /** @var Category $category */
        $category = $I->grabEntityFromRepository(Category::class, [
            'name' => 'Spodnie',
        ]);

        $I->amOnRoute('admin_category_edit', ['id' => $category->getId()]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->fillField('#category_name', 'Test');
        $option = $I->grabTextFrom('select option:nth-child(2)');
        $I->selectOption("select", $option);
        $I->click('Zapisz');
        $I->see('Kategoria poprawnie zapisana.', '.alert');
    }
}