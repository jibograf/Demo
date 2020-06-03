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

namespace App\Tests\Behat\Page\Backend\Taxon;

use Monofony\Bundle\AdminBundle\Tests\Behat\Crud\AbstractCreatePage;
use Monofony\Bundle\AdminBundle\Tests\Behat\Crud\CreatePageInterface;
use Sylius\Component\Core\Model\TaxonInterface;

final class CreatePage extends AbstractCreatePage implements CreatePageInterface
{
    public function getRouteName(): string
    {
        return 'sylius_backend_taxon_create';
    }

    public function countTaxons(): int
    {
        return count($this->getLeaves());
    }

    public function countTaxonsByName(string $name): int
    {
        $matchedLeavesCounter = 0;
        $leaves = $this->getLeaves();
        foreach ($leaves as $leaf) {
            if (strpos($leaf->getText(), $name) !== false) {
                ++$matchedLeavesCounter;
            }
        }

        return $matchedLeavesCounter;
    }

    public function specifyCode(?string $code): void
    {
        $this->getElement('code')->setValue($code);
    }

    public function specifyDescription(?string $description): void
    {
        $this->getElement('description')->setValue($description);
    }

    public function specifyName(?string $name): void
    {
        $this->getElement('name')->setValue($name);
    }


    public function specifySlug(?string $slug): void
    {
        $this->getElement('slug')->setValue($slug);
    }

    public function getLeaves(TaxonInterface $parentTaxon = null): array
    {
        return $this->getDocument()->findAll('css', '.sylius-tree__item');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'code' => '#sylius_taxon_code',
            'description' => '#sylius_taxon_translations_en_US_description',
            'name' => '#sylius_taxon_translations_en_US_name',
            'slug' => '#sylius_taxon_translations_en_US_slug',
        ]);
    }
}
