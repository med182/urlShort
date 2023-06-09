<?php

namespace App\Tests\Controller;

use App\Form\UrlFormType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlsControllerTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please enter your Url to make it shorter!');
        $this->assertSelectorExists('form');
        $this->assertSelectorExists('input[id="url_form_original"]');
        $this->assertSelectorExists('form[name="url_form"]');
    }

    public function testForm()
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $form = $crawler->filter('form')->form();
        $client->submit($form, ['url_form[original]' => 'https://yahoo.fr']);

        $this->assertResponseRedirects();
    }
}
