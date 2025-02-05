<?php declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;


final class SurveyPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault(): void
    {
        // Zobrazí se šablona app/Templates/Survey/default.latte
    }

    protected function createComponentSurveyForm(): Form
    {
        $form = new Form;

        $form->addText('name', 'Jméno:')
            ->setRequired('Zadejte jméno.');
        $form->addTextArea('comment', 'Komentář:')
            ->setRequired('Zadejte komentář.');
        $form->addCheckbox('conditions', 'Souhlasím s podmínkami')
            ->setRequired('Musíte souhlasit s podmínkami.');
        $form->addMultiSelect('interests', 'Zájmy:', [
            'sport'  => 'Sport',
            'music'  => 'Hudba',
            'travel' => 'Cestování',
            'books'  => 'Knihy',
        ]);
        $form->addSubmit('submit', 'Odeslat');

        $form->onSuccess[] = [$this, 'surveyFormSucceeded'];

        return $form;
    }

    public function surveyFormSucceeded(Form $form, \stdClass $values): void
    {
        $this->database->table('survey')->insert([
            'name'       => $values->name,
            'comment'    => $values->comment,
            'conditions' => (int)$values->conditions,
            'interests'  => is_array($values->interests) ? implode(',', $values->interests) : null,
            'createdAt' => new \Nette\Utils\DateTime(),
        ]);

        $this->flashMessage('Data byla úspěšně uložena.', 'success');
        $this->redirect('Results:default');
    }
}
