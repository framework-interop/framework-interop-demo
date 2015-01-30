<?php

namespace Acme\FrontendModule;

use Acme\Blog\Article\ArticleRepository;
use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Interop\Framework\Silex\AbstractSilexModule;
use Interop\Framework\Silex\SilexFrameworkModule;
use Psr\Log\LoggerInterface;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Stack\UrlMap;
use Mouf\StackPhp\SilexMiddleware;
use Interop\Framework\HttpModuleInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The frontend module is a Silex application.
 */
class FrontendModule extends AbstractSilexModule
{
	
    public function getName()
    {
        return 'frontend';
    }

	/* (non-PHPdoc)
	 * @see \Interop\Framework\ModuleInterface::init()
	 */
	public function init() {
		$app = $this->getSilexApp();

		$app['debug'] = true;

		// Views
		$app->register(new TwigServiceProvider(), [
			'twig.path' => __DIR__ . '/views',
		]);

		// Home
		$app->get('/', function (Application $app) {
			/** @var ArticleRepository $articleRepository */
			$articleRepository = $this->rootContainer->get(ArticleRepository::class);
			$count = count($articleRepository->getAll());

			$this->rootContainer->get(LoggerInterface::class)->debug('Someone was on the home page');

			return $app['twig']->render('home.twig', ['articleCount' => $count]);
		});

	}
}
