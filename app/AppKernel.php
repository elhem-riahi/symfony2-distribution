<?php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
class AppKernel extends Kernel {
	public function registerBundles() {
		$bundles = array (
				new Symfony\Bundle\FrameworkBundle\FrameworkBundle (),
				new Symfony\Bundle\SecurityBundle\SecurityBundle (),
				new Symfony\Bundle\TwigBundle\TwigBundle (),
				new Symfony\Bundle\MonologBundle\MonologBundle (),
				new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle (),
				new Symfony\Bundle\AsseticBundle\AsseticBundle (),
				new Doctrine\Bundle\DoctrineBundle\DoctrineBundle (),
				new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle (),
				
				// DoctrineFixturesBundle
				new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle (),
				
				// StofDoctrineExtensionsBundle
				new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle (),
				
				// JMSTranslationBundle
				new JMS\TranslationBundle\JMSTranslationBundle (),

				// FOSJsRoutingBundle
				new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
				
				// VichUploaderBundle, KnpGaufretteBundle
				new Vich\UploaderBundle\VichUploaderBundle(),
				
				// AvalancheImagineBundle
				new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
				
				// FOSUserBundle
				new FOS\UserBundle\FOSUserBundle (),
				
				// HWIOAuthBundle
				new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
				
				// FOSMessageBundle
				new FOS\MessageBundle\FOSMessageBundle(),
				
				// PrestaSitemapBundle
				new Presta\SitemapBundle\PrestaSitemapBundle(),
				
				//Menu
				new Knp\Bundle\MenuBundle\KnpMenuBundle(),
				
				//Pager
				new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
				
				//Generator
				new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
				
				//Apllication
				new Application\SiteBundle\ApplicationSiteBundle(),
				new Application\UserBundle\ApplicationUserBundle (),
				new Application\HWIOAuthBundle\ApplicationHWIOAuthBundle(),
				new Application\MessageBundle\ApplicationMessageBundle(),
           
		);
		
		if (in_array ( $this->getEnvironment (), array (
				'dev',
				'test' 
		) )) {
			$bundles [] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle ();
			$bundles [] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle ();
			$bundles [] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle ();
		}
		
		return $bundles;
	}
	public function registerContainerConfiguration(LoaderInterface $loader) {
		$loader->load ( __DIR__ . '/config/config_' . $this->getEnvironment () . '.yml' );
	}
}
