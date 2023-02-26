<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/contact');
    }

    public function checkContact(FunctionalTester $I)
    {
        $I->see('Contactar Suporte', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contactar Suporte', 'h1');
        $I->seeValidationError('O nome não pode ser vazio.');
        $I->seeValidationError('O email não pode ser vazio.');
        $I->seeValidationError('A mensagem não pode ser vazia.');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'Rafael',
            'ContactForm[email]' => 'rafael.email',
            'ContactForm[body]' => 'Mensagem',
        ]);
        $I->seeValidationError('O email tem de ser válido.');
        $I->dontSeeValidationError('O nome não pode ser vazio.');
        $I->dontSeeValidationError('A mensagem não pode ser vazia.');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'Rafael',
            'ContactForm[email]' => 'email@email.com',
            'ContactForm[body]' => 'Esta é uma mensagem',
        ]);
        $I->seeEmailIsSent();
        $I->see('Obrigado por nos contactar. Responderemos assim que possivel!');
    }
}
