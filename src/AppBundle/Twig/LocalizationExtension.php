<?php

namespace AppBundle\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

/**
 * Provides Localization information (e.g. current locale, available locales)
 */
class LocalizationExtension extends \Twig_Extension
{
    /**
     * Router
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * Request stack
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    /**
     * List of the locales available in the application
     * @var array
     */
    private $availableLocales;

    /**
     * Class constructor
     * @param \Symfony\Component\Routing\RouterInterface     $router
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param array                                          $availableLocales
     */
    public function __construct(
        RouterInterface $router,
        RequestStack    $requestStack,
        array           $availableLocales)
    {
        $this->router           = $router;
        $this->requestStack     = $requestStack;
        $this->availableLocales = $availableLocales;
    }

    public function getName()
    {
        return 'localization_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('locale_get_info',   array($this, 'getLocalizationInfo')),
            new \Twig_SimpleFunction('locale_switch_url', array($this, 'getLocaleSwitchUrl')),
        );
    }

    public function getLocalizationInfo()
    {
        // Get current request
        $request = $this->requestStack->getCurrentRequest();

        return array (
            'current'   => $request->getLocale(),
            'available' => $this->availableLocales,
        );
    }

    public function getLocaleSwitchUrl($newLocale)
    {
        if (!in_array($newLocale, $this->availableLocales)) {
            // Bad locale
            throw new \Exception('Locale "' . $newLocale . '" is not available (available: ' . implode(', ', $this->availableLocales) . ').');
        }

        // Get current request
        $request = $this->requestStack->getCurrentRequest();

        // Get the current route
        $route = $request->get('_route');

        // Get the current route params
        $routeParams = $request->get('_route_params');

        // Override locale
        $routeParams['_locale'] = $newLocale;

        // Return URL with new params
        return $this->router->generate($route, $routeParams);
    }
}
