<?php

/*
 * This file is part of the Monofony demo.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Tests\Behat\Page\Frontend\Pet;

use App\Tests\Behat\Service\JQueryHelper;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

class IndexPage extends SymfonyPage
{
    public function getRouteName(): string
    {
        return 'app_frontend_pet_index';
    }

    public function isPetOnList($name)
    {
        return null !== $this->getDocument()->find('css', sprintf('.header:contains("%s")', $name));
    }

    public function filterByColor($color)
    {
        $select = $this->getElement('color_filter');
        $select->selectOption($color);
        JQueryHelper::waitForAsynchronousActionsToFinish($this->getSession());
    }

    public function filterBySex($sex)
    {
        $select = $this->getElement('sex_filter');
        $select->selectOption($sex);
        JQueryHelper::waitForAsynchronousActionsToFinish($this->getSession());
    }

    public function filterBySize($size)
    {
        $label = $this->getElement('size_filter', ['%size%' => $size]);
        $label->getParent()->find('css', 'input')->check();
        JQueryHelper::waitForAsynchronousActionsToFinish($this->getSession());
    }

    public function filterByTaxon($taxonName)
    {
        $label = $this->getElement('taxon_filter', ['%taxon%' => $taxonName]);
        $label->getParent()->find('css', 'input')->check();
        JQueryHelper::waitForAsynchronousActionsToFinish($this->getSession());
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'color_filter' => '#criteria_mainColor [name="criteria[mainColor]"]',
            'sex_filter' => '#criteria_sex [name="criteria[sex]"]',
            'size_filter' => '#criteria_sizeRange .checkbox label:contains("%size%")',
            'taxon_filter' => '#criteria_taxon .checkbox label:contains("%taxon%")',
        ]);
    }
}
