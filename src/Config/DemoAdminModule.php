<?php
namespace SeleniaTemplates\DemoAdmin\Config;

use Electro\Interfaces\Http\Shared\ApplicationRouterInterface;
use Electro\Interfaces\KernelInterface;
use Electro\Interfaces\ModuleInterface;
use Electro\Kernel\Config\KernelSettings;
use Electro\Kernel\Lib\ModuleInfo;
use Electro\Navigation\Config\NavigationSettings;
use Electro\Plugins\Matisse\Config\MatisseSettings;
use Electro\Profiles\WebProfile;
use Electro\ViewEngine\Config\ViewEngineSettings;


class DemoAdminModule implements ModuleInterface
{
  static function getCompatibleProfiles ()
  {
    return [WebProfile::class];
  }

  static function startUp (KernelInterface $kernel, ModuleInfo $moduleInfo)
  {
    $kernel->onConfigure (
      function (KernelSettings $app, ApplicationRouterInterface $router, NavigationSettings $navigationSettings,
                ViewEngineSettings $viewEngineSettings, MatisseSettings $matisseSettings)
      use ($moduleInfo) {
        $app->name    = 'demoapp';       // session cookie name
        $app->appName = '$DEMO_APP';     // default page title; also displayed on title bar (optional)
        $app->title   = '@ - $DEMO_APP'; // @ = page title
        $viewEngineSettings->registerViews ($moduleInfo);
        $matisseSettings->registerMacros ($moduleInfo);
        $router->add (Routes::class);
        $navigationSettings->registerNavigation (Navigation::class);
      });
  }

}
