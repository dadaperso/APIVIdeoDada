<?php

namespace LocDVD\APIBundle\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class TimestampType extends Type
{
	
	const FORMAT_STRING = 'Y-m-d H:i:s.u';
    const FORMAT_STRING_2 = 'Y-m-d H:i:s';

    /**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'timestamp';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return self::FORMAT_STRING;
	}
		
	/**
	 * {@inheritdoc}
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ($value === null || $value instanceof \DateTime) {
			return $value;
		}
	
		$val = \DateTime::createFromFormat(self::FORMAT_STRING, $value);
		if ( ! $val) {
            $val = \DateTime::createFromFormat(self::FORMAT_STRING_2, $value);

            if(!$val)
			    throw ConversionException::conversionFailedFormat($value, $this->getName(), self::FORMAT_STRING);
		}
	
		return $val;
	}
}