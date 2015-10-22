<?php

namespace LocDVD\APIBundle\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

class TimestampType extends Type
{
	
	const FORMAT_STRING = 'Y-m-d H:i:s.u';
	
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
			throw ConversionException::conversionFailedFormat($value, $this->getName(), self::FORMAT_STRING);
		}
	
		return $val;
	}
}