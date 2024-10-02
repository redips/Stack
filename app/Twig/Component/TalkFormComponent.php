<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Twig\Component;

use App\Entity\Talk;
use App\Form\TalkType;
use Sylius\TwigHooks\LiveComponent\HookableLiveComponentTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent(template: '@SyliusBootstrapAdminUi/shared/crud/common/content/form.html.twig')]
class TalkFormComponent extends AbstractController
{
    use LiveCollectionTrait;
    use DefaultActionTrait;
    use HookableLiveComponentTrait;

    #[LiveProp]
    public Talk $initialFormData;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(TalkType::class, $this->initialFormData);
    }
}
