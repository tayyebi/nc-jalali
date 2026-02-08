<?php

declare(strict_types=1);

namespace Controller;

use OCA\Jalali\AppInfo\Application;
use OCA\Jalali\Controller\PageController;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase {
	public function testIndex() {
		$request = $this->createMock(IRequest::class);
		$controller = new PageController(Application::APP_ID, $request);

		$result = $controller->index();

		$this->assertInstanceOf(TemplateResponse::class, $result);
		$this->assertEquals('index', $result->getTemplateName());
		$this->assertEquals(Application::APP_ID, $result->getAppName());
	}
}
