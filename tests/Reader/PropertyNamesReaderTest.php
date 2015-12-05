<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Reader;

use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Money\Money;
use Ramsey\Uuid\Uuid;

class PropertyNamesReaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var PropertyNamesReader */
    private $reader;

    /** @test */
    public function it_can_read_names_of_properties()
    {
        $object = new ObjectWithoutMetadata(1, 0.1, 'test', new \DateTime(), Uuid::uuid4(), Money::USD(1000));

        $this->assertEquals(
            ['propertyInteger', 'propertyNumber', 'propertyString', 'propertyDateTime', 'propertyUuid', 'propertyMoney'],
            $this->reader->read($object)
        );
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->reader = new PropertyNamesReader();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->reader = null;
    }
}
