<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Core;

use Monolog;

/**
 * Logger container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Logger extends Forge
{
	protected static $_config = 'logger';

	public static function forge($instance = 'default', array $handlers = array())
	{
		$logger = new Monolog\Logger($instance);
		$handlers = \Arr::merge(\Config::get('logger.'.$instance, array()), $handlers);

		foreach ($handlers as $handler)
		{
			$handler = \Fuel::value($handler);
			$logger->pushHandler($handler);
		}

		return static::newInstance($instance, $logger);
	}
}