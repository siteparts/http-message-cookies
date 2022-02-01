<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

use DateTime;
use DateTimeZone;
use Psr\Http\Message\ResponseInterface;

use function urlencode;

class ResponseCookie
{
	/** @var string */
	private $name;

	/** @var string|null */
	private $value;

	/** @var DateTime|null */
	private $expires;

	/** @var int|null */
	private $maxAge;

	/** @var string|null */
	private $domain;

	/** @var string|null */
	private $path;

	/** @var bool */
	private $secure;

	/** @var bool */
	private $httpOnly;

	/** @var string|null */
	private $sameSite;

	public function __construct(string $name, ?string $value = null)
	{
		$this->name = $name;
		$this->value = $value;
		$this->secure = false;
		$this->httpOnly = false;
	}

	public function __toString() : string
	{
		$cookie = [urlencode($this->name) . '=' . urlencode($this->value ?? '')];

		$expires = $this->getExpires();
		if (isset($expires)) {
			$expires->setTimezone(new DateTimeZone('GMT'));
			$cookie[] = "Expires=" . $expires->format('D, d M Y H:i:s T');
		}

		if (isset($this->maxAge)) {
			$cookie[] = "Max-Age=" . $this->maxAge;
		}

		if (isset($this->domain)) {
			$cookie[] = "Domain=" . $this->domain;
		}

		if (isset($this->path)) {
			$cookie[] = "Path=" . $this->path;
		}

		if ($this->secure) {
			$cookie[] = "Secure";
		}

		if ($this->httpOnly) {
			$cookie[] = "HttpOnly";
		}

		if (isset($this->sameSite)) {
			$cookie[] = "SameSite=" . $this->sameSite;
		}

		return implode('; ', $cookie);
	}

	public function addTo(ResponseInterface $response) : ResponseInterface
	{
		return $response->withAddedHeader('Set-Cookie', (string)$this);
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function getValue() : ?string
	{
		return $this->value;
	}

	public function getExpires() : ?DateTime
	{
		return $this->expires;
	}

	public function getMaxAge() : ?int
	{
		return $this->maxAge;
	}

	public function getDomain() : ?string
	{
		return $this->domain;
	}

	public function getPath() : ?string
	{
		return $this->path;
	}

	public function isSecure() : bool
	{
		return $this->secure;
	}

	public function isHttpOnly() : bool
	{
		return $this->httpOnly;
	}

	public function getSameSite() : ?string
	{
		return $this->sameSite;
	}

	public function withValue(string $value) : self
	{
		$new = clone $this;
		$new->value = $value;
		return $new;
	}

	public function withoutValue() : self
	{
		$new = clone $this;
		$new->value = null;
		return $new;
	}

	public function withExpires(DateTime $expires) : self
	{
		$new = clone $this;
		$new->expires = $expires;
		return $new;
	}

	public function withoutExpires() : self
	{
		$new = clone $this;
		$new->expires = null;
		return $new;
	}

	public function withMaxAge(int $maxAge) : self
	{
		$new = clone $this;
		$new->maxAge = $maxAge;
		return $new;
	}

	public function withoutMaxAge() : self
	{
		$new = clone $this;
		$new->maxAge = null;
		return $new;
	}

	public function withDomain(string $domain) : self
	{
		$new = clone $this;
		$new->domain = $domain;
		return $new;
	}

	public function withoutDomain() : self
	{
		$new = clone $this;
		$new->domain = null;
		return $new;
	}

	public function withPath(string $path) : self
	{
		$new = clone $this;
		$new->path = $path;
		return $new;
	}

	public function withoutPath() : self
	{
		$new = clone $this;
		$new->path = null;
		return $new;
	}

	public function withSecure(bool $secure = true) : self
	{
		$new = clone $this;
		$new->secure = $secure;
		return $new;
	}

	public function withoutSecure() : self
	{
		$new = clone $this;
		$new->secure = false;
		return $new;
	}

	public function withHttpOnly(bool $httpOnly = true) : self
	{
		$new = clone $this;
		$new->httpOnly = $httpOnly;
		return $new;
	}

	public function withoutHttpOnly() : self
	{
		$new = clone $this;
		$new->httpOnly = false;
		return $new;
	}

	public function withSameSite(string $sameSite) : self
	{
		$new = clone $this;
		$new->sameSite = $sameSite;
		return $new;
	}

	public function withoutSameSite() : self
	{
		$new = clone $this;
		$new->sameSite = null;
		return $new;
	}
}
