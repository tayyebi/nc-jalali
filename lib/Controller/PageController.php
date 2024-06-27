<?php

declare(strict_types=1);

namespace OCA\Jalali\Controller;

use OCA\Jalali\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\Util;
use OCP\AppFramework\Http\Attribute\FrontpageRoute;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\Attribute\NoCSRFRequired;
use OCP\AppFramework\Http\Attribute\OpenAPI;
use OCP\AppFramework\Http\TemplateResponse;

/**
 * @psalm-suppress UnusedClass
 */
class PageController extends Controller {
	#[NoCSRFRequired]
	#[NoAdminRequired]
	#[OpenAPI(OpenAPI::SCOPE_IGNORE)]
	#[FrontpageRoute(verb: 'GET', url: '/')]
	public function index(): TemplateResponse {

		if ($getParameter === null) {
	            $getParameter = '';
	        }

	        // The TemplateResponse loads the 'main.php'
	        // defined in our app's 'templates' folder.
	        // We pass the $getParameter variable to the template
	        // so that the value is accessible in the template.
	        return new TemplateResponse(
	            Application::APP_ID,
	            'main',
	            ['myMessage' => $getParameter]
	        );

//		return new TemplateResponse(
//			Application::APP_ID,
//			'index',
//		);
	}
}
