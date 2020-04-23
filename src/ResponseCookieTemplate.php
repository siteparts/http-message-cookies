<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

class ResponseCookieTemplate
{
	/** @var array */
	private $config;

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

		if (isset($config["maxAge"])) {
			$cookie = $cookie->withMaxAge($config["maxAge"]);
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

		if (isset($config["httpOnly"])) {
			$cookie = $config["httpOnly"]
				? $cookie->withHttpOnly()
				: $cookie->withoutHttpOnly();
		}

		if (isset($config["sameSite"])) {
			$cookie = $cookie->withSameSite($config["sameSite"]);
		}

		return $cookie;
	}
}
