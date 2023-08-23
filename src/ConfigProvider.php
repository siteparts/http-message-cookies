<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

class ConfigProvider
{
	/**
	 * @return array{
	 *     dependencies: array{
	 *         factories: array<string, string>,
	 *     },
	 * }
	 */
	public function __invoke() : array
	{
		return [
			'dependencies' => $this->getDependencies(),
		];
	}

	/**
	 * @return array{
	 *     factories: array<string, string>,
	 * }
	 */
	public function getDependencies() : array
	{
		return [
			'factories' => [
				ResponseCookieTemplate::class => ResponseCookieTemplateFactory::class,
			],
		];
	}
}
