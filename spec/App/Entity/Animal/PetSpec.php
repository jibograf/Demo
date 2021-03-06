<?php

namespace spec\App\Entity\Animal;

use App\Entity\Animal\Pet;
use App\Entity\Animal\PetImage;
use App\PetStates;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

class PetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Pet::class);
    }

    function it_has_no_default_id(): void
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_default_name()
    {
        $this->getName()->shouldReturn(null);
    }

    function it_has_a_name()
    {
        $this->setName('Mickey');
        $this->getName()->shouldReturn('Mickey');
    }

    function it_has_no_default_slug()
    {
        $this->getSlug()->shouldReturn(null);
    }

    function it_has_a_slug()
    {
        $this->setSlug('Yes');
        $this->getSlug()->shouldReturn('Yes');
    }

    function it_has_no_default_description()
    {
        $this->getDescription()->shouldReturn(null);
    }

    function it_has_a_description()
    {
        $this->setDescription('Yes');
        $this->getDescription()->shouldReturn('Yes');
    }

    function it_has_no_default_size()
    {
        $this->getSize()->shouldReturn(null);
    }

    function it_has_a_size()
    {
        $this->setSize(0.86);
        $this->getSize()->shouldReturn(0.86);
    }

    function it_has_no_default_size_unit()
    {
        $this->getSizeUnit()->shouldReturn(null);
    }

    function it_has_a_size_unit()
    {
        $this->setSizeUnit('centimeter');
        $this->getSizeUnit()->shouldReturn('centimeter');
    }

    function it_has_no_default_main_color()
    {
        $this->getMainColor()->shouldReturn(null);
    }

    function it_has_a_main_color()
    {
        $this->setMainColor('Zinzolin');
        $this->getMainColor()->shouldReturn('Zinzolin');
    }

    function it_initializes_image_collection_by_default()
    {
        $this->getImages()->shouldHaveType(Collection::class);
    }

    function it_adds_images(PetImage $image)
    {
        $image->setPet($this)->shouldBeCalled();

        $this->addImage($image);

        $this->hasImage($image)->shouldReturn(true);
    }

    function it_removes_images(PetImage $image)
    {
        $this->addImage($image);

        $image->setPet(null)->shouldBeCalled();

        $this->removeImage($image);

        $this->hasImage($image)->shouldReturn(false);
    }

    function it_has_no_first_image_by_default(): void
    {
        $this->getFirstImage()->shouldReturn(null);
    }

    function it_can_get_first_image(PetImage $firstImage, PetImage $secondImage): void
    {
        $this->addImage($firstImage);
        $this->addImage($secondImage);

        $this->getFirstImage()->shouldReturn($firstImage);
    }

    function it_has_no_default_taxon()
    {
        $this->getTaxon()->shouldReturn(null);
    }

    function it_has_a_taxon(TaxonInterface $taxon)
    {
        $this->setTaxon($taxon);
        $this->getTaxon()->shouldReturn($taxon);
    }

    function it_has_no_default_sex()
    {
        $this->getSex()->shouldReturn(null);
    }

    function its_sex_is_mutable()
    {
        $this->setSex('Male');
        $this->getSex()->shouldReturn('Male');
    }

    function it_has_no_default_birth_date()
    {
        $this->getBirthDate()->shouldReturn(null);
    }

    function it_has_a_birth_date(\DateTime $dateTime)
    {
        $this->setBirthDate($dateTime);
        $this->getBirthDate()->shouldReturn($dateTime);
    }

    function it_has_no_age_by_default()
    {
        $this->getAge()->shouldReturn(null);
    }

    function it_can_have_an_age()
    {
        $birthDate = new \DateTime('4 years ago');
        $this->setBirthDate($birthDate);

        $this->getAge()->format('%y')->shouldReturn('4');
    }

    function it_should_be_new_by_default()
    {
        $this->getStatus()->shouldReturn(PetStates::NEW);
    }

    function it_has_a_status()
    {
        $this->setStatus(PetStates::BOOKED);
        $this->getStatus()->shouldReturn(PetStates::BOOKED);
    }

    function it_should_be_disabled_by_default()
    {
        $this->getEnabled()->shouldReturn(false);
    }

    function it_could_be_enabled()
    {
        $this->setEnabled(true);
        $this->getEnabled()->shouldReturn(true);
    }
}
