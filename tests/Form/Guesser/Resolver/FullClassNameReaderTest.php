<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser\Resolver;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\FullClassNameReader;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class FullClassNameReaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var FullClassNameReader */
    private $reader;

    /** @test */
    public function it_does_not_change_not_existing_classes()
    {
        $fullname = $this->reader->read('int', ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertEquals('int', $fullname);
    }

    /** @test */
    public function it_does_not_change_existing_full_class_classes()
    {
        $fullname = $this->reader->read(UuidInterface::class, ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertEquals(UuidInterface::class, $fullname);
    }

    /** @test */
    public function it_can_read_full_class_name_for_interface()
    {
        $fullname = $this->reader->read('UuidInterface', ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertEquals(UuidInterface::class, $fullname);
    }

    /** @test */
    public function it_can_read_full_class_name_for_class()
    {
        $fullname = $this->reader->read('Money', ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertEquals(Money::class, $fullname);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->reader = new FullClassNameReader();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->reader = null;
    }
}
