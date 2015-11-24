<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Form\DataTransformer;

use Lucaszz\SymfonyGenericForm\Form\DataTransformer\UuidToStringTransformer;
use Lucaszz\SymfonyGenericForm\Tests\UnitTestCase;
use Ramsey\Uuid\Uuid;

class UuidToStringTransformerTest extends UnitTestCase
{
    /** @var UuidToStringTransformer */
    private $transformer;

    /** @test */
    public function it_transforms_uuid_to_string()
    {
        $uuid = Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12');

        $transformed = $this->transformer->transform($uuid);

        $this->assertEquals('b771a92d-57a3-4442-ad85-165000c07f12', $transformed);
    }

    /** @test */
    public function it_transforms_null_to_string()
    {
        $transformed = $this->transformer->transform(null);

        $this->assertEquals('', $transformed);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function it_can_not_transform_non_uuid()
    {
        $this->transformer->transform(new \stdClass());
    }

    /** @test */
    public function it_reserve_transforms_string_to_uuid()
    {
        $uuid = Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12');

        $transformed = $this->transformer->reverseTransform('b771a92d-57a3-4442-ad85-165000c07f12');

        $this->assertUuidEquals($uuid, $transformed);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function it_can_not_reserve_transforms_invalid_uuid_string_to_uuid()
    {
        $this->transformer->reverseTransform('invalid-uuid-string');
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->transformer = new UuidToStringTransformer();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->transformer = null;
    }
}
