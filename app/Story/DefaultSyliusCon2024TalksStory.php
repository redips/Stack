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

use App\Enum\Track;
use App\Factory\ConferenceFactory;
use App\Factory\SpeakerFactory;
use App\Factory\TalkFactory;
use Zenstruck\Foundry\Story;

final class DefaultSyliusCon2024TalksStory extends Story
{
    public function build(): void
    {
        $this->createBizTalks();
        $this->createTechOneTalks();
        $this->createTechTwoTalks();
    }

    private function createBizTalks(): void
    {
        TalkFactory::new()
            ->withTitle('The Missing Piece in the Developer\'s Toolkit: Communication')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Stéphane', 'lastName' => 'Decock']))
            ->withDescription(
                <<<'TEXT'
                This talk will explore the vital role of communication in software development. Stéphane will discuss how effective communication can bridge the gap between developers and stakeholders, reduce misunderstandings, and lead to more successful projects. He will also provide techniques to help developers articulate complex ideas clearly and understand stakeholder needs better.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 10:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 10:45:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('TBA')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Hélèna', 'lastName' => 'Gravelier']))
            ->withDescription(
                <<<'TEXT'
                Details of this presentation will be announced soon.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 11:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 11:45:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('TBA')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Przemysław', 'lastName' => 'Połeć']))
            ->withDescription(
                <<<'TEXT'
                Details of this presentation will be announced soon.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 12:30:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Transforming the Retail Industry with Sylius')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Zrinka', 'lastName' => 'Dedic']))
            ->withDescription(
                <<<'TEXT'
                Zrinka will share how Locastic utilized Sylius to transform the retail operations of Tommy.hr. The presentation will cover the specific strategies and changes implemented using Sylius to improve efficiency and operational effectiveness in the retail sector.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:45:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 13:15:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Building a Sustainable Accessibility Program for Your Team')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Kuba', 'lastName' => 'Zwoliński']))
            ->withDescription(
                <<<'TEXT'
                Kuba will outline the key elements needed to create a sustainable accessibility program within an organization. He will focus on developing an accessibility culture, integrating accessibility into your workflows from the beginning, and preparing for upcoming European regulations like the European Accessibility Act.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 15:45:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 16:15:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Multiple Webshops with Case-Specific Sales Processes on One Sylius Instance - A Case Study')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Gregor', 'lastName' => 'Šink']))
            ->withDescription(
                <<<'TEXT'
                Gregor will present a case study of DZS, a Slovenian publishing house, which integrated multiple webshops into a single Sylius instance. The talk will cover how this consolidation catered to different customer needs (B2C, B2B, CMS) under one platform, providing a unique experience for each user while reducing operating expenses.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 16:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 17:15:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('When Sylius Meets Beer: A Refresh That’s Brewing Up a Storm')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Julien', 'lastName' => 'Jacottet']))
            ->withDescription(
                <<<'TEXT'
                Julien, CTO of Mezcalito, will take you through the journey of Une Petite Mousse, a popular online beer shop, and their successful transition from an internal solution to Sylius. He will share the challenges they overcame, the innovative solutions they developed, and how Sylius helped brew up tangible, sparkling results.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 17:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 18:00:00'))
            ->withTrack(Track::BIZ)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;
    }

    private function createTechOneTalks(): void
    {
        TalkFactory::new()
            ->withTitle('Create World-Class Sylius Plugins')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Joachim', 'lastName' => 'Løvgaard']))
            ->withDescription(
                <<<'TEXT'
                Joachim will share his extensive experience in creating Sylius plugins and bundles. He will discuss the best practices for plugin development, focusing on aspects such as code quality, dependency management, and optimizing the developer experience to build effective and maintainable plugins.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 10:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 10:45:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Sylius Beyond E-commerce: Building the Perfect WordPress Competitor')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Jacques', 'lastName' => 'Bodin-Hullin']))
            ->withDescription(
                <<<'TEXT'
                Jacques will introduce the NoCommerce plugin, which transforms Sylius into a robust framework for building a variety of websites beyond e-commerce. He will explain how this plugin can make Sylius a versatile alternative to WordPress for non-commercial sites, detailing the integration process and unique benefits.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 11:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 11:45:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Sylius Payment Overview and Future')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Francis', 'lastName' => 'Hilaire']))
            ->withDescription(
                <<<'TEXT'
                Francis will provide a comprehensive overview of the Sylius payment system, focusing on its history and upcoming developments in Sylius 2.0. He will discuss the challenges faced in building the system and how new features will improve payment handling and integration.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 12:30:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Adapting Price Calculation to B2B Needs')
            ->withSpeakers(
                SpeakerFactory::findOrCreate(['firstName' => 'Luca', 'lastName' => 'Gallinari']),
                SpeakerFactory::findOrCreate(['firstName' => 'Manuele', 'lastName' => 'Menozzi']),
            )
            ->withDescription(
                <<<'TEXT'
                Luca and Manuele will explain how to customize the Sylius Price Calculator for complex B2B pricing models. The talk will cover practical examples of how to implement these changes and ensure accurate pricing through automated testing.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:45:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 13:30:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Beyond One-Size-Fits-All: Unlocking User Value with Profilation and Adaptable Architecture')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Viorel', 'lastName' => 'Tudor']))
            ->withDescription(
                <<<'TEXT'
                Viorel will discuss how Freshful leverages Sylius to create personalized, consumer-centric solutions. The presentation will cover how detailed user profiling and a modular architecture allow for tailored e-grocery experiences that enhance customer satisfaction and engagement.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 15:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 16:15:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Handling Background Processing in Sylius')
            ->withSpeakers(
                SpeakerFactory::findOrCreate(['firstName' => 'Łukasz', 'lastName' => 'Chruściel']),
                SpeakerFactory::findOrCreate(['firstName' => 'Mateusz', 'lastName' => 'Zalewski']),
            )
            ->withDescription(
                <<<'TEXT'
                Łukasz and Mateusz will explore different methods for managing background tasks in Sylius applications. They will cover basic techniques using Symfony console commands, more advanced approaches with Symfony Messenger, and sophisticated strategies for high availability and fault tolerance.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 16:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 17:15:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Building a Semantic Search Experience Using PHP and Meilisearch')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Guillaume', 'lastName' => 'Loulier']))
            ->withDescription(
                <<<'TEXT'
                Guillaume will demonstrate how to build a semantic search experience using PHP and Meilisearch. He will cover how to leverage recent advancements in machine learning and search engine technology to improve search accuracy and user experience in your applications.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 17:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 18:00:00'))
            ->withTrack(Track::TECH_ONE)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;
    }

    private function createTechTwoTalks(): void
    {
        TalkFactory::new()
            ->withTitle('Boost Your Sylius Frontend with Hotwire, aka Symfony UX')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Loïc', 'lastName' => 'Caillieux']))
            ->withDescription(
                <<<'TEXT'
                Loïc will showcase how to enhance the frontend of your Sylius application using Hotwire and Symfony UX. He will provide live examples of how these tools can improve the user interface and experience, focusing on making the frontend more dynamic and responsive.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 10:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 10:45:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Admin Panel (R)evolution for Your Symfony Projects')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Loïc', 'lastName' => 'Frémont']))
            ->withDescription(
                <<<'TEXT'
                Loïc will cover the evolution of the Sylius admin panel, from its initial use of Bootstrap to the current integration with tools like the Sylius Grid component and Twig Hooks. He will discuss how these changes improve the admin panel's functionality and how they can be applied to any Symfony project.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 11:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 11:45:00'))
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Prepping for Black Friday: Improve, Scale, and Stress Test Your Sylius App')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Thomas', 'lastName' => 'di Luccio']))
            ->withDescription(
                <<<'TEXT'
                Thomas will provide strategies for preparing your Sylius application for peak traffic during events like Black Friday. He will explain how to use tools like Blackfire and Platform.sh for performance optimization and load testing to ensure your app remains stable under high demand.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 12:30:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Crafting an Open Source Product Discovery Solution')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Romain', 'lastName' => 'Ruaud']))
            ->withDescription(
                <<<'TEXT'
                Romain will share the story behind the inception and development of Gally, an open-source search engine solution for product discovery. You’ll learn how to build a REST/GraphQL layer on top of Elasticsearch using API Platform and Symfony. Romain will cover key technical principles, such as Elasticsearch index abstraction, automatic mapping computation, and GraphQL stitching. Additionally, you'll discover how Gally can be leveraged in a Composable Commerce approach, including various architectural use cases like Headless Sylius, Headful Sylius, and external applications, such as vendor tablets.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 12:45:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 13:30:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('TBA')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Kévin', 'lastName' => 'Dunglas']))
            ->withDescription(
                <<<'TEXT'
                Details of this presentation will be announced soon.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 15:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 16:15:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Simplifying Sylius Containerization with DDEV')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Stephan', 'lastName' => 'Hochdörfer']))
            ->withDescription(
                <<<'TEXT'
                Stephan will demonstrate how DDEV simplifies the use of Docker and Docker Compose for Sylius applications. The talk will include a step-by-step guide on installing and integrating DDEV into a Sylius project and how to extend its capabilities for better development workflows.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 15:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 17:15:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Developer Docs: The write way to streamline project')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Ksenia', 'lastName' => 'Zvereva']))
            ->withDescription(
                <<<'TEXT'
                Ksenia will share her approach to improving developer documentation. She will offer tips on how clear and effective documentation can streamline project development, enhance collaboration, and improve overall project outcomes.
                TEXT
            )
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 17:30:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 18:00:00'))
            ->withTrack(Track::TECH_TWO)
            ->withConference(ConferenceFactory::findOrCreate(['name' => 'SyliusCon 2024']))
            ->create()
        ;
    }
}
