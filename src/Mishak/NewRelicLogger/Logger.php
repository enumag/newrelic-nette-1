<?php

namespace Mishak\NewRelicLogger;

class Logger extends \Tracy\Logger
{

	public function log($message, $priority = self::INFO)
	{
		$res = parent::log($message, $priority);

		if ($priority === self::ERROR || $priority === self::CRITICAL) {
			if (is_array($message)) {
				$message = implode(' ', $message);
			}
			newrelic_notice_error($message);
		}

		return $res;
	}

}
