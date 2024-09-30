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

namespace App\Story;

use App\Factory\SpeakerFactory;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Zenstruck\Foundry\Story;

final class DefaultSpeakersStory extends Story
{
    public function __construct(
        #[Autowire(value: '%kernel.project_dir%/tests/Resources/avatars/speakers')]
        private string $avatarBaseDir,
    ) {
    }

    public function build(): void
    {
        SpeakerFactory::new()
            ->withFirstName('Kévin')
            ->withLastName('Dunglas')
            ->withCompanyName('Les-Tilleuls.coop')
            ->withAvatar($this->avatarBaseDir . '/kevin-dunglas.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Przemysław')
            ->withLastName('Połeć')
            ->withCompanyName('Sylius')
            ->withAvatar($this->avatarBaseDir . '/przemyslaw-polec.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Thomas')
            ->withLastName('di Luccio')
            ->withCompanyName('Platform.sh')
            ->withAvatar($this->avatarBaseDir . '/thomas-di-luccio.jpg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Mikołaj')
            ->withLastName('Król')
            ->withCompanyName('Sylius')
            ->withAvatar($this->avatarBaseDir . '/mikolaj-krol.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Viorel')
            ->withLastName('Tudor')
            ->withCompanyName('Freshful, eMAG')
            ->withAvatar($this->avatarBaseDir . '/viorel-tudor.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Guillaume')
            ->withLastName('Loulier')
            ->withCompanyName('SensioLabs')
            ->withAvatar($this->avatarBaseDir . '/guillaume-loulier.jpg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Ksenia')
            ->withLastName('Zvereva')
            ->withCompanyName('Mollie')
            ->withAvatar($this->avatarBaseDir . '/ksenia-zvereva.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Loïc')
            ->withLastName('Frémont')
            ->withCompanyName('Akawaka')
            ->withAvatar($this->avatarBaseDir . '/loic-fremont.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Kuba')
            ->withLastName('Zwoliński')
            ->withCompanyName('Snowdog')
            ->withAvatar($this->avatarBaseDir . '/kuba-zwolinski.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Mateusz')
            ->withLastName('Zalewski')
            ->withCompanyName('Commerce Weavers')
            ->withAvatar($this->avatarBaseDir . '/mateusz-zalewski.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Łukasz')
            ->withLastName('Chruściel')
            ->withCompanyName('Commerce Weavers')
            ->withAvatar($this->avatarBaseDir . '/lukasz-chrusciel.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Romain')
            ->withLastName('Ruaud')
            ->withCompanyName('Smile - Gally')
            ->withAvatar($this->avatarBaseDir . '/romain-ruaud.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Zrinka')
            ->withLastName('Dedic')
            ->withCompanyName('Locastic d.o.o')
            ->withAvatar($this->avatarBaseDir . '/zrinka-dedic.jpg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Jacques')
            ->withLastName('Bodin-Hullin')
            ->withCompanyName('Monsieur Biz')
            ->withAvatar($this->avatarBaseDir . '/jacques-bodin-hullin.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Loïc')
            ->withLastName('Caillieux')
            ->withCompanyName('Emagma')
            ->withAvatar($this->avatarBaseDir . '/loic-caillieux.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Francis')
            ->withLastName('Hilaire')
            ->withCompanyName('Harman International')
            ->withAvatar($this->avatarBaseDir . '/hilaire-francis.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Manuele')
            ->withLastName('Menozzi')
            ->withCompanyName('Webgriffe')
            ->withAvatar($this->avatarBaseDir . '/manuele-menozzi.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Luca')
            ->withLastName('Gallinari')
            ->withCompanyName('Webgriffe')
            ->withAvatar($this->avatarBaseDir . '/luca-gallinari.jpg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Stéphane')
            ->withLastName('Decock')
            ->withCompanyName('Sylius Core Team Member, Decock Technology')
            ->withAvatar($this->avatarBaseDir . '/stephane-decock.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Stephan')
            ->withLastName('Hochdörfer')
            ->withCompanyName('bitExpert AG')
            ->withAvatar($this->avatarBaseDir . '/stephan-hochdorfer.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Joachim')
            ->withLastName('Løvgaard')
            ->withCompanyName('Sylius Core Team Member, Setono')
            ->withAvatar($this->avatarBaseDir . '/joachim-lovgaard.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Gregor')
            ->withLastName('Šink')
            ->withCompanyName('Creatim d.o.o.')
            ->withAvatar($this->avatarBaseDir . '/gregor-sink.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Hélèna')
            ->withLastName('Gravelier')
            ->withCompanyName('Synolia')
            ->withAvatar($this->avatarBaseDir . '/helena-gravelier.jpeg')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Julien')
            ->withLastName('Jacottet')
            ->withCompanyName('Mezcalito')
            ->withAvatar($this->avatarBaseDir . '/julien-jacottet.png')
            ->create()
        ;
    }
}
