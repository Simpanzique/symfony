<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AbstractController extends AbstractControllerBase
{
    protected function getGlobalParameters(): array
    {
        return [];
    }

    protected function renderView(string $view, array $parameters = []): string
    {
        return get_parent_class()::renderView($view, array_merge($parameters, $this->getGlobalParameters()));
    }

    protected function flashRedirect(
        string $type,
        string $message,
        string $route,
        ?array $parameters = []
    ): RedirectResponse {
        $this->addFlash($type, $message);
        return $this->redirectToRoute($route, $parameters);
    }
}