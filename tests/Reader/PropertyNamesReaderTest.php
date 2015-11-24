<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Reader;

use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Ramsey\Uuid\Uuid;

class PropertyNamesReaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var PropertyNamesReader */
    private $reader;

    /** @test */
    public function it_can_read_names_of_properties()
    {
        $object = new ObjectWithoutMetadata(1, 'test', new \DateTime(), Uuid::uuid4());

        $this->assertEquals(['propertyInteger', 'propertyString', 'propertyDateTime', 'propertyUuid'], $this->reader->read($object));
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
