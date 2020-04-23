<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

class ConfigProvider
{
	public function __invoke() : array
	{
		return [
			'dependencies' => $this->getDependencies(),
		];
	}

	public function getDependencies() : array
	{
		return [
			'factories' => [
				ResponseCookieTemplate::class => ResponseCookieTemplateFactory::class,
			],
		];
	}
}
