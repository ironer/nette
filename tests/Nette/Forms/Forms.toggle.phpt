<?php

/**
 * Test: Nette\Forms and toggle.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 */

use Nette\Forms\Form;



require __DIR__ . '/../bootstrap.php';


// AND
$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => TRUE,
), $form->getToggles() );



// OR
$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
	->endCondition()
	->addConditionOn($form['2'], Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
	->endCondition()
	->addConditionOn($form['2'], ~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => TRUE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
	->endCondition()
	->addConditionOn($form['2'], Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
	->endCondition()
	->addConditionOn($form['2'], ~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => TRUE,
), $form->getToggles() );



// OR & two components
$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => TRUE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => TRUE,
	'b' => TRUE,
), $form->getToggles() );



// OR & multiple used ID
$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');

Assert::same( array(
	'a' => TRUE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');

Assert::same( array(
	'a' => TRUE,
), $form->getToggles() );



$form = new Form;
$form->addText('1')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a');

Assert::same( array(
	'a' => TRUE,
), $form->getToggles() );





// AND & multiple used ID
$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('a');

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('a');

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('a');

Assert::same( array(
	'a' => TRUE,
), $form->getToggles() );



$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a')
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('a');

Assert::same( array(
	'a' => TRUE,
), $form->getToggles() );



// $hide = FALSE
$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('b', FALSE);

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('b', FALSE);

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => TRUE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b', FALSE);

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('b', FALSE);

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );



// $hide = FALSE & multiple used ID
$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('a');

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], ~Form::EQUAL, 'x')
			->toggle('a', FALSE);

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1');
$form->addText('2');
$form->addText('3')
	->addConditionOn($form['1'], ~Form::EQUAL, 'x')
		->toggle('a', FALSE)
		->addConditionOn($form['2'], Form::EQUAL, 'x')
			->toggle('a', FALSE);

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b');

Assert::same( array(
	'a' => FALSE,
	'b' => TRUE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a');
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('b', FALSE);

Assert::same( array(
	'a' => FALSE,
	'b' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);
$form->addText('2')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );


$form = new Form;
$form->addText('1')
	->addCondition(Form::EQUAL, 'x')
		->toggle('a', FALSE);
$form->addText('2')
	->addCondition(~Form::EQUAL, 'x')
		->toggle('a', FALSE);

Assert::same( array(
	'a' => FALSE,
), $form->getToggles() );
