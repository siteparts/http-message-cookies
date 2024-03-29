<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

class ResponseCookieTemplate
{
	/**
	 * @var array{
	 *     expires?: \DateTime,
	 *     max_age?: int,
	 *     domain?: string,
	 *     path?: string,
	 *     secure?: bool,
	 *     http_only?: bool,
	 *     same_site?: string,
	 * }
	 */
	private $config;

	/**
	 * @param array{
	 *     expires?: \DateTime,
	 *     max_age?: int,
	 *     domain?: string,
	 *     path?: string,
	 *     secure?: bool,
	 *     http_only?: bool,
	 *     same_site?: string,
	 * } $config
	 */
	public function __construct(array $config)
	{
		$this->config = $config;
	}

	public function create(string $name, ?string $value = null) : ResponseCookie
	{
		$cookie = new ResponseCookie($name, $value);
		$config = $this->config;

		if (isset($config["expires"])) {
			$cookie = $cookie->withExpires($config["expires"]);
		}

		if (isset($config["max_age"])) {
			$cookie = $cookie->withMaxAge($config["max_age"]);
		}

		if (isset($config["domain"])) {
			$cookie = $cookie->withDomain($config["domain"]);
		}

		if (isset($config["path"])) {
			$cookie = $cookie->withPath($config["path"]);
		}

		if (isset($config["secure"])) {
			$cookie = $config["secure"]
				? $cookie->withSecure()
				: $cookie->withoutSecure();
		}

		if (isset($config["http_only"])) {
			$cookie = $config["http_only"]
				? $cookie->withHttpOnly()
				: $cookie->withoutHttpOnly();
		}

		if (isset($config["same_site"])) {
			$cookie = $cookie->withSameSite($config["same_site"]);
		}

		return $cookie;
	}
}
