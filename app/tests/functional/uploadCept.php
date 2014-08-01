<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('upload an image');

$I->amOnPage('/');
$I->attachFile('.upload', 'cookietest.jpg');
$I->fillField('Title', 'T is for Test');
$I->click('Upload');
$I->see('Uploading...');
$I->see('Upload Complete');
$I->seeRecord('images', array('filename' => 'cookietest.jpg', 'title' => 'T is for Test'));


